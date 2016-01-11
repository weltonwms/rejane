<?php

class Produto_dao extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('produto/Produto_model', "Produto_model");
    }

     public function get_produtos($tipo) {
         if($tipo):
            $this->db->where('tipo',$tipo);
        endif;
        $this->db->order_by("nome", "asc");
        $produtos_banco = $this->db->get('tb_produto')->result();
        if (count($produtos_banco) > 0) {
            $lista = array();
            foreach ($produtos_banco as $produto) {
                $lista[] = $this->get_produto($produto->id, $produto);
            }

            return $lista;
        }
        return;
    }

    public function get_produto($id, $produto_banco = null) {
        
        if ($produto_banco == null):
            $this->db->where('id', $id);
            $resultado = $this->db->get('tb_produto')->result();
            $produto_banco = count($resultado)==1?$resultado[0]:null;
        endif;
        
        if ($produto_banco != null) {
            $produto = new $this->Produto_model();
            $produto->set_id($produto_banco->id);
            $produto->set_nome($produto_banco->nome);
            $produto->set_valor_venda($produto_banco->valor_venda);
            $produto->set_valor_compra($produto_banco->valor_compra);
            $produto->set_porcentagem($produto_banco->porcentagem);
            $produto->set_marca($produto_banco->marca);
            $produto->set_tipo($produto_banco->tipo);
            return $produto;
        }
        return $this->get_produto_vazio();
    }

    public function get_produto_vazio() {
        return new $this->Produto_model();
    }

}

