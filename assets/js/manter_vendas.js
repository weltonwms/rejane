$(document).ready(function() {
   
         



    $("#tabela").on('click', '.detalhe_venda', function() {
        id_venda = ($(this).attr('data-id_venda'));
        $.ajax({
            type: "GET",
            dataType: "html",
            url: base_url + "venda/detalhar_venda_ajax/" + id_venda,
            success: function(data)
            {
                $('#conteudo_modal').html(data);
                $("#modal_detalhar_venda").modal('show');

            }

        });//fechamento do ajax

    });
    
     




});