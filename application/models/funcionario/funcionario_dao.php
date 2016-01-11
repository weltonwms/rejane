<?php

class Funcionario_dao extends CI_Model{
    
    function __construct() {
        parent::__construct();
        $this->load->model('funcionario/Funcionario_model','Funcionario_model');
    }
    
    public function get_funcionarios(){
        $this->db->order_by("nome", "asc");
        $funcionarios_banco = $this->db->get('tb_funcionario')->result();
        if (count($funcionarios_banco) > 0) {
            $lista = array();
            foreach ($funcionarios_banco as $funcionario) {
                $lista[] = $this->get_funcionario($funcionario->id, $funcionario);
            }

            return $lista;
        }
        return;
    }
    
    public function get_funcionario($id, $funcionario_banco=null){
       if ($funcionario_banco == null):
            $this->db->where('id', $id);
            $resultado = $this->db->get('tb_funcionario')->result();
            $funcionario_banco = count($resultado)==1?$resultado[0]:null;
        endif;
        
        if ($funcionario_banco != null) {
            $funcionario = new $this->Funcionario_model();
            $funcionario->set_id($funcionario_banco->id);
            $funcionario->set_nome($funcionario_banco->nome);
            $funcionario->set_telefone($funcionario_banco->telefone);
            $funcionario->set_cpf($funcionario_banco->cpf);
            $funcionario->set_del_porcentagem($funcionario_banco->del_porcentagem);
           //$funcionario->set_especialidades(array());
            return $funcionario;
        }
        return $this->get_funcionario_vazio();
    }
    
     public function get_funcionario_vazio() {
        return new $this->Funcionario_model();
    }
    
    
}

?>
