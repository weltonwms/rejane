<?php


class Item_servico_composite extends CI_Model{
    private $item_servico; //objeto item_servico_model
    private $servico;   // objeto servico_model
    private $cliente; //objeto cliente_model
    private $produto; //objeto Produto_model
    private $funcionario; //objeto Funcionario_model
     
    public function set_item_servico(Item_servico_model $item_servico) {
        $this->item_servico = $item_servico;
    }

    public function set_servico(Servico_model $servico) {
        $this->servico = $servico;
    }

    public function set_cliente(Cliente_model $cliente) {
        $this->cliente = $cliente;
    }
    
    public function set_produto(Produto_model $produto) {
        $this->produto = $produto;
    }
    
     public function set_funcionario(Funcionario_model $funcionario) {
        $this->funcionario = $funcionario;
    }

        
    public function get_id_servico(){
        return $this->servico->get_id_servico();
    }
    
    public function get_data_servico(){
        return $this->servico->get_data();
    }
    
    public function get_estado_servico(){
        return $this->servico->get_nome_estado();
    }
    
    public function get_nome_produto(){
        return $this->produto->get_nome();
    }
    public function get_valor_final(){
        return $this->item_servico->get_valor_final();
    }
    
    public function get_valor_final_multiplicado(){
        return $this->item_servico->get_valor_final_multiplicado();
    }
    
    public function get_item(){
        return $this->item_servico->get_item();
    }
    
    public function get_nome_cliente(){
        return $this->cliente->get_nome();
    }
    
    public function get_qtd_produto(){
        return $this->item_servico->get_qtd_produto();
    }
    
    


}