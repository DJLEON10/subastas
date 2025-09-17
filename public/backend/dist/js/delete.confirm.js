$(document).ready(function() {
    $(document).on('submit', '.delete-form', function(e) {
        e.preventDefault();
        const form = this;
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Este registro se eliminará definitivamente',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});