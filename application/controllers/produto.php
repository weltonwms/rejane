<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Produto extends CI_Controller{
    
    public function __construct(){
	parent::__construct();
            if(!$this->session->userdata('session_id') || !$this->session->userdata('logado')){
		redirect("login");
            }
        $this->load->model('produto/Produto_manager','Produto_manager');
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
        $this->load->model('produto/Produto_layout');
        $dados['colunas']=$this->Produto_layout->get_colunas(3);
        $dados['produtos']=$this->Produto_manager->get_produtos();
        $dados['tipo']=3;
        $this->carrega_view('manter_produtos',$dados);    
		
    }
    
     public function salvar(){
        $retorno=$this->Produto_manager->salvar($this->input->post());
        if($retorno['status']>0){
            $this->session->set_flashdata('status','success');
            $this->session->set_flashdata('msg_confirm',"{$retorno['acao_executada']} com Sucesso!");
        }
        elseif($retorno['acao_executada']!='alteracao' && $retorno['status']==0){
            $this->session->set_flashdata('status','danger');
            $this->session->set_flashdata('msg_confirm','Não foi Possível Salvar Produto!');
        }
        redirect('produto');
    }
    
    public function editar($id=null){
        
        $dados['produto']=  $this->Produto_manager->get_produto($id);
        $this->carrega_view('edicao_produto',$dados);
    }
    
    
    
    public function excluir($id){
        $retorno=$this->Produto_manager->excluir($id);
        
        if($retorno==-1){
            $this->session->set_flashdata('status','danger');
            $msg="Este Produto está relacionado a alguma Venda.<br> Exclua o Produto da Venda Primeiro!";
            $this->session->set_flashdata('msg_confirm',$msg); 
        }
        elseif($retorno==1){
           $this->session->set_flashdata('status','success');
           $this->session->set_flashdata('msg_confirm','Produto Excluído com Sucesso!');
        }
        else{
            $this->session->set_flashdata('status','danger');
            $this->session->set_flashdata('msg_confirm','Não foi possível Excluir Produto!');
        }
        redirect('produto');
    }
    
    public function get_produtos_ajax($tipo=null){
       
        $produtos=$this->Produto_manager->get_produtos($tipo);
       if(!$produtos) $produtos=array();
         $lista = array();
        foreach ($produtos as $produto) {
            $lista[] = $produto->transformar_em_array();
        }
         
        echo json_encode($lista);
       
    }
    
    public function abrir_filtro($tipo){
        if($tipo=='3') return $this->index();
        $dados['produtos']=$this->Produto_manager->get_produtos($tipo);
        $this->load->model('produto/Produto_layout');
        $dados['colunas']=$this->Produto_layout->get_colunas($tipo);
        $dados['tipo']=$tipo;
        $this->carrega_view('manter_produtos',$dados);
        
    }
    
    
    
}

