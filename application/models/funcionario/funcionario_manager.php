<?php
/*
 * Esta Classe é a classe entrada do Model. Responsável por intermediar com o
 * Controler. Ela utiliza as outras Classes Model que ajudam a realizar todo o 
 * trabalho com  o Funcionario.
 */
class Funcionario_manager extends CI_Model{
    
    function __construct() {
        parent::__construct();
        $this->load->model('funcionario/Funcionario_dao','Funcionario_dao');
        $this->load->model('funcionario/Funcionario_model','Funcionario_model');
    }
    
    public function get_funcionarios(){
        return $this->Funcionario_dao->get_funcionarios();
    }
    
    public function get_funcionario($id){
       return $this->Funcionario_dao->get_funcionario($id);
    }
    
     public function salvar($post) {
        $retorno=array();
        $this->set_funcionario($post);
        if ($post['id']) {
            $retorno['status']= (int) $this->Funcionario_model->gravar_alteracao();
            $retorno['acao_executada']='alteracao';
        } else {
            $retorno['status']=$this->Funcionario_model->cadastrar();
            $retorno['acao_executada']='cadastro';
        }
        
        return $retorno;
    }
  
    
    public function excluir($id){
        
        if($this->Funcionario_model->is_relacionado_a_venda($id)):
            return -1;
        endif;
        
        if($this->Funcionario_model->excluir($id)){
            return 1;
        }
        return 0;
    }
    
   
    
    private function set_funcionario($post){
       
        $this->Funcionario_model->set_id(isset($post['id']) ? $post['id'] : NULL);
        $this->Funcionario_model->set_nome($post['nome']);
        $this->Funcionario_model->set_telefone($post['telefone']);
        $this->Funcionario_model->set_cpf($post['cpf']);
        $this->Funcionario_model->set_del_porcentagem(isset($post['del_porcentagem'])?$post['del_porcentagem']:0);
        $this->Funcionario_model->set_especialidades(isset($post['especialidades'])?$post['especialidades']:null);
    }
    
    public function get_especialidades(){
        return $this->db->get('tb_especialidade')->result();
    }
}

?>
