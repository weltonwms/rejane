$(document).ready(function() {
    $('.meu_chosen').chosen();

    /***********************Acao para o Botao Voltar**************************************/
    $("#voltar").click(function() {
        history.back();
    });//fechamento do click do voltar.
    /*************************************************************************************/

    /*********************Mascaras para os campos ****************************************/
    $('.data').mask("00/00/0000");
    $('.money').mask('000.000.000.000.000,00', {reverse: true});

    /*************************************************************************************/

    $.validator.setDefaults({ignore: ":hidden:not(.meu_chosen)"});
    $("#form_venda").validate({
        rules: {
            id_funcionario: {required: true},
            id_cliente: {required: true},
            id_produto:{required:true},
            tipo:{required:true},
            data: {required: true},
            valor_venda: {required: true},
            forma_pagamento: {required: true},
            qtd: {required: true}


        },
        messages: {
            tipo:{required: 'Selecione o Tipo'},
            id_funcionario: {required: 'Selecione o Funcionário'},
            id_cliente: {required: 'Selecione o Cliente'},
            id_produto: {required: 'Selecione o Produto/Svc'},
            data: {required: 'Digite a Data'},
            valor_venda: {required: 'Digite o valor Final'},
            qtd: {required: 'Digite Qtd do Produto'},
            forma_pagamento: {required: "Digite a forma_pagamento"}
        }
    });//fechamento do validate
    
    
    $("#form_venda").on('change', '#tipo', function() {
        
        id_produto_atual= $('#id_produto').val();
        tipo=$(this).val();
        //alert(tipo);
       if(tipo=='1'){
           $('.display_produto label').html('Serviço');
           $('.display_produto').show();
       }else if(tipo=='2'){
           $('.display_produto').show();
           $('.display_produto label').html('Produto');
       }else {
          $('.display_produto').hide();
           $('.display_produto label').html('Produto/Svc');
       }
       
       
        $.ajax({
            type: "GET",
            dataType: "json",
            url: base_url + "produto/get_produtos_ajax/" + tipo,
            success: function(data)
            {
                
               
                var options="<option selected='selected' value=''>--Selecione--</option>";
                       
			for(i=0;i< data.length;i++){
                                options += '<option value="' + data[i].id + '">' + data[i].nome + '</option>';
                               
                         }
                         valor_organizacao_atual=$("#organizacao").val();
                         
                         $("#id_produto").html(options);
                         $("#id_produto").val(id_produto_atual);
                        // select.trigger("chosen:updated");
                      

            }

        });//fechamento do ajax
       
        

    });


    include_once(base_url + "assets/js/datepicker.js");


});//fechamento do ready



