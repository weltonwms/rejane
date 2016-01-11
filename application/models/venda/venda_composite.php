<?php


class Venda_composite extends CI_Model{
    private $venda; //objeto Venda_model
    private $itens_venda; //array de objetos tipo Item_venda_model
    private $cliente; //objeto Cliente_model
   
    
    public function set_venda(Venda_model $venda){
        $this->venda=$venda;
    }
    
    public function set_itens_venda(array $itens_venda){
        $this->itens_venda=$itens_venda;
    }
    
    public function set_cliente(Cliente_model $cliente){
        $this->cliente=$cliente;
    }
    
   
    
    public function get_id(){
        return $this->venda->get_id();
    }
    
    public function get_id_cliente(){
        return $this->venda->get_id_cliente();
    }
    
    
    
    public function get_nome_cliente(){
        return $this->cliente->get_nome();
    }
    
    
    
    public function get_endereco_cliente(){
        return $this->cliente->get_endereco();
    }
    
   
    
    public function get_telefone_cliente(){
        return $this->cliente->get_telefone();
    }
    
    public function get_cpf_cliente(){
        return $this->cliente->get_cpf();
    }
    
   
    
   
    
    public function get_data(){
        return $this->venda->get_data();
    }
    
    
    
    public function get_forma_pagamento(){
        return $this->venda->get_forma_pagamento();
    }
    
   
    
   
    public function get_itens_venda() {
        return $this->itens_venda;
    }
    
     public function get_email_cliente(){
        return $this->cliente->get_email();
    }
    
    public function get_total_itens_venda(){
        $soma=0;
        foreach($this->itens_venda as $item):
            $soma+=$item->get_valor_total();
        endforeach;
        return $soma;
    }
    
     public function get_total_itens_venda_formatado() {
       
            return "R$ " . number_format($this->get_total_itens_venda(), 2, ",", ".");
        
    }
    
   


    
    
   
}


