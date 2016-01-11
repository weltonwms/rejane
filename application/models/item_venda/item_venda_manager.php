<?php

/*
 * Esta Classe é a classe entrada do Model Servico. Responsável por intermediar com o
 * Controler. Ela utiliza as outras Classes Model que ajudam a realizar todo o 
 * trabalho com  a Servico.
 */

class Item_venda_manager extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('item_venda/Item_venda_model');
    }

    public function cadastrar(array $post) {


        $this->Item_venda_model->set_id_venda($post['id_venda']);
        $this->Item_venda_model->set_id_produto($post['id_produto']);
        $this->Item_venda_model->set_qtd($post['qtd']);
        $this->Item_venda_model->set_id_funcionario($post['id_funcionario']);

        return $this->Item_venda_model->cadastrar();
    }

    public function gravar_alteracao(array $post) {

        $this->Item_venda_model->set_id($post['id_item_venda']);

        $this->Item_venda_model->set_id_venda($post['id']);
        $this->Item_venda_model->set_id_produto($post['id_produto']);
        $this->Item_venda_model->set_qtd($post['qtd']);
       $this->Item_venda_model->set_id_funcionario($post['id_funcionario']);

        return $this->Item_venda_model->gravar_alteracao();
    }

    public function excluir($id_item_venda) {

        return $this->Item_venda_model->excluir($id_item_venda);
    }
    
    public function excluir_itens_da_venda($id_venda){
        $this->db->where('id_venda',$id_venda);
        $this->db->delete('tb_item_venda');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        return;
    }

}

