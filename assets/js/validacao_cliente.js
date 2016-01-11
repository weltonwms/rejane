$(document).ready(function() {

/***********************Acao para o Botao Voltar**************************************/
	$("#voltar").click(function(){
		history.back();
	});//fechamento do click do voltar.
/*************************************************************************************/

/*********************Mascaras para os campos ****************************************/
	$('#cpf').mask("000.000.000-00");
	$('.telefone').mask("(00) 0000-0000");
        $('.data').mask("00/00/0000");

/*************************************************************************************/

/*****************Regras de validação*************************************************/
	$("#form_cliente").validate({
		rules:{
			nome:{required:true},
			//endereco:{required:true},
			telefone:{minlength: 14},
                        cpf:{verificaCPF:true, required:true},
                        data_nascimento:{date:true},
                        email:{email:true}
                        
			

		},
	
		messages:{
			nome:{required:'Digite o Nome'},
			//endereco:{required:'Digite o Endereço'},
			telefone:{minlength:'Telefone Incompleto'},
                        cpf:{required:'Digite o CPF'},
                        email:{email:'Informe Email Válido'}
                        
		}
	});//fechamento do validate
        
       
        include_once(base_url + "assets/js/datepicker.js");
        
        
});//fechamento do document.ready
