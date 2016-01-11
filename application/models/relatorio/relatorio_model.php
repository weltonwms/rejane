<?php


class Relatorio_model extends CI_Model{
  private $itens_servico; //lista de Item_servico_composite
  
  function __construct() {
      parent::__construct();
  }
  
  public function set_itens_servico(array $itens_servico){
      $this->itens_servico=$itens_servico;
  }
  
  public function get_itens_servico(){
      return $this->itens_servico;
  }
  
  public function get_valor_total(){
      /*
      $valor=0;
      foreach ($this->mensalidades as $mensalidade):
          $valor+=$mensalidade->get_valor();
      endforeach;
      return $valor;
       * 
       */
  }

}

?>