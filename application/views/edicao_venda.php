<?php
echo "<script src='" . base_url('assets/plugins/jquery.validate.js') . "'></script>";
echo "<script src='" . base_url('assets/plugins/jquery.mask.js') . "'></script>";
echo "<script src='" . base_url('assets/js/validacao_venda.js') . "'></script>";
echo "<script src='" . base_url('assets/plugins/jquery.confirm.js') . "'></script>";
echo "<script src='" . base_url('assets/js/modalexclusao.js') . "'></script>";
echo link_tag(array('href' => 'assets/plugins/chosen/chosen.css', 'rel' => 'stylesheet', 'type' => 'text/css'));
echo "<script src='" . base_url('assets/plugins/chosen/chosen.jquery.js') . "'></script>";
?>
<legend>
    <?php
    if ($venda->get_id())
        echo 'Alteração de  Venda';
    else
        echo 'Novo Venda';
    ?>


</legend>

<?php if ($this->session->flashdata('msg_confirm') != null): ?>
    <div class="alert alert-<?php echo $this->session->flashdata('status') ?> alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php $icone = $this->session->flashdata('status') == 'danger' ? 'remove' : 'ok' ?>
        <?php echo "<span class=\"glyphicon glyphicon-$icone  \"></span>&nbsp" ?>
        <?php echo $this->session->flashdata('msg_confirm') ?>
    </div>
<?php endif; ?>


<form method="post" action="<?php echo base_url('venda/manter_itens_venda') ?>" id="form_venda">
    <input type="hidden" name="id" value="<?php echo $venda->get_id(); ?>"/>
    <div class="col-md-12">
        <div class="navbar-right ">
            <button formaction="<?php echo base_url('venda/salvar_venda') ?>"
                    type="submit" class="btn btn-success" id="salvar">
                <span class="glyphicon glyphicon-save"></span> Salvar e Fechar
            </button>
            <a href="<?php echo base_url('venda') ?>"
               class="btn btn-default">
                <span class="glyphicon glyphicon-arrow-left"></span> Voltar
            </a>

        </div>
    </div>

    
    <div class="control-group col-md-7">
        <label class="control-label">Cliente</label>

        <select  name="id_cliente" class="form-control meu_chosen" >
            <option value="">--Selecione--</option>
            <?php
            foreach ($clientes as $cliente):
                echo "<option value='{$cliente->get_id()}' ";
                if ($cliente->get_id() == $venda->get_id_cliente())
                    echo "selected='selected'";
                echo ">";
                echo $cliente->get_nome();
                echo "</option>";
            endforeach;
            ?>
        </select>

    </div>





    <div class="control-group col-md-2">
        <label class="control-label ">Data Venda</label> 

        <input 	id="data" type="text" class="form-control data datepicker" name='data'
                value="<?php echo ($venda->get_data() != '') ? $venda->get_data() : date('d/m/Y'); ?>">

    </div>





    <div class="control-group col-md-3">
        <label class="control-label ">Forma Pagamento</label> 

        <input 	id="forma_pagamento" type="text" class="form-control" name='forma_pagamento'
                value="<?php echo $venda->get_forma_pagamento() ?>">

    </div>

    <br><br>









    <!--inicio do modal de adicionar ou alterar Item de Venda-->

    <div class="modal fade" id="modal_manter_item_venda">
        <div class="modal-dialog largura_ideal">
            <div class="modal-content">


                <input type="hidden" name="id_item_venda" id="id_item_venda" value=""/>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Adicionar Produto</h4>
                </div>
                <div class="modal-body altura_minima">
                    <div class="form-group col-md-4">
                        <label class="control-label ">Tipo</label>

                        <select  id="tipo" name="tipo" class="form-control" >
                            <option value="">--Selecione--</option>
                            <option value="1">Serviço</option>
                            <option value="2">Produto</option>
                        </select>


                    </div> 

                    <div class="form-group col-md-8 display_produto">
                        <label class="control-label ">Produto</label>

                        <select  id="id_produto" name="id_produto" class="form-control meu_chose" >
                            <option value="">--Selecione--</option>
                            <?php
                            foreach ($produtos as $produto):
                                echo "<option value='{$produto->get_id()}' ";
                                //if($produto->get_id_produto()==$venda->get_id_produto()) echo "selected='selected'";
                                echo ">";
                                echo $produto->get_nome();
                                echo "</option>";
                            endforeach;
                            ?>

                        </select>


                    </div> 






                    <div class="form-group col-md-12">
                        <label class="control-label">Qtd</label>

                        <input id="qtd" type="text"
                               value=""
                               class="form-control" name='qtd' placeholder="Qtd">

                    </div>

                    <div class="form-group col-md-12">
                        <label class="control-label">Funcionário</label>

                        <select  id="id_funcionario" name="id_funcionario" class="form-control meu_chosen" >
                            <option value="">--Selecione--</option>
                            <?php
                            foreach ($funcionarios as $funcionario):
                                echo "<option value='{$funcionario->get_id()}' ";
                                //if ($funcionario->get_id() == $venda->get_id_funcionario())
                                    //echo "selected='selected'";
                                echo ">";
                                echo $funcionario->get_nome();
                                echo "</option>";
                            endforeach;
                            ?>
                        </select>

                    </div>




                </div> <!-- /.modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button id="btn_submit_tudo"  class="btn btn-success">Salvar</button>
                </div>


            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


</form>




<br><br><br><br>
<div class="row">
    <div class="col-md-12" style="">
        <btn href="<?php echo base_url('') ?>" type="button"
             id="btn_adicionar_item_venda" class="btn btn-default navbar-right"> <span
                class="glyphicon glyphicon-plus"></span> Novo Item
        </btn>
        <table id="tabela" class="table table-bordered table-striped custab table-condensed">
            <thead>
                <tr class="text-primary">
                    <th>Funcionário</th>
                    <th>Qtd</th>
                    <th class="col-md-6">Discriminação</th>
                    <th >Valor Un</th>
                    <th>Total</th>

                    <th><span class="glyphicon glyphicon-pencil"></span> Editar</th>
                    <th><span class="text-danger"><span class="glyphicon glyphicon-trash">
                            </span>Excluir</span>
                    </th>

                </tr>
            </thead>

            <tbody>
                <?php foreach ($venda->get_itens_venda() as $item_venda): ?> 
                    <tr>
                        <td><?php echo $item_venda->get_nome_funcionario() ?></td>
                        <td><?php echo $item_venda->get_qtd() ?></td>
                        <td><?php echo $item_venda->get_nome_produto() ?></td>
                        <td><?php echo "R$ " . number_format($item_venda->get_valor_venda(), 2, ",", "."); ?></td>
                        <td><?php echo "R$ " . number_format($item_venda->get_valor_total(), 2, ",", "."); ?></td>
                        <td>
                            <a data-id_item_venda="<?php echo $item_venda->get_id() ?>" 
                               data-id_produto="<?php echo $item_venda->get_id_produto() ?>"
                               data-qtd="<?php echo $item_venda->get_qtd() ?>"
                               data-tipo="<?php echo $item_venda->get_tipo() ?>"
                               data-id_funcionario="<?php echo $item_venda->get_id_funcionario() ?>"
                               class="editar_item_venda"
                               href="#">
                                <span class="glyphicon glyphicon-pencil"></span> 
                            </a>

                        </td>
                        <td>
                            <a class="confirm_item_venda text-danger" 
                               href="<?php
                               echo base_url('venda/excluir_item_venda') . '/' .
                               $item_venda->get_id() . '/' . $venda->get_id()
                               ?>">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>

                        </td>
                    </tr>

                <?php endforeach; ?>
                <tr>
                    <td colspan="4" class="text-center "><b>Total Geral</b></td>
                    <td colspan="3"><?php echo $venda->get_total_itens_venda_formatado() ?></td>
                </tr>

            </tbody>


        </table>

    </div>
</div>

<script>


    $("#btn_adicionar_item_venda").click(function() {
        $('.modal-title').html('Adicionar Item de venda');
        $("#id_item_venda").val('');
        $("#tipo").val('');
        $("#id_produto").val('').trigger("chosen:updated");
        $("#id_funcionario").val('').trigger("chosen:updated");
        $('.display_produto').hide();
        $("#qtd").val('');


        $("#modal_manter_item_venda").modal('show');
    });

    $("#btn_submit_tudo").click(function() {


        $("#form_venda").submit();
    });

    $(".editar_item_venda").click(function() {

        $('.display_produto').show();
        id_item_venda = ($(this).attr('data-id_item_venda'));
        tipo = ($(this).attr('data-tipo'));
        id_produto = ($(this).attr('data-id_produto'));
        id_funcionario = ($(this).attr('data-id_funcionario'));
        qtd = ($(this).attr('data-qtd'));
        valor_venda = ($(this).attr('data-valor_venda'));

        $("#tipo").val(tipo);
        $('.modal-title').html('Alterar Item de Venda');
        $("#id_item_venda").val(id_item_venda);
        $("#qtd").val(qtd);
        $("#id_produto").val(id_produto);
        $("#id_funcionario").val(id_funcionario).trigger("chosen:updated");
       
        $('#tipo').trigger('change');
        $("#modal_manter_item_venda").modal('show');
    });







</script>

