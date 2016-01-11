<?php

class Funcionario_model extends CI_Model {

    private $id;
    private $nome;
    private $telefone;
    private $cpf;
    private $del_porcentagem;
    private $especialidades = array();

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

    public function get_del_porcentagem() {
        return $this->del_porcentagem;
    }
    
    public function get_nome_del_porcentagem() {
        $dados=array('','Sim');
        return $dados[$this->del_porcentagem];
    }

    public function set_del_porcentagem($del_porcentagem) {
        $this->del_porcentagem = $del_porcentagem;
    }

    public function get_especialidades() {
        if (!$this->especialidades):
            $this->db->select('fe.id_especialidade, fe.id_funcionario, e.nome nome_especialidade');
            $this->db->from('tb_funcionario_especialidade fe');
            $this->db->join('tb_especialidade e', 'fe.id_especialidade =e.id', 'inner');
            $this->db->where('id_funcionario', $this->id);
            $resultado = $this->db->get()->result();
            foreach ($resultado as $res):
                $this->especialidades[$res->id_especialidade] = $res->nome_especialidade;
            endforeach;
           
        endif;
       
        return $this->especialidades;
    }

    public function set_especialidades($especialidades) {
        $this->especialidades = $especialidades;
    }

    public function cadastrar() {
        $dados = array(
            'nome' => $this->nome,
            'telefone' => $this->telefone,
            'cpf' => $this->cpf,
            'del_porcentagem' => $this->del_porcentagem
        );
        $this->db->insert('tb_funcionario', $dados);
        if ($this->db->affected_rows() > 0) {
            
            $id_funcionario=$this->db->insert_id();
            $this->id=$id_funcionario;
            $this->gravar_especialidades();
            return $id_funcionario;
        }
        return;
    }

    public function excluir($id) {
        $this->excluir_especialidades($id);
        $this->db->where('id', $id);
        $this->db->delete('tb_funcionario');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        return;
    }

    public function gravar_alteracao() {

        $dados = array(
            'nome' => $this->nome,
            'telefone' => $this->telefone,
            'cpf' => $this->cpf,
            'del_porcentagem' => $this->del_porcentagem
        );


        $this->db->where('id', $this->id);
        $this->db->update('tb_funcionario', $dados);
        $this->gravar_especialidades();
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        return;
    }

    public function is_relacionado_a_venda($id_funcionario) {
        $this->db->where('id_funcionario', $id_funcionario);
        $result = $this->db->get('tb_venda')->result();
        if (count($result) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private function gravar_especialidades() {
        if ($this->especialidades):
            $this->db->where('id_funcionario', $this->id);
            $this->db->delete('tb_funcionario_especialidade');
            $dados = array();

            foreach ($this->especialidades as $esp):
                $dados[] = array("id_funcionario" => $this->id,
                    'id_especialidade' => $esp);
            endforeach;
            return $this->db->insert_batch('tb_funcionario_especialidade', $dados);
        endif;
    }
    
    private function excluir_especialidades($id_funcionario){
        $this->db->where('id_funcionario',$id_funcionario);
        $this->db->delete('tb_funcionario_especialidade');
    }

}

