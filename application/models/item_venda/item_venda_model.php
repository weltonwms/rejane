<?php

class Item_venda_model extends CI_Model {

    private $id;
    private $id_venda;
    private $id_produto;
    private $qtd;
    private $obj_produto; //objeto Model
    private $id_funcionario;
    private $obj_funcionario; //objeto Model

    function __construct() {
        parent::__construct();
        $this->load->model('produto/Produto_dao');
        $this->load->model('funcionario/Funcionario_dao');
    }

    public function get_id() {
        return $this->id;
    }

    public function set_id($id) {
        $this->id = $id;
    }

    public function get_id_venda() {
        return $this->id_venda;
    }
    public function set_id_venda($id_venda) {
        $this->id_venda = $id_venda;
    }

    public function get_id_produto() {
        return $this->id_produto;
    }

    public function set_id_produto($id_produto) {
        $this->id_produto = $id_produto;
    }

    public function get_qtd() {
        return $this->qtd;
    }

    public function set_qtd($qtd) {
        if(!$qtd){
            $qtd=NULL;
        }
        $this->qtd = $qtd;
    }
    
    public function get_id_funcionario() {
        return $this->id_funcionario;
    }

    public function set_id_funcionario($id_funcionario) {
        $this->id_funcionario = $id_funcionario;
    }

    
  
    public function cadastrar() {
        $dados = array(
            'id_venda' => $this->id_venda,
            'id_produto' => $this->id_produto,
            'id_funcionario' => $this->id_funcionario,
            'qtd' => $this->qtd
            
        );
        $this->db->insert('tb_item_venda', $dados);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }
        return;
    }

    public function gravar_alteracao() {
        $dados = array(
            'id_venda' => $this->id_venda,
            'id_produto' => $this->id_produto,
             'id_funcionario' => $this->id_funcionario,
            'qtd' => $this->qtd
            
        );
        $this->db->where('id', $this->id);
        $this->db->update('tb_item_venda', $dados);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        return;
    }

    public function excluir($id) {
        $this->db->where('id', $id);
        $this->db->delete('tb_item_venda');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        return;
    }
    
    protected function set_obj_produto($id_produto) {
        $this->obj_produto = $this->Produto_dao->get_produto($id_produto);
    }
    
    protected function set_obj_funcionario($id_funcionario) {
        $this->obj_funcionario = $this->Funcionario_dao->get_funcionario($id_funcionario);
    }

    public function get_nome_produto() {
        if (!is_object($this->obj_produto)) {
            $this->set_obj_produto($this->id_produto);
        }
        return $this->obj_produto->get_nome();
    }
    
     public function get_nome_funcionario() {
        if (!is_object($this->obj_funcionario)) {
            $this->set_obj_funcionario($this->id_funcionario);
        }
        return $this->obj_funcionario->get_nome();
    }
    
    public function get_tipo() {
        if (!is_object($this->obj_produto)) {
            $this->set_obj_produto($this->id_produto);
        }
        return $this->obj_produto->get_tipo();
    }
    
    public function get_valor_venda() {
        if (!is_object($this->obj_produto)) {
            $this->set_obj_produto($this->id_produto);
        }
        return $this->obj_produto->get_valor_venda();
    }
    public function get_valor_total(){
         if (!is_object($this->obj_produto)) {
            $this->set_obj_produto($this->id_produto);
        }
        return $this->obj_produto->get_valor_venda()*$this->qtd;
    }

}

