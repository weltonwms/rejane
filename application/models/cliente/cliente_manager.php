<?php

/*
 * Esta Classe é a classe entrada do Model. Responsável por intermediar com o
 * Controler. Ela utiliza as outras Classes Model que ajudam a realizar todo o 
 * trabalho com  o Cliente.
 */

class Cliente_manager extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('cliente/Cliente_dao', 'Cliente_dao');
        $this->load->model('cliente/Cliente_model', 'Cliente_model');
    }

    public function get_clientes() {
        return $this->Cliente_dao->get_clientes();
    }

    public function get_cliente($id) {
        return $this->Cliente_dao->get_cliente($id);
    }

    public function salvar($post) {
        $retorno = array();
        $this->set_cliente($post);
        if ($post['id']) {
            $retorno['status'] = (int) $this->Cliente_model->gravar_alteracao();
            $retorno['acao_executada'] = 'alteracao';
        } else {
            $retorno['status'] = $this->Cliente_model->cadastrar();
            $retorno['acao_executada'] = 'cadastro';
        }

        return $retorno;
    }

    public function excluir($id) {

        if ($this->Cliente_model->is_relacionado_a_venda($id)):
            return -1;
        endif;

        if ($this->Cliente_model->excluir($id)) {
            return 1;
        }
        return 0;
    }

    private function set_cliente($post) {
        $this->Cliente_model->set_id(isset($post['id']) ? $post['id'] : NULL);
        $this->Cliente_model->set_nome($post['nome']);
        $this->Cliente_model->set_telefone($post['telefone']);
        $this->Cliente_model->set_cpf($post['cpf']);
        $this->Cliente_model->set_data_nascimento($post['data_nascimento']);
        $this->Cliente_model->set_endereco($post['endereco']);
        $this->Cliente_model->set_email($post['email']);
    }

}

?>
