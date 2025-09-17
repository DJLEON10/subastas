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

                // Seleccionar el departamento previamente guardado
                var oldDepartamento = $('#departamento').data('old');
                if (oldDepartamento) {
                    $('#departamento').val(oldDepartamento);
                    loadCiudad(); // Cargar las ciudades correspondientes
                }
            }).fail(function () {
                console.error("Error al cargar los departamentos.");
            });
        }
    }

    function loadCiudad() {
        var departamento_id = $('#departamento').val();
        var route = $('#ciudad').data('route'); // Obtener la URL de la ruta desde el atributo data-route

        if ($.trim(departamento_id) !== '') {
            $.get(route, { departamento_id: departamento_id }, function (ciudades) {
                $('#ciudad').empty();
                $('#ciudad').append("<option value=''>Seleccione Ciudad</option>");

                // Recorrer las ciudades y agregarlas al select
                $.each(ciudades, function (index, ciudad) {
                    $('#ciudad').append("<option value='" + ciudad.id + "'>" + ciudad.nombre + "</option>");
                });

                // Seleccionar la ciudad previamente guardada
                var oldCiudad = $('#ciudad').data('old');
                if (oldCiudad) {
                    $('#ciudad').val(oldCiudad);
                }
            }).fail(function () {
                console.error("Error al cargar las ciudades.");
            });
        }
    }

    loadDepartamento(); // Cargar departamentos al cargar la página
    $('#pais').on('change', function () {
        $('#ciudad').empty(); // Limpiar el select de ciudades cuando cambie el país
        loadDepartamento();
    });

    $('#departamento').on('change', loadCiudad); // Cargar ciudades al cambiar el departamento
});
