<?php
echo "<script src='" . base_url('assets/plugins/jquery.validate.js') . "'></script>";
echo "<script src='" . base_url('assets/plugins/jquery.mask.js') . "'></script>";
echo link_tag(array('href' => 'assets/plugins/chosen/chosen.css', 'rel' => 'stylesheet', 'type' => 'text/css'));
echo "<script src='" . base_url('assets/plugins/chosen/chosen.jquery.js') . "'></script>";
echo "<script src='" . base_url('assets/js/validacao_relatorio.js') . "'></script>";


?>
<legend>Relatório</legend>


<div class="row">
    <form id='form_relatorio' action="<?php echo base_url('relatorio/gerar_relatorio') ?>" method="post">

        <div class="col-md-3">
            <label class=""><span
                    class="glyphicon glyphicon-filter"></span> Cliente:</label>
            <div class="">
                <select  name="id_cliente" class="form-control meu_chosen" >
                    <option value=''>--Todos--</option>
                    <?php
                    foreach ($clientes as $cliente):
                        echo "<option value='{$cliente->get_id_cliente()}' ";
                        if (isset($requisicao['id_cliente']) &&
                                $requisicao['id_cliente'] == $cliente->get_id_cliente()
                        )
                            echo "selected='selected'";
                        echo ">";
                        echo $cliente->get_nome();
                        echo "</option>";
                    endforeach;
                    ?>
                </select>

            </div>
        </div>

        <div class="col-md-3">
            <label class=""><span
                    class="glyphicon glyphicon-filter"></span> Produto:</label>
            <div class="">
                <select  id="id_produto" name="id_produto" class="form-control meu_chosen" >
                    <option value="">--Todos--</option>
                    <?php
                    foreach ($produtos as $produto):
                        echo "<option value='{$produto->get_id_produto()}' ";
                        if (isset($requisicao['id_produto']) &&
                                $requisicao['id_produto'] == $produto->get_id_produto()
                        )
                            echo "selected='selected'";
                        echo ">";
                        echo $produto->get_nome_produto() . "  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {$produto->get_nome_fornecedor()}";
                        echo "</option>";
                    endforeach;
                    ?>

                </select>

            </div>
        </div>



        <div class="col-md-3">
            <label class=""><span
                    class="glyphicon glyphicon-filter"></span> Ordenador Por:</label>
            <div class="">
                <select name="ordenado_por" class="form-control">
                    <option value=''>--Selecione--</option>
                    <?php
                        $opcoes=array('cliente'=>'Cliente', 'produto'=>'Produto',
                            'data'=>'Data','id_servico'=>'Serviço');
                        foreach ($opcoes as $key=>$opcao):
                        echo "<option value='{$key}' ";
                        if (isset($requisicao['ordenado_por']) &&
                                $requisicao['ordenado_por'] == $key
                        )
                            echo "selected='selected'";
                        echo ">";
                        echo $opcao;
                        echo "</option>";
                    endforeach;
                    ?>
                   

                </select>

            </div>
        </div>

        <div class="col-md-offset-1 col-md-2">
            <label>&nbsp;</label>
            <div>
                <button type="submit" class=" form-control btn btn-default ">Executar</button>
            </div>
        </div>

        <div class="col-md-3">
            <label class=""><span
                    class="glyphicon glyphicon-filter"></span> Período Inicial:</label>
            <div class="">
                <input type="text" name="periodo_inicial" 
                       value="<?php if (isset($requisicao['periodo_inicial'])) echo $requisicao['periodo_inicial'] ?>"
                       class="form-control data datepicker"/>

            </div>
        </div>



        <div class="col-md-3">
            <label class=""><span
                    class="glyphicon glyphicon-filter"></span> Período Final:</label>
            <div class="">
                <input type="text" name="periodo_final" 
                       value="<?php if (isset($requisicao['periodo_final'])) echo $requisicao['periodo_final'] ?>"
                       class="form-control data datepicker"/>

            </div>
        </div>

        <div class="col-md-3">
            <label class=""><span
                    class="glyphicon glyphicon-filter"></span> Estado:</label>
            <div class="">
                <select name="estado" class="form-control">
                    <option value=''>--Todos--</option>
                    <?php
                        $opcoes2=array('2'=>'Executado', '1'=>'Orçamento');
                            
                        foreach ($opcoes2 as $key=>$opcao):
                        echo "<option value='{$key}' ";
                        if (isset($requisicao['estado']) &&
                                $requisicao['estado'] == $key
                        )
                            echo "selected='selected'";
                        echo ">";
                        echo $opcao;
                        echo "</option>";
                    endforeach;
                    ?>

                </select>

            </div>
        </div>


    </form> 
</div><!--Fechamento da Row-->


<br>
<?php if (isset($relatorioxx)): ?>
    <form target='_blank' method="post">
        <input type="hidden" name="ultimo_post" value="<?php print base64_encode(serialize($post)) ?>"/>
        <button formaction="<?php echo base_url('relatorio/imprimir') ?>" type="submit"
                target='_blank' class="btn btn-success navbar-right"> <span
                class="glyphicon glyphicon-print"></span> Formato de Impressão
        </button>
    </form>
    <br><br>
<?php endif; ?>

<table id="tabela"
       class="table table-bordered table-striped custab table-condensed">
    <thead class="text-primary small">
        <tr>
            <th>Svç</th>
            <th>Data</th>
            <th>Produto</th>
            <th>Qtd</th>
            <th>Valor</th>
            <th>Cliente</th>
            <th>Estado</th>

        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($relatorio)):

            foreach ($relatorio->get_itens_servico() as $item_servico):
                ?>
                <tr>
                    <td><?php echo $item_servico->get_id_servico() ?></td>
                    <td><?php echo $item_servico->get_data_servico() ?></td> 
                    <td><?php echo $item_servico->get_nome_produto() ?></td>
                    <td><?php echo $item_servico->get_qtd_produto() ?></td>
                    <td><?php echo $item_servico->get_valor_final() ?></td>
                    <td><?php echo $item_servico->get_nome_cliente() ?></td>
                    <td><?php echo $item_servico->get_estado_servico() ?></td>
                </tr>  
                <?php
            endforeach;
        endif;
        ?>
    </tbody>
</table>





