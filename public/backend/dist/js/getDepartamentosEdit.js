$(document).ready(function () {
    function loadDepartamento() {
        var pais_id = $('#pais').val();
        var route = $('#departamento').data('route'); // Obtener la URL de la ruta desde el atributo data-route

        if ($.trim(pais_id) !== '') {
            $.get(route, { pais_id: pais_id }, function (departamentos) {
                $('#departamento').empty();
                $('#departamento').append("<option value=''>Seleccione Departamento</option>");

                // Recorrer los departamentos y agregarlos al select
                $.each(departamentos, function (index, departamento) {
                    $('#departamento').append("<option value='" + departamento.id + "'>" + departamento.nombre + "</option>");
                });

                // Si hay un valor antiguo, seleccionarlo
                var old = $('#departamento').data('old');
                if (old) {
                    $('#departamento').val(old);
                }
            }).fail(function () {
                console.error("Error al cargar los departamentos.");
            });
        }
    }

    loadDepartamento(); // Cargar departamentos al cargar la página
    $('#pais').on('change', loadDepartamento); // Cargar departamentos al cambiar el país
});
