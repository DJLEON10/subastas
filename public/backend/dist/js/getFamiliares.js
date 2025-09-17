$(document).ready(function() {
    $('#habitante').on('change', function() {
        var habitanteId = this.value;
        $('#familiares').html(''); // Vaciar el contenido actual de familiares

        // Leer la URL de la ruta desde el atributo data
        var getFamiliaresRoute = $('#familiares').data('route');

        // Hacer la solicitud AJAX
        $.ajax({
            url: getFamiliaresRoute,
            type: 'GET',
            data: {
                habitante_id: habitanteId
            },
            success: function(response) {
                // Suponiendo que response es una lista de familiares
                $.each(response, function(key, value) {
                    $('#familiares').append('<option value="' + value.id + '">' + value.nombre + '</option>');
                });
            },
            error: function(xhr) {
                console.error('Error al obtener familiares:', xhr.responseText);
            }
        });
    });
});