<?php

class Produto_layout extends CI_Model {

    private $colunas=array();
    

    function __construct() {
        parent::__construct();
    }
    
    public function get_colunas($tipo){
        $metodo="set_colunas_do_tipo{$tipo}";
        $this->$metodo();
        
        return $this->colunas;
    }
    
    private function set_colunas_do_tipo1(){
        $this->colunas=array(
            'nome_tipo'=>'Tipo',
            'nome'=>'Nome',
            'valor_venda_formatado'=>'Valor Venda',
            'porcentagem_formatada'=>'Porcentagem'
            
        );
    }
    
    private function set_colunas_do_tipo2(){
        $this->colunas=array(
            'nome_tipo'=>'Tipo',
            'nome'=>'Nome',
            'valor_venda_formatado'=>'Valor Venda',
            'valor_compra_formatado'=>'Valor Compra',
            'marca'=>'Marca'
            
        );
    }
    
    private function set_colunas_do_tipo3(){
        $this->colunas=array(
            'nome_tipo'=>'Tipo',
            'nome'=>'Nome',
            'valor_venda_formatado'=>'Valor Venda',
            'valor_compra_formatado'=>'Valor Compra',
            'marca'=>'Marca',
            'porcentagem_formatada'=>'Porcentagem'
            
        );
    }
    
    

    

}

