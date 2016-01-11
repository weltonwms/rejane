<?php

class Item_venda_dao extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('item_venda/Item_venda_model');
    }

    public function get_itens_venda($id_venda) {
        $lista = array();
        $this->db->where('id_venda', $id_venda);
        $this->db->order_by("id", "asc");
        $itens_venda_banco = $this->db->get('tb_item_venda')->result();
        if (count($itens_venda_banco) > 0) {
            foreach ($itens_venda_banco as $item_venda) {
                $lista[] = $this->get_item_venda($item_venda->id);
            }
        }
        return $lista;
    }

    public function get_item_venda($id_item_venda) {
        $this->db->where('id', $id_item_venda);
        $item_venda_banco = $this->db->get('tb_item_venda')->result();
        if (count($item_venda_banco) > 0) {
            $item_venda = new $this->Item_venda_model();
            $item_venda->set_id($item_venda_banco[0]->id);
            $item_venda->set_id_venda($item_venda_banco[0]->id_venda);
            $item_venda->set_id_produto($item_venda_banco[0]->id_produto);
            $item_venda->set_qtd($item_venda_banco[0]->qtd);
            $item_venda->set_id_funcionario($item_venda_banco[0]->id_funcionario);
             
            return $item_venda;
        }
        return;
    }
    
    public function get_itens_venda_vazio(){
        return array();
    }

}

