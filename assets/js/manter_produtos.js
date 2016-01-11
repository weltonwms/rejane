$(document).ready(function() {
   
    $('#selecao_produto').change( function() {
        tipo=$(this).val();
        var url = base_url+"produto/abrir_filtro/"+tipo;
        $(location).attr('href',url);
        
    });
    
     



}); //fechamento do ready