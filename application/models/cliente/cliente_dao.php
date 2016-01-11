<?php

class Cliente_dao extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('cliente/Cliente_model', 'Cliente_model');
    }

    public function get_clientes() {
        $this->db->order_by("nome", "asc");
        $clientes_banco = $this->db->get('tb_cliente')->result();
        if (count($clientes_banco) > 0) {
            $lista = array();
            foreach ($clientes_banco as $cliente) {
                $lista[] = $this->get_cliente($cliente->id, $cliente);
            }

            return $lista;
        }
        return;
    }

    public function get_cliente($id, $cliente_banco = null) {
        
        if ($cliente_banco == null):
            $this->db->where('id', $id);
            $resultado = $this->db->get('tb_cliente')->result();
            $cliente_banco = count($resultado)==1?$resultado[0]:null;
        endif;
        
        if ($cliente_banco != null) {
            $cliente = new $this->Cliente_model();
            $cliente->set_id($cliente_banco->id);
            $cliente->set_nome($cliente_banco->nome);
            $cliente->set_telefone($cliente_banco->telefone);
            $cliente->set_cpf($cliente_banco->cpf);
            $cliente->set_data_nascimento($cliente_banco->data_nascimento);
            $cliente->set_endereco($cliente_banco->endereco);
            $cliente->set_email($cliente_banco->email);
            return $cliente;
        }
        return $this->get_cliente_vazio();
    }

    public function get_cliente_vazio() {
        return new $this->Cliente_model();
    }

}

?>
