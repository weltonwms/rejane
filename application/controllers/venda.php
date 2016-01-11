<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Venda extends CI_Controller{
    
    public function __construct(){
	parent::__construct();
            if(!$this->session->userdata('session_id') || !$this->session->userdata('logado')){
		redirect("login");
            }
        $this->load->model('venda/Venda_manager','Venda_manager');
    }
    
    /***************************************************************************
     * O metodo carrega_view() carrega os arquivos php que estao na passta view
     * e representa o layout. Recebe como parâmetro obrigatório o nome do arquivo
     * do corpo que será carregado e opcionamente um array de dados para 
     * introduzir na visão do corpo
     * *************************************************************************
     */
    
    public function carrega_view($view_corpo, $dados=null){
        $this->load->view('html_header');
	$this->load->view('cabecalho');
	$this->load->view('menu_navegacao');
	$this->load->view($view_corpo,$dados);
	$this->load->view('rodape');
	$this->load->view('html_footer');
    }
    
    public function index(){
        $dados['vendas']=$this->Venda_manager->get_vendas();
        $this->carrega_view('manter_vendas',$dados);    
		
    }
    
    
    
    public function salvar_venda(){
        $retorno=$this->Venda_manager->salvar_venda($this->input->post());
        if($retorno['status']>0){
            $this->session->set_flashdata('status','success');
            $this->session->set_flashdata('msg_confirm',"{$retorno['acao_executada']} com Sucesso!");
        }
        elseif($retorno['acao_executada']!='alteracao' && $retorno['status']==0){
            $this->session->set_flashdata('status','danger');
            $this->session->set_flashdata('msg_confirm','Não foi Possível Salvar Venda!');
        }
        redirect('venda');
    }
    
    public function editar($id_venda=null){
        
        $this->load->model('cliente/Cliente_manager','Cliente_manager');
        $this->load->model('produto/Produto_manager','Produto_manager');
        $this->load->model('funcionario/Funcionario_manager','Funcionario_manager');
        $dados['clientes']=  $this->Cliente_manager->get_clientes();
        $dados['funcionarios']=  $this->Funcionario_manager->get_funcionarios();
        $dados['produtos']=  $this->Produto_manager->get_produtos();
        $dados['venda']=$this->Venda_manager->get_venda($id_venda);
        $this->carrega_view('edicao_venda',$dados);
    }
    
    
    
    public function excluir($id_venda){
        $retorno=$this->Venda_manager->excluir($id_venda);
        if($retorno){
            $this->session->set_flashdata('status','success');
            $this->session->set_flashdata('msg_confirm','Venda Excluída com Sucesso!');
        }
        else{
            $this->session->set_flashdata('status','danger');
            $this->session->set_flashdata('msg_confirm','Não foi possível Excluir Venda!');
        }
        redirect('venda');
    }
    
    public function imprimir($id_venda){
        //$venda=$this->Venda_manager->get_venda($id_venda);
        //echo "<pre>"; print_r($venda->get_itens_venda()); exit();
        $dados['venda']=$this->Venda_manager->get_venda($id_venda);
        $html=$this->load->view('impressao_venda',  $dados,TRUE);
        $this->load->library('pdf');
        $this->pdf->createPDF($html,'relat');
    }
    
    public function manter_itens_venda(){
        //echo "<pre>"; print_r($this->input->post()); exit();
        $retorno=$this->Venda_manager->manter_itens_venda($this->input->post());
        $id_venda=$retorno;
        if($retorno){
            $this->session->set_flashdata('status','success');
            $this->session->set_flashdata('msg_confirm','Venda  com Sucesso!');
        }
        else{
            $this->session->set_flashdata('status','danger');
            $this->session->set_flashdata('msg_confirm','Não foi Possível excluir Venda!');
        }
        redirect("venda/editar/$id_venda");
        
        
    }
    
     public function excluir_item_venda($id_item_venda, $id_venda){
        $retorno=$this->Venda_manager->excluir_item_venda($id_item_venda);
        if($retorno){
            $this->session->set_flashdata('status','success');
            $this->session->set_flashdata('msg_confirm','Item de Venda Excluído com Sucesso!');
        }
        else{
            $this->session->set_flashdata('status','danger');
            $this->session->set_flashdata('msg_confirm','Não foi possível Excluir Item de Venda!');
        }
         redirect("venda/editar/$id_venda");
    }
    
    public function detalhar_venda_ajax($id_venda){
        $dados['venda']=$this->Venda_manager->get_venda($id_venda);
        $this->load->view('venda_detalhada_ajax',  $dados);
    }
    
}

