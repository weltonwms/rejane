<?php

/*
 * Esta Classe é a classe entrada do Model Produto. Responsável por intermediar com o
 * Controler. Ela utiliza as outras Classes Model que ajudam a realizar todo o 
 * trabalho com  a Produto.
 */

class Produto_manager extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('produto/Produto_dao',"Produto_dao");
        $this->load->model('produto/Produto_model',"Produto_model");
    }

    public function get_produtos($tipo=null) {
        return $this->Produto_dao->get_produtos($tipo);
    }

    public function get_produto($id) {
        return $this->Produto_dao->get_produto($id);
    }

    public function salvar($post) {
        $retorno=array();
        $this->set_produto($post);
        if ($post['id']) {
            $retorno['status']= (int) $this->Produto_model->gravar_alteracao();
            $retorno['acao_executada']='alteracao';
        } else {
            $retorno['status']=$this->Produto_model->cadastrar();
            $retorno['acao_executada']='cadastro';
        }
        
        return $retorno;
    }

    

    public function excluir($id_produto) {
       
        if ($this->Produto_model->is_relacionado_a_venda($id_produto)) {
            return -1;
        }
        
        if($this->Produto_model->excluir($id_produto)){
            return 1;
        }
        return 0;
    }

    private function set_produto($post) {
       
        $this->Produto_model->set_id(isset($post['id']) ? $post['id'] : NULL);
        $this->Produto_model->set_nome($post['nome']);
        $this->Produto_model->set_valor_venda($post['valor_venda']);
        $this->Produto_model->set_tipo($post['tipo']);
        
        if($post['tipo']=='1'):
            $this->Produto_model->set_porcentagem($post['porcentagem']);
        endif;
        if($post['tipo']=='2'):
           $this->Produto_model->set_valor_compra($post['valor_compra']);
         $this->Produto_model->set_marca($post['marca']);
        endif;
       
    }

}

