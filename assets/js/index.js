$(document).ready(function() {
    $('.generar_reporte').click(function() {
        let idSitio = $(this).data("id");
        let token = $(this).data("token");
        $.ajax({
            url: 'api/procesarSitioId/'+idSitio,
            headers: { 'Token':token},
            dataType: 'json',
        })
        .done(successFunction)
        .fail(failFunction);
    });

    function successFunction(data)  {
        $('#cod-'+data.idSitio).text(data.estado);
    }

    function failFunction(request, textStatus, errorThrown) {
        $('#cod-'+data.idsitio).text('Error en la respuesta: ' + request.status + ' ' + textStatus + ' ' + errorThrown);
    }
    // resolución de moviles
    // 
       $('.iphone12').click( function() { 
            $('#movil').width(390);
        });
        $('.samsungs20').click( function() { 
            $('#movil').width(412);
        });
           $('.samsungs8').click( function() { 
            $('#movil').width(360);
        });

});