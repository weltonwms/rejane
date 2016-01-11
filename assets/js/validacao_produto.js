$(document).ready(function() {
 
 
 /***********************Acao para o Botao Voltar**************************************/
	$("#voltar").click(function(){
		history.back();
	});//fechamento do click do voltar.
/*************************************************************************************/

/*********************Mascaras para os campos ****************************************/
	$('.data').mask("00/00/0000");
        $('.porcentagem').mask("00,00", {reverse: true});
	$('.money').mask('000.000.000.000.000,00', {reverse: true});

/*************************************************************************************/
        
        $("#form_produto").validate({
		rules:{
			nome:{required:true},
                        valor_venda:{required:true},
                        tipo: {required:true},
                        valor_compra:{required:true},
                        marca: {required:true},
                        porcentagem: {required:true}
                        
			
		},
	
		messages:{
			nome:{required:'Digite o Nome do Produto'},
                       	valor_venda:{required:'Digite o valor'},
                        tipo:{required:'Selecione o Tipo'},
                        valor_compra:{required:'Digite o valor de Compra'},
                        marca:{required:'Digite a marca'},
                        porcentagem:{required:'Digite a porcentagem'}
			
		}
	});//fechamento do validate

        $("#tipo").change(function(){
            var tipo=$( "#tipo option:selected" ).val();
            if(tipo=='1'){
                $('.display_valor_compra').hide();
                $('.display_marca').hide();
                $('.display_porcentagem').show();
            }
            else if(tipo=='2'){
                $('.display_valor_compra').show();
                $('.display_marca').show();
                $('.display_porcentagem').hide();
            }
            else{
                 $('.display_valor_compra').hide();
                $('.display_marca').hide();
                $('.display_porcentagem').hide();
            }
        });
        $( "#tipo" ).trigger( "change" );







});//fechamento do ready