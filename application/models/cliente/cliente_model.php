<?php


class Cliente_model extends CI_Model{
    private $id;
    private $nome;
    private $telefone;
    private $cpf;
    private $data_nascimento;
    private $endereco;
    private $email;
    
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_id() {
        return $this->id;
    }

    public function set_id($id) {
        $this->id = $id;
    }

    public function get_nome() {
        return $this->nome;
    }

    public function set_nome($nome) {
        $this->nome = $nome;
    }

    public function get_telefone() {
        return $this->telefone;
    }

    public function set_telefone($telefone) {
        $this->telefone = $telefone;
    }

    public function get_cpf() {
        return $this->cpf;
    }

    public function set_cpf($cpf) {
        $this->cpf = $cpf;
    }

    public function get_data_nascimento() {
        if (preg_match('/^\d{4}-\d{1,2}-\d{1,2}$/', $this->data_nascimento)){ //verifica se é formato aaaa/mm/dd
            $partes=  explode("-", $this->data_nascimento);
            $formato_brasil=$partes[2]."/".$partes[1]."/".$partes[0];
            return $formato_brasil;
        }
       
        return $this->data_nascimento;
    }

    public function set_data_nascimento($data_nascimento) {
         if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $data_nascimento)) //verifica se é formato dd/mm/aaaa
	{
	    $partes=  explode("/", $data_nascimento);
            $formato_mysql=$partes[2]."-".$partes[1]."-".$partes[0];
            $this->data_nascimento=$formato_mysql;
            
	}
        
        else
        $this->data_nascimento = $data_nascimento;
    }

    public function get_endereco() {
        return $this->endereco;
    }

    public function set_endereco($endereco) {
        $this->endereco = $endereco;
    }

    public function get_email() {
        return $this->email;
    }

    public function set_email($email) {
        $this->email = $email;
    }

    
        
    public function cadastrar(){
        $dados=array(
            'nome'=>  $this->nome,
            'telefone'=>$this->telefone,
            'cpf'=>  $this->cpf,
            'data_nascimento'=>  $this->data_nascimento,
            'endereco'=>  $this->endereco,
            'email'=> $this->email
        );
        $this->db->insert('tb_cliente',$dados);
        if($this->db->affected_rows()>0){
            return $this->db->insert_id();
        }
        return;
    }
    
    public function excluir($id){
        $this->db->where('id',$id);
        $this->db->delete('tb_cliente');
        if($this->db->affected_rows()>0){
             return TRUE;
        }
        return;
      
    }
    
    public function gravar_alteracao(){
        $dados=array(
            'nome'=>  $this->nome,
            'telefone'=>$this->telefone,
            'cpf'=>  $this->cpf,
            'data_nascimento'=>  $this->data_nascimento,
            'endereco'=>  $this->endereco,
            'email'=> $this->email
        );
        $this->db->where('id',  $this->id);
        $this->db->update('tb_cliente',$dados);
        if($this->db->affected_rows()>0){
            return TRUE;
        }
        return;
    
    }
    
    public function is_relacionado_a_venda($id_cliente) {
        $this->db->where('id_cliente', $id_cliente);
        $result = $this->db->get('tb_venda')->result();
        if (count($result) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    


    
}


