class CustomDataTable {
    constructor(id) {
        this.id = id;
        this.initializeDataTable();
    }

    initializeDataTable() {
        $(this.id).DataTable({
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            language: {
                sLengthMenu: "Mostrar_MENU_entradas",
                sEmptyTable: "No hay datos disponibles en la tabla",
                sInfo: "Mostrando_START_a_END_de_TOTAL_entradas",
                sInfoEmpty: "Mostrando 0 a 0 de 0 entradas",
                sSearch: "Buscar:",
                sZeroRecords: "No se encontraron registros coincidentes en la tabla",
                sInfoFiltered: "(Filtrado de_MAX_entradas totales)",
                oPaginate: {
                    sFirst: "Primero",
                    sPrevious: "Anterior",
                    sNext: "Siguiente",
                    sLast: "Último"
                }
            }
        });
    }
}

// Uso de la clase CustomDataTable
// $(document).ready(function() {
//     const myDataTable = new CustomDataTable('#example1');
    
    $(document).ready(function() {
        // Inicializa DataTables
        var table = $('#example1').DataTable();
    
        // Reaplica el toggle cada vez que DataTables vuelve a renderizar la tabla
        table.on('draw.dt', function() {
            $('.toggle-class').bootstrapToggle();
        });
    });
