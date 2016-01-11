<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Funcionario extends CI_Controller{
    
    public function __construct(){
	parent::__construct();
            if(!$this->session->userdata('session_id') || !$this->session->userdata('logado')){
		redirect("login");
            }
        $this->load->model('funcionario/Funcionario_manager','Funcionario_manager');
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
        $dados['funcionarios']=$this->Funcionario_manager->get_funcionarios();
        $this->carrega_view('manter_funcionarios',$dados);    
		
    }
    
        
    public function salvar(){
        $retorno=$this->Funcionario_manager->salvar($this->input->post());
        if($retorno['status']>0){
            $this->session->set_flashdata('status','success');
            $this->session->set_flashdata('msg_confirm',"{$retorno['acao_executada']} com Sucesso!");
        }
        elseif($retorno['acao_executada']!='alteracao' && $retorno['status']==0){
            $this->session->set_flashdata('status','danger');
            $this->session->set_flashdata('msg_confirm','Não foi Possível Salvar Funcionário!');
        }
        redirect('funcionario');
    }
    
    public function editar($id=null){
        $dados['especialidades']=$this->Funcionario_manager->get_especialidades();
        $dados['funcionario']=  $this->Funcionario_manager->get_funcionario($id);
        $this->carrega_view('edicao_funcionario',$dados);
    }
    
        
    public function excluir($id_funcionario){
        $retorno=$this->Funcionario_manager->excluir($id_funcionario);
        if($retorno==-1){
            $this->session->set_flashdata('status','danger');
            $msg="Este Funcionario está relacionado a alguma Venda.<br> Retire o Funcionário da Venda Primeiro!";
            $this->session->set_flashdata('msg_confirm',$msg);
        }
        elseif($retorno==1){
           $this->session->set_flashdata('status','success');
           $this->session->set_flashdata('msg_confirm','Funcionário Excluído com Sucesso!');
        }
        else{
            $this->session->set_flashdata('status','danger');
            $this->session->set_flashdata('msg_confirm','Não foi possível Excluir Funcionário!');
        }
        redirect('funcionario');
    }
    
    public function detalhar_funcionario_ajax($id){
         $dados['funcionario']=  $this->Funcionario_manager->get_funcionario($id);
        $this->load->view('funcionario_detalhado_ajax',  $dados);
    }
    
}

