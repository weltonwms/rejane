<?php

class Produto_model extends CI_Model {

    private $id;
    private $nome;
    private $valor_venda;
    private $valor_compra;
    private $porcentagem;
    private $marca;
    private $tipo;

    function __construct() {
        parent::__construct();
    }

    public function cadastrar() {
        $dados = array(
            'nome' => $this->nome,
            'valor_venda' => $this->valor_venda,
            'valor_compra' => $this->valor_compra,
            'porcentagem' => $this->porcentagem,
            'marca' => $this->marca,
            'tipo' => $this->tipo
        );
        $this->db->insert('tb_produto', $dados);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }
        return;
    }

    public function gravar_alteracao() {
        $dados = array(
            'nome' => $this->nome,
            'valor_venda' => $this->valor_venda,
            'valor_compra' => $this->valor_compra,
            'porcentagem' => $this->porcentagem,
            'marca' => $this->marca,
            'tipo' => $this->tipo
        );
        $this->db->where('id', $this->id);
        $this->db->update('tb_produto', $dados);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        return;
    }

    public function excluir($id) {
        $this->db->where('id', $id);
        $this->db->delete('tb_produto');
        if ($this->db->affected_rows() > 0) {
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

    public function get_nome() {
        return $this->nome;
    }

    public function set_nome($nome) {
        $this->nome = $nome;
    }

    public function get_valor_venda() {
        return $this->valor_venda;
    }

    public function set_valor_venda($valor) {

        if (preg_match('/,[0-9]{1,2}$/', $valor)) {
            $valor = str_replace(".", "", $valor);
            $valor = str_replace(",", ".", $valor);
        }
        $this->valor_venda = $valor;
    }

    public function get_valor_compra() {
        return $this->valor_compra;
    }

    public function set_valor_compra($valor) {
        if (!$valor):
            $valor = NULL;
        endif;

        if (preg_match('/,[0-9]{1,2}$/', $valor)) {
            $valor = str_replace(".", "", $valor);
            $valor = str_replace(",", ".", $valor);
            
        }
        $this->valor_compra = $valor;
    }

    public function get_porcentagem() {
        return $this->porcentagem;
    }
    
    
    public function set_porcentagem($porcentagem) {
        if (!$porcentagem) {
            $porcentagem = NULL;
        }
        if (preg_match('/,[0-9]{1,2}$/', $porcentagem)) {
            $porcentagem = str_replace(".", "", $porcentagem);
            $porcentagem = str_replace(",", ".", $porcentagem);
        }

        $this->porcentagem = $porcentagem;
    }

    public function get_marca() {
        return $this->marca;
    }

    public function set_marca($marca) {
        $this->marca = $marca;
    }

    public function get_tipo() {
        return $this->tipo;
    }

    public function set_tipo($tipo) {
        $this->tipo = $tipo;
    }

    public function get_nome_tipo() {
        $dados = array('', 'Serviço', 'Produto');
        return $dados["{$this->tipo}"];
    }

    public function get_valor_compra_formatado() {
        if ($this->valor_compra):
            return "R$ " . number_format($this->get_valor_compra(), 2, ",", ".");
        endif;
    }

    public function get_valor_venda_formatado() {
        if ($this->valor_venda):
            return "R$ " . number_format($this->get_valor_venda(), 2, ",", ".");
        endif;
    }
    
    public function get_porcentagem_formatada() {
        if ($this->porcentagem):
            return number_format($this->get_porcentagem(), 2, ",", "."). " %";
        endif;
        return $this->porcentagem;
    }

    public function is_relacionado_a_venda($id_produto) {
        $this->db->select('*');
        $this->db->from('tb_item_venda');
        $this->db->join('tb_venda', 'tb_item_venda.id_venda = tb_venda.id');
        $this->db->where('tb_item_venda.id_produto', $id_produto);
        $result = $this->db->get()->result();
        if (count($result) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function transformar_em_array() {
        /*         * ******************************************************************
         * O método transformar_em_array() varre o objeto, colocando-o em um array
         * de chave[jsonVars].Os valores passados ao array não utilizam os atributos
         * diretamente e sim os métodos get.
         * **********************************************************************
         */
        foreach ($this as $key => $val) {
            $metodo = 'get_' . $key;
            if (method_exists($this, $metodo))
                $data[$key] = $this->$metodo();
        }
        return $data;
    }

}

