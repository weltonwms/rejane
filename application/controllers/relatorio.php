<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Relatorio extends CI_Controller{
    
    public function __construct(){
	parent::__construct();
            if(!$this->session->userdata('session_id') || !$this->session->userdata('logado')){
		redirect("login");
            }
       $this->load->model('relatorio/Relatorio_manager','Relatorio_manager');
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
        $this->load->model('cliente/Cliente_manager','Cliente_manager');
        $this->load->model('produto/Produto_manager','Produto_manager');
        $dados['clientes']=  $this->Cliente_manager->get_clientes();
        $dados['produtos']=  $this->Produto_manager->get_produtos();
        
       
        $this->carrega_view('view_relatorio',$dados);    
		
    }
    
    public function gerar_relatorio(){
        $this->load->model('cliente/Cliente_manager','Cliente_manager');
        $this->load->model('produto/Produto_manager','Produto_manager');
        $dados['clientes']=  $this->Cliente_manager->get_clientes();
        $dados['produtos']=  $this->Produto_manager->get_produtos();
        $dados['requisicao']= $this->input->post();
       $dados['relatorio'] = $this->Relatorio_manager->gerar_relatorio($this->input->post());
        
       
       $this->carrega_view('view_relatorio',$dados); 
       
    }
    
    
    
   
    
}

