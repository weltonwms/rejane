<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//alteração
class Cliente extends CI_Controller{
    
    public function __construct(){
	parent::__construct();
            if(!$this->session->userdata('session_id') || !$this->session->userdata('logado')){
		redirect("login");
            }
        $this->load->model('cliente/Cliente_manager','Cliente_manager');
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
        $dados['clientes']=$this->Cliente_manager->get_clientes();
        $this->carrega_view('manter_clientes',$dados);    
		
    }
    
        
    public function salvar(){
        $retorno=$this->Cliente_manager->salvar($this->input->post());
        if($retorno['status']>0){
            $this->session->set_flashdata('status','success');
            $this->session->set_flashdata('msg_confirm',"{$retorno['acao_executada']} com Sucesso!");
        }
        elseif($retorno['acao_executada']!='alteracao' && $retorno['status']==0){
            $this->session->set_flashdata('status','danger');
            $this->session->set_flashdata('msg_confirm','Não foi Possível Salvar Cliente!');
        }
        redirect('cliente');
    }
    
    
    
    public function editar($id=null){
        $dados['cliente']=  $this->Cliente_manager->get_cliente($id);
        $this->carrega_view('edicao_cliente',$dados);
    }
    
    
    
   public function excluir($id){
        $retorno=$this->Cliente_manager->excluir($id);
        if($retorno==-1){
            $this->session->set_flashdata('status','danger');
            $msg="Este Cliente está relacionado a alguma Venda.<br> Retire o Cliente da Venda Primeiro!";
            $this->session->set_flashdata('msg_confirm',$msg);
        }
        elseif($retorno==1){
           $this->session->set_flashdata('status','success');
           $this->session->set_flashdata('msg_confirm','Cliente Excluído com Sucesso!');
        }
        else{
            $this->session->set_flashdata('status','danger');
            $this->session->set_flashdata('msg_confirm','Não foi possível Excluir Cliente!');
        }
        redirect('cliente');
    }
    
     public function detalhar_cliente_ajax($id_cliente){
         $dados['cliente']=  $this->Cliente_manager->get_cliente($id_cliente);
        $this->load->view('cliente_detalhado_ajax',  $dados);
    }
    
}

