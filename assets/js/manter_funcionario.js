$(document).ready(function() {
   
    $("#tabela").on('click', '.detalhe_funcionario', function() {
        id = ($(this).attr('data-id'));
        $.ajax({
            type: "GET",
            dataType: "html",
            url: base_url + "funcionario/detalhar_funcionario_ajax/" + id,
            success: function(data)
            {
                $('#conteudo_modal').html(data);
                $("#modal_detalhar_funcionario").modal('show');

            }

        });//fechamento do ajax

    });
    
     



}); //fechamento do ready