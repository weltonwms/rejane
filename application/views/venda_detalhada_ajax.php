
<table  class=" table table-condensed" >
   
    <tbody>
        <tr>
            <td class="col-md-1">
                <b>Serviço nº </b>
            </td>
            <td>
                <?php echo $venda->get_id();?>
                
            </td>
            <td class="col-md-3">
                <b>Forma de Pagamento </b>
            </td>
            <td>
                <?php echo $venda->get_forma_pagamento();?>
                
            </td>
            
        </tr>
         <tr>
             <td class="col-md-2">
                <b>Data</b>
            </td>
            <td>
                <?php echo $venda->get_data();?>
            </td>
            <td class="col-md-2">
               
            </td>
            <td>
                
                
            </td>
        </tr>
         <tr>
            <td>
                <b>Cliente</b>
            </td>
            <td>
                <?php echo $venda->get_nome_cliente();?>
            </td>
             <td class="col-md-2">
               <b>Tel. Cliente</b>
            </td>
            <td>
                <?php echo $venda->get_telefone_cliente();?>
                
            </td>
        </tr>
        
        
        
        
       
    </tbody>
</table>


<h3 class="text-center">Produto(s)</h3>
<table class=" table table-bordered" >
    <thead>
        <tr>
            <th>Funcionário</th>
            <th>Qtd</th>
            <th>Discriminação</th>
            <th>Preço Un</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>

        <?php foreach ($venda->get_itens_venda() as $item): ?>
            <tr>
                 <td><?php echo $item->get_nome_funcionario() ?></td>
                <td><?php echo $item->get_qtd() ?></td>
                <td><?php echo $item->get_nome_produto() ?></td>
               
                <td><?php echo "R$ " . number_format($item->get_valor_venda(), 2, ",", "."); ?></td>
                <td>
                    <?php echo "R$ " . number_format($item->get_valor_total(), 2, ",", "."); ?>
                   
                </td>
            </tr>
        <?php endforeach; ?>
        <tr id="preco_total">
            <td colspan="4" align="right"> <b>Total Geral</b<</td>
            <td><?php echo "R$ " . number_format($venda->get_total_itens_venda(), 2, ",", "."); ?></td>
        </tr>
    </tbody>
</table>





