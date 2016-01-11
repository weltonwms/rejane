<?php
echo "<script src='".base_url('assets/plugins/jquery.validate.js')."'></script>";
echo "<script src='".base_url('assets/plugins/jquery.mask.js')."'></script>";
echo "<script src='".base_url('assets/js/validacao_cliente.js')."'></script>";
?>
<legend>
    <?php
    if ($cliente->get_id())
        echo 'Alteração de  Cliente';
    else
        echo 'Cadastro de Novo Cliente';
    ?>

</legend>


	<form method="post" id="form_cliente">
            <input type="hidden" name="id" value="<?php echo $cliente->get_id();?>"/>
                        <div class="col-md-6 control-group ">

				<label class="control-label" for="Nome">Nome</label> 
                                <input id="nome" name="nome" placeholder="Nome"
                                       value="<?php echo $cliente->get_nome();?>"
					class="form-control" type="text">

			</div>
                        <div class="col-md-6 control-group">
				<label class="control-label">Endereço</label>
                                <input id="endereco" type="text"
                                       value="<?php echo $cliente->get_endereco();?>"
					class="form-control" name='endereco' placeholder="Endereço">
			</div>
			<div class="col-md-6 control-group">
				<label class="control-label">Telefone</label>
                                <input id="telefone" type="text"
                                       value="<?php echo $cliente->get_telefone();?>"
					class="form-control telefone" name='telefone' placeholder="Telefone">
			</div>
			
			
			<div class="col-md-6 control-group">
				<label class="control-label">Dt Nascimento</label> 
                                    <input id="data_nascimento" type="text" 
                                         value="<?php echo $cliente->get_data_nascimento();?>"
                                        class="form-control data datepicker" name='data_nascimento' 
                                        placeholder="Dt Nascimento">
			</div>
            
                         <div class="col-md-6 control-group">
				<label class="control-label">CPF</label>
                                <input id="cpf" type="text"
                                        value="<?php echo $cliente->get_cpf();?>"
					class="form-control" name='cpf'
                                        placeholder="CPF">
			</div>
			
			
			<div class="col-md-6 control-group">
				<label class="control-label">Email</label> <input
					id="email" type="text" class="form-control"
                                        value="<?php echo $cliente->get_email();?>"
                                        name='email'
					placeholder="Email">
			</div>
			
                   
                    <div class="control-group col-md-7 col-md-offset-5">
                        <br><br>
				<button formaction="<?php echo base_url('cliente/salvar')?>"
					type="submit" class="btn btn-success" id="salvar">
					<span class="glyphicon glyphicon-save"></span> Salvar
				</button>
				<button id="voltar"
					type="button" class="btn btn-default">
					<span class="glyphicon glyphicon-arrow-left"></span> Voltar
				</button>

			</div>
		

		
	</form>
