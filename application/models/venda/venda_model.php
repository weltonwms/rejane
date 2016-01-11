<?php


class Venda_model extends CI_Model{
    private $id;
    private $data;
    private $id_cliente;
    private $id_funcionario;
    private $forma_pagamento;
   
    
    function __construct() {
        parent::__construct();
    }
    
    
    public function cadastrar(){
        $dados=array(
            'data'=>  $this->data,
            'id_cliente'=>  $this->id_cliente,
            'forma_pagamento'=> $this->forma_pagamento
            
        );
        $this->db->insert('tb_venda',$dados);
        if($this->db->affected_rows()>0){
            return $this->db->insert_id();
        }
        return;
    }
    
    
    public function gravar_alteracao(){
        $dados=array(
            'data'=>  $this->data,
            'id_cliente'=>  $this->id_cliente,
            'forma_pagamento'=> $this->forma_pagamento
            
        );
        $this->db->where('id',  $this->id);
        $this->db->update('tb_venda',$dados);
        if($this->db->affected_rows()>0){
            return TRUE;
        }
        return;
    }
    
    public function excluir($id){
        $this->db->where('id',$id);
        $this->db->delete('tb_venda');
        if($this->db->affected_rows()>0){
            return TRUE;
        }
        return;
    }

    public function get_id() {
        return $this->id;
    }

    public function set_id($id) {
        $this->id = $id;
    }

    

    public function get_data() {
        if (preg_match('/^\d{4}-\d{1,2}-\d{1,2}$/', $this->data)){ //verifica se é formato aaaa/mm/dd
            $partes=  explode("-", $this->data);
            $formato_brasil=$partes[2]."/".$partes[1]."/".$partes[0];
            return $formato_brasil;
        }
       
           
        return $this->data;
    }

    public function set_data($data) {
        if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $data)) //verifica se é formato dd/mm/aaaa
	{
	    $partes=  explode("/", $data);
            $formato_mysql=$partes[2]."-".$partes[1]."-".$partes[0];
            $this->data=$formato_mysql;
            
	}
        elseif($data==null){
            $this->data=date('Y-m-d');
        }
        else
            
        $this->data = $data;
    }

    public function get_id_cliente() {
        return $this->id_cliente;
    }

    public function set_id_cliente($id_cliente) {
        $this->id_cliente = $id_cliente;
    }

    public function get_id_funcionario() {
        return $this->id_funcionario;
    }

    public function set_id_funcionario($id_funcionario) {
        $this->id_funcionario = $id_funcionario;
    }

    
    
    public function get_forma_pagamento() {
        return $this->forma_pagamento;
    }

    public function set_forma_pagamento($forma_pagamento) {
        $this->forma_pagamento = $forma_pagamento;
    }


    
   









}


