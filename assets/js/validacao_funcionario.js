$(document).ready(function() {
$('.meu_chosen').chosen();
/***********************Acao para o Botao Voltar**************************************/
	$("#voltar").click(function(){
		history.back();
	});//fechamento do click do voltar.
/*************************************************************************************/

/*********************Mascaras para os campos ****************************************/
	$('#cpf').mask("000.000.000-00");
	$('.telefone').mask("(00) 0000-0000");

/*************************************************************************************/

$.validator.setDefaults({ ignore: ":hidden:not(.meu_chosen)" });


/*****************Regras de validação*************************************************/
	$("#form_funcionario").validate({
		rules:{
			nome:{required:true},
                        telefone:{required:true, minlength: 14},
			cpf:{required:true,verificaCPF:true},
                        "especialidades[]":{required:true}
			

		},
	
		messages:{
			nome:{required:'Digite o Nome do Funcionário'},
			telefone:{required:'Digite o Telefone',minlength:'Telefone Incompleto'},
                        cpf:{required:'Digite o CPF'},
                        "especialidades[]":{required:'Escolha uma ou mais Especialidade'}
		}
	});//fechamento do validate
        
       
        
        
        
});//fechamento do document.ready
