<?php

/*
 * Esta Classe é a classe entrada do Model Venda. Responsável por intermediar com o
 * Controler. Ela utiliza as outras Classes Model que ajudam a realizar todo o 
 * trabalho com  a Venda.
 */

class Venda_manager extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('venda/Venda_dao','Venda_dao');
        $this->load->model('venda/Venda_model','Venda_model');
    }

    public function get_vendas() {
        return $this->Venda_dao->get_vendas_composite();
    }

    public function get_venda($id_venda) {
        return $this->Venda_dao->get_venda_composite($id_venda);
    }

    public function salvar_venda($post) {
        $retorno=array();
        $this->set_venda($post);
        if ($post['id']) {
            $retorno['status']= (int) $this->Venda_model->gravar_alteracao($post);
            $retorno['acao_executada']='alteracao';
            $retorno['id']=$post['id'];
        } else {
            $retorno['status']=$this->Venda_model->cadastrar($post);
            $retorno['acao_executada']='cadastro';
            $retorno['id']=$retorno['status']; // o status nesse caso é o retorno de cadastrar que é o id
        }
        
        return $retorno;
    }

   

    public function excluir($id) {
        $this->load->model('item_venda/Item_venda_manager');
        $this->Item_venda_manager->excluir_itens_da_venda($id);
        return $this->Venda_model->excluir($id);
    }

    public function excluir_item_venda($id_item_venda) {
        $this->load->model('item_venda/Item_venda_manager', 'item_venda_m');
        return $this->item_venda_m->excluir($id_item_venda);
    }

    public function manter_itens_venda(array $post) {
        $this->load->model('item_venda/Item_venda_manager', 'item_venda_m');
        
        $retorno=$this->salvar_venda($post);
         $id_venda=$retorno['id'];
       

        if ($post['id_item_venda']) {
            $this->item_venda_m->gravar_alteracao($post);
            $id_item_venda = $post['id_item_venda'];
            //atualizar item de venda
        } else {
            $post['id_venda'] = $id_venda;
            $id_item_venda = $this->item_venda_m->cadastrar($post);
            //cadastrar item_venda
        }

        return $id_venda;
    }
    
    private function set_venda($post) {
       
        $this->Venda_model->set_id(isset($post['id']) ? $post['id'] : NULL);
        $this->Venda_model->set_data($post['data']);
        $this->Venda_model->set_forma_pagamento($post['forma_pagamento']);
        $this->Venda_model->set_id_cliente($post['id_cliente']);
       
        
       
    }
}

