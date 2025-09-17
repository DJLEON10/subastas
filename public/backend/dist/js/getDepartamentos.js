$(document).ready(function() {
    $('#pais').on('change', function() {
        var paisId = this.value;
        $('#departamento').html(''); // Vaciar el contenido actual de los departamentos

        // Leer la URL de la ruta desde el atributo de datos
        var getDepartamentosRoute = $('#departamento').data('route');

        // Utilizar la URL de la ruta para realizar la solicitud AJAX
        $.ajax({
            url: getDepartamentosRoute + '?pais_id=' + paisId,
            type: 'GET',
            success: function(res) {
                $('#departamento').html('<option value="">Seleccione Departamento</option>');
                $.each(res, function(key, value) {
                    $('#departamento').append('<option value="' + value.id + '">' + value.nombre + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar departamentos:', error);
            }
        });
    });
});
