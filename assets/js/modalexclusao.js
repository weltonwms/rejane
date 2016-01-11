$(document).ready(function() {

	$(".confirm").confirm({
		text : "Deseja realmente excluir este Cliente?",
		title : "  Exclusão de Cliente",
		confirmButton : " Excluir",
		cancelButton : " Cancelar"
	});
        
       
        
        $(".confirm_funcionario").confirm({
		text : "Deseja realmente excluir este Funcionário?",
		title : "  Exclusão de Funcionário",
		confirmButton : " Excluir",
		cancelButton : " Cancelar"
	});
        
        $(".confirm_produto").confirm({
		text : "Deseja realmente excluir este Produto / Svc?",
		title : "  Exclusão de Produto / Svc",
		confirmButton : " Excluir",
		cancelButton : " Cancelar"
	});
        
        $(".confirm_venda").confirm({
		text : "Deseja realmente excluir esta Venda?",
		title : "  Exclusão de Venda",
		confirmButton : " Excluir",
		cancelButton : " Cancelar"
	});
        
         $(".confirm_item_venda").confirm({
		text : "Deseja realmente excluir este Item de Venda?",
		title : "  Exclusão de Item de Venda",
		confirmButton : " Excluir",
		cancelButton : " Cancelar"
	});
        
       
});
