<?php echo "<script src='" . base_url('assets/plugins/jquery.confirm.js') . "'></script>"; ?>
<?php echo "<script src='" . base_url('assets/js/modalexclusao.js') . "'></script>"; ?>
<?php echo "<script src='" . base_url('assets/plugins/data_table.js') . "'></script>"; ?>
<?php echo "<script src='" . base_url('assets/js/tabela.js') . "'></script>"; ?>
<?php echo "<script src='" . base_url('assets/js/manter_produtos.js') . "'></script>"; ?>
<legend>Lista de Produtos / Svc Cadastrados</legend>

<?php if ($this->session->flashdata('msg_confirm') != null): ?>
    <div class="alert alert-<?php echo $this->session->flashdata('status') ?> alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php $icone = $this->session->flashdata('status') == 'danger' ? 'remove' : 'ok' ?>
        <?php echo "<span class=\"glyphicon glyphicon-$icone  \"></span>&nbsp" ?>
        <?php echo $this->session->flashdata('msg_confirm') ?>
    </div>
<?php endif; ?>

<select id="selecao_produto">
    <option <?php if($tipo=='3') echo "selected='selected'"?> value="3">Tudo</option>
    <option <?php if($tipo=='1') echo "selected='selected'"?> value="1">Serviço</option>
    <option <?php if($tipo=='2') echo "selected='selected'"?> value="2">Produto</option>
</select>
<a href="<?php echo base_url('produto/editar') ?>" 
   class="btn btn-success navbar-right"> <span
        class="glyphicon glyphicon-plus"></span> Novo Produto
</a>
<br>


<!--inicio da tabela com lista de produtos-->


<table id="tabela" class="table table-bordered table-striped custab table-condensed">
    <thead>
        <tr class="text-primary">
            <?php
            foreach ($colunas as $coluna):
                echo "<th>$coluna</th>";
            endforeach;
            ?>

            <th><span class="glyphicon glyphicon-pencil"></span> Editar</th>
            <th><span class="text-danger"><span class="glyphicon glyphicon-trash">
                    </span>Excluir</span>
            </th>

        </tr>
    </thead>

    <tbody>

<?php
if ($produtos):
    foreach ($produtos as $produto):
        ?>
                <tr>
                <?php
                foreach ($colunas as $key => $valor):
                    $metodo = "get_" . $key;
                    echo "<td>{$produto->$metodo()}</td>";
                endforeach;
                ?>
                    <td>
                        <a href="<?php echo base_url('produto/editar') . '/' . $produto->get_id() ?>">
                            <span class="glyphicon glyphicon-pencil"></span> 
                        </a>
                    </td>
                    <td class="text-center">
                        <a class="confirm_produto text-danger" 
                           href="<?php echo base_url('produto/excluir') . '/' . $produto->get_id() ?>">
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


