<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Impressão de Venda</title>
        <style>
            
            
            div{
                padding: 2px;
                margin: 8px;
                font-family: "arial","Bitstream Vera Sans", sans-serif;
                font-size: 15px;
            }

            div.quadradinho{
                padding: 2px;
                margin: 0 60px 0 0;
                text-align: right;
                padding-left: 5px;
            }
            .container{
               
                width:100%;
               padding: 20px;

            }

            #logo{
                

                /*max-width: 40%;*/
            }

            #tipo_venda{
                border: 2px solid;
                font-size: 14px;
                /*width: 240px;*/
           }

            #info_cliente{
               
                line-height: 25px;
                padding:9px;
            }

            #discriminacao{
               
               /* border: 2px solid;*/
            }

            #endereco{
                
                padding-top: 30px;
                margin-top: 20px;
                font-size: 11px;
                
            }
            
            #endereco td{
                text-align: center;
                
            }
            .borda{
                border: 1px solid;
            }

            .coluna1_tipo_venda{
                
            }

            .coluna2_info_cliente{
                min-width: 175px;
            }

            .borda_topo{
               border-top: 1px solid;
              
            }

            .destaque{
                background-color:  #E5E5DB;
            }

           
            
            #discriminacao table #preco_total td:first-child{
                border-left:none ;
                border-bottom: none;
                font-weight: bold;
            }
            
             #discriminacao table #preco_total td:last-child{
                
            }
            
            #discriminacao table td, #discriminacao table th{
                border: 1px solid;
            }
        </style>
    </head>
    <body>
        <?php
        $base_url = FCPATH;
        
        ?>


        <div class="container">
            <table   width="100%" cellspacing='0' cellpadding='0'>
                <tr>
                    <td width="50%">
                        <div id="log">
                            <img src="<?php echo $base_url ?>assets/imgs/logo_impressao.png" alt="Log" width="390px"> 
                        </div>
                    </td>

                    <td>
                        <div id="tipo_venda">
                            <table >
                                <tr >
                                    <td  class="coluna1_tipo_venda"> Nº Venda </td>
                                    <td><?php echo $venda->get_id()?></td>
                                </tr>
                                
                                <tr>
                                    <td>Data </td>
                                    <td><?php echo $venda->get_data()?> </td>
                                </tr>
                                <tr>
                                    <td>&nbsp; </td>
                                    <td>&nbsp; </td>
                                </tr>
                                <tr>
                                    <td>&nbsp; </td>
                                    <td>&nbsp; </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>

            </table>





            <div id="info_cliente">
                <table>
                    <tr>
                        <td>Cliente:</td>
                        <td width='200' class="coluna2_info_cliente"><?php echo $venda->get_nome_cliente()?></td>
                        <td colspan="2">CPF: <?php echo $venda->get_cpf_cliente()?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        
                    </tr>
                    <tr>
                        <td>Endereço:</td>
                        <td colspan="3"><?php echo $venda->get_endereco_cliente()?></td>
                    </tr>
                    <tr>
                        <td>Fone:</td>
                        <td colspan="3"><?php echo $venda->get_telefone_cliente()?></td>
                        
                        
                    </tr>
                </table>
            </div>
            <div id="discriminacao">
                <table width='100%' cellspacing='0' cellpadding='5'>
                    <tr class='destaque'>
                        
                        <th width="5%">Qtd</th>
                        <th width="60%">Discriminação</th>
                        <th width="15%">Preço Un</th>
                        <th width="15%">Total</th>
                    </tr>
                   <?php foreach($venda->get_itens_venda() as $item):?>
                    <tr>
                       
                        <td><?php echo $item->get_qtd() ?></td>
                        <td><?php echo $item->get_nome_produto()?></td>
                         <td><?php echo "R$ " . number_format($item->get_valor_venda(), 2, ",", "."); ?></td>
                         <td><?php echo "R$ " . number_format($item->get_valor_total(), 2, ",", "."); ?></td>
                    </tr>
                    <?php endforeach;?>
                    <tr id="preco_total">
                        <td colspan="3" align="right"> Total Geral</td>
                        <td class="destaque"><?php echo "R$ " . number_format($venda->get_total_itens_venda(), 2, ",", "."); ?></td>
                    </tr>
                </table>
            </div>
            <div id="endereco">
                <!--<h4>Valparaíso de Goiás <span class='data-final'> ______/_______/_______</span></h4>--><br>
                <table  width="100%" cellspacing='0' cellpadding='0'>
                    <tr>
                        <td width="50%"><div class='borda_topo'>Cliente</div></td>
                        <td><div class='borda_topo'>Contratante</div></td>
                    </tr>
                </table>


            </div>
        </div>






        <!--
        <script type="text/php">


            if ( isset($pdf) ) {
            $data= date('d-m-Y');
            $texto="Sistema Gerenciador de Mensalidades";
            $font = Font_Metrics::get_font("helvetica", "bold"); $pdf->page_text(220, 760, "{$texto} ", $font, 9, array(0,0,0));
            $font2 = Font_Metrics::get_font("helvetica", "bold"); $pdf->page_text(535, 760, " PG: {PAGE_NUM} de {PAGE_COUNT}", $font2, 9, array(0,0,0));
            $font3 = Font_Metrics::get_font("helvetica", "bold"); $pdf->page_text(30, 760, "{$data} ", $font3, 9, array(0,0,0));
            } </script>
        -->
    </body>
</html>







