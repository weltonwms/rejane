<?php
echo "<script src='" . base_url('assets/plugins/jquery.validate.js') . "'></script>";
echo "<script src='" . base_url('assets/plugins/jquery.mask.js') . "'></script>";
echo "<script src='" . base_url('assets/js/validacao_funcionario.js') . "'></script>";
echo link_tag(array('href' => 'assets/plugins/chosen/chosen.css', 'rel' => 'stylesheet', 'type' => 'text/css'));
echo "<script src='" . base_url('assets/plugins/chosen/chosen.jquery.js') . "'></script>";
?>
<legend>
    <?php
    if ($funcionario->get_id())
        echo 'Alteração de  Funcionário';
    else
        echo 'Cadastro de Novo Funcionário';
    ?>
</legend>


<form method="post" id="form_funcionario">
    <input type="hidden" name="id" value="<?php echo $funcionario->get_id(); ?>"/>
    <div class="col-md-6 control-group ">

        <label class="control-label" for="nome">Nome</label> 
        <input id="nome" name="nome" placeholder="Nome"
               value="<?php echo $funcionario->get_nome(); ?>"
               class="form-control" type="text">

    </div>

    <div class="col-md-6 control-group ">

        <label class="control-label" for="telefone">Telefone</label> 
        <input id="telefone" name="telefone" placeholder="Telefone"
               value="<?php echo $funcionario->get_telefone(); ?>"
               class="form-control telefone" type="text">

    </div>
    <div class="col-md-6 control-group ">

        <label class="control-label" for="fone">CPF</label> 
        <input id="cpf" name="cpf" placeholder="CPF"
               value="<?php echo $funcionario->get_cpf(); ?>"
               class="form-control " type="text">

    </div>

    <div class="col-md-6 control-group ">

        <label class="control-label" for="del_porcentagem"></label> 
        <div class="checkbox">
            <label>
                <input value="1" id="del_porcentagem" name="del_porcentagem" 
                <?php if ($funcionario->get_del_porcentagem() == '1') echo "checked='checked'" ?>

                       class=" " type="checkbox">
                <strong> Retirar Porcentagem</strong></label>

        </div>

    </div>

    <div class="control-group col-md-6">
        <label class="control-label">Especialidades</label>

        <select  id="especialidades" data-placeholder="Selecione Especialidade(s)" 
                 name="especialidades[]" class="form-control meu_chosen" multiple>

            <?php
            foreach ($especialidades as $especialidade):
                echo "<option value='{$especialidade->id}' ";
                foreach ($funcionario->get_especialidades() as $id => $esp):
                    if ($especialidade->id == $id)
                        echo "selected='selected'";
                endforeach;
                echo ">";
                echo $especialidade->nome;
                echo "</option>";
            endforeach;
            ?>
        </select>

    </div>




    <div class="control-group col-md-7 col-md-offset-5">
        <br><br>
        <button formaction="<?php echo base_url('funcionario/salvar') ?>"
                type="submit" class="btn btn-success" id="salvar">
            <span class="glyphicon glyphicon-save"></span> Salvar
        </button>
        <button id="voltar"
                type="button" class="btn btn-default">
            <span class="glyphicon glyphicon-arrow-left"></span> Voltar
        </button>

    </div>



</form>
