<?php

class Venda_dao extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('venda/Venda_model',"Venda_model");
        $this->load->model('venda/Venda_composite',"Venda_composite");
        $this->load->model('cliente/Cliente_dao',"Cliente_dao");
        $this->load->model('funcionario/Funcionario_dao',"Funcionario_dao");
        $this->load->model('item_venda/Item_venda_dao',"Item_venda_dao");
    }

     public function get_vendas() {
        $this->db->order_by("nome", "asc");
        $vendas_banco = $this->db->get('tb_venda')->result();
        if (count($vendas_banco) > 0) {
            $lista = array();
            foreach ($vendas_banco as $venda) {
                $lista[] = $this->get_venda($venda->id, $venda);
            }

            return $lista;
        }
        return;
    }

    public function get_venda($id, $venda_banco = null) {
        
        if ($venda_banco == null):
            $this->db->where('id', $id);
            $resultado = $this->db->get('tb_venda')->result();
            $venda_banco = count($resultado)==1?$resultado[0]:null;
        endif;
        
        if ($venda_banco != null) {
            $venda = new $this->Venda_model();
            $venda->set_id($venda_banco->id);
            $venda->set_data($venda_banco->data);
            $venda->set_forma_pagamento($venda_banco->forma_pagamento);
            $venda->set_id_cliente($venda_banco->id_cliente);
           
            
            return $venda;
        }
        return $this->get_venda_vazio();
    }
    
    public function get_venda_vazio(){
        return new $this->Venda_model();;
    }
    
    public function get_vendas_composite() {
        $this->db->order_by("id", "desc");
        $vendas_banco = $this->db->get('tb_venda')->result();
        if (count($vendas_banco) > 0) {
            $lista = array();
            foreach ($vendas_banco as $venda) {
                $lista[] =  $this->get_venda_composite($venda->id, $venda);
            }

            return $lista;
        }
        return;
        
        
        $lista = array();

       
    }

    public function get_venda_composite($id, $venda_banco = null) {
        $venda_banco= array();
        if ($venda_banco==null || $id!=null):
            $this->db->where('id', $id);
            $venda_banco = $this->db->get('tb_venda')->result();
        endif;
        $venda = new $this->Venda_composite();
        if (count($venda_banco) > 0) {

            $venda->set_venda($this->get_venda($venda_banco[0]->id));
            $venda->set_cliente($this->Cliente_dao->get_cliente($venda_banco[0]->id_cliente));
           
            $venda->set_itens_venda($this->Item_venda_dao->get_itens_venda($venda_banco[0]->id));
        } else {
            $venda->set_venda($this->get_venda_vazio());
            $venda->set_cliente($this->Cliente_dao->get_cliente_vazio());
           
            $venda->set_itens_venda($this->Item_venda_dao->get_itens_venda_vazio());
        }
        return $venda;
    }

}

