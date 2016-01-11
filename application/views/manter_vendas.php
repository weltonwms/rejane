<?php echo "<script src='" . base_url('assets/plugins/jquery.confirm.js') . "'></script>"; ?>
<?php echo "<script src='" . base_url('assets/js/modalexclusao.js') . "'></script>"; ?>
<?php echo "<script src='" . base_url('assets/plugins/data_table.js') . "'></script>"; ?>
<?php echo "<script src='" . base_url('assets/js/tabela.js') . "'></script>"; ?>
<?php echo "<script src='" . base_url('assets/js/manter_vendas.js') . "'></script>"; ?>

<legend>Lista de Vendas</legend>

<?php if ($this->session->flashdata('msg_confirm') != null): ?>
    <div class="alert alert-<?php echo $this->session->flashdata('status') ?> alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php $icone = $this->session->flashdata('status') == 'danger' ? 'remove' : 'ok' ?>
        <?php echo "<span class=\"glyphicon glyphicon-$icone  \"></span>&nbsp" ?>
        <?php echo $this->session->flashdata('msg_confirm') ?>
    </div>
<?php endif; ?>

<a href="<?php echo base_url('venda/editar') ?>" type="button"
   class="btn btn-success navbar-right"> <span
        class="glyphicon glyphicon-plus"></span> Nova Venda
</a>
<br>


<!--inicio da tabela com lista de vendas-->


<table id="tabela" class="table table-bordered table-striped custab table-condensed">
    <thead>
        <tr class="text-primary">
            <th class="col-md-1">Cód Venda</th>
            <th>Cliente</th>
            
            <th>Data</th>
            <th>Forma pgt</th>
            <th>Total</th>
            <th class="text-center col-md-1"><span class="glyphicon glyphicon-print"></span> Imprimir</th>
            <th class="text-center col-md-1"><span class="glyphicon glyphicon-pencil"></span> Editar</th>
            <th class="text-center col-md-1"><span class="text-danger"><span class="glyphicon glyphicon-trash">
                    </span>Excluir</span>
            </th>


        </tr>
    </thead>

    <tbody>

        <?php
        if ($vendas):
            foreach ($vendas as $venda):
                ?>
                <tr>
                    <td>
                        <a href="#" class="detalhe_venda" 
                          data-id_venda="<?php echo $venda->get_id(); ?>">
                        <?php echo $venda->get_id(); ?>
                        </a>
                    </td>
                    <td><?php echo $venda->get_nome_cliente(); ?></td>
                   
                   
                    <td><?php echo $venda->get_data(); ?></td>
                    <td class=""><?php echo $venda->get_forma_pagamento(); ?></td>
                     <td class=""><?php echo $venda->get_total_itens_venda_formatado(); ?></td>
                    <td class="text-center">
                        <a target="_blank" 
                           href="<?php echo base_url('venda/imprimir') . '/' . $venda->get_id() ?>">
                            <span class="glyphicon glyphicon-print"></span> 
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="<?php echo base_url('venda/editar') . '/' . $venda->get_id() ?>">
                            <span class="glyphicon glyphicon-pencil"></span> 
                        </a>
                    </td>
                    <td class="text-center">
                        <a class="confirm_venda text-danger" 
                           href="<?php echo base_url('venda/excluir') . '/' . $venda->get_id() ?>">
                            <span class="glyphicon glyphicon-trash"></span>
                        </a>
                    </td>

                </tr>
            <?php
            endforeach;
        endif;
        ?>

    </tbody>


</table>


<!--inicio do modal detalhar Serviço-->

<div class="modal fade" id="modal_detalhar_venda">
    <div class="modal-dialog largura_ideal">
        <div class="modal-content">


            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><span class="glyphicon glyphicon-th"></span> Detalhes da Venda</h4>
            </div>
            <div class="modal-body">
                <div id="conteudo_modal"></div>

            </div> <!-- /.modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Fechar</button>

            </div>


        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

