<?php
echo "<script src='".base_url('assets/plugins/jquery.validate.js')."'></script>";
echo "<script src='".base_url('assets/plugins/jquery.mask.js')."'></script>";
echo "<script src='".base_url('assets/js/validacao_produto.js')."'></script>";
echo link_tag(array('href'=>'assets/plugins/chosen/chosen.css','rel'=>'stylesheet','type'=>'text/css'));
echo "<script src='".base_url('assets/plugins/chosen/chosen.jquery.js')."'></script>";
?>
<legend>
    <?php
    if ($produto->get_id())
        echo 'Alteração de  Produto';
    else
        echo 'Cadastro de Novo Produto';
    ?>
</legend>


<form method="post" id="form_produto" class="form-horizontal">
     <input type="hidden" name="id" value="<?php echo $produto->get_id();?>"/>
    <div class="row">
    <div class=" col-md-6">
        <fieldset>
            <legend>Produto</legend>
           
        
                        <div class="form-group ">

				<label class="control-label col-md-4" for="nome">Nome</label> 
                                <div class="col-md-8">
                                    <input id="nome" name="nome" placeholder="Nome"
                                           value="<?php echo $produto->get_nome()?>"
					class="form-control" type="text">
                                </div>

			</div>
                        
			<div class="form-group">
				<label class="control-label col-md-4">Valor de Venda</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">R$</span>
                                        <input id="valor_venda" type="text"
					class="form-control money" name='valor_venda' 
                                         value="<?php echo $produto->get_valor_venda()?>"
                                        placeholder="Valor Venda">
                                    </div>
                                </div>
			</div>
                         <div class="form-group">
				<label class="control-label col-md-4">Tipo</label>
                                <div class="col-md-8">
                                    <select  id="tipo" name="tipo" class="form-control" >
                                        <option value="">--Selecione--</option>
                                        <?php
                                        $tipos=array('1'=>'Serviço','2'=>'Produto');
                                        foreach ($tipos as $chave=>$tipo):
                                            echo "<option value='$chave' ";
                                            if($chave==$produto->get_tipo()) echo "selected='selected'";
                                            echo ">$tipo";
                                            echo "</option>";
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
			</div>
                        <div class="form-group display_valor_compra">
				<label class="control-label col-md-4">Valor de Compra</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">R$</span>
                                        <input id="valor_compra" type="text"
					class="form-control money" name='valor_compra' 
                                         value="<?php echo $produto->get_valor_compra()?>"
                                        placeholder="Valor Compra">
                                    </div>
                                </div>
			</div>
                        
                         <div class="form-group display_marca">

				<label class="control-label col-md-4" for="nome">Marca</label> 
                                <div class="col-md-8">
                                    <input id="marca" name="marca" placeholder="Marca"
                                           value="<?php echo $produto->get_marca()?>"
					class="form-control" type="text">
                                </div>

			</div>
            
                         <div class="form-group display_porcentagem ">

				<label class="control-label col-md-4" for="porcentagem">Porcentagem</label> 
                                <div class="col-md-4">
                                    <div class="input-group">
                                        
                                    <input id="porcentagem" name="porcentagem" placeholder="Porcentagem"
                                           value="<?php echo $produto->get_porcentagem()?>"
					class="form-control porcentagem" type="text">
                                    <span class="input-group-addon">%</span>
                                    </div>
                                </div>

			</div>
						
            
                       
            </fieldset>
                        
                      
                       
        </div>
        
       
    </div>
                    <div class="control-group col-md-7 col-md-offset-5">
				<button formaction="<?php echo base_url('produto/salvar')?>"
					type="submit" class="btn btn-success" id="salvar">
					<span class="glyphicon glyphicon-save"></span> Salvar
				</button>
				<button id="voltar"
					type="button" class="btn btn-default">
					<span class="glyphicon glyphicon-arrow-left"></span> Voltar
				</button>

			</div>
		

		
	</form>
