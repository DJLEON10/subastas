<div class="card mt-3">
    <div class="card-body">
        <h5>Pujar por: {{ $producto->nombre }}</h5>

        <p><strong>Precio actual:</strong> ${{ number_format($producto->precio, 0, ',', '.') }}</p>
        <p><strong>Incremento mínimo:</strong> ${{ number_format($producto->incrementoMinimo, 0, ',', '.') }}</p>

        <input type="number" wire:model="nuevoMonto" class="form-control mb-2" placeholder="Ingresa tu puja">
        <button wire:click="hacerPuja" class="btn btn-primary w-100 btn-subasta">Pujar</button>
    </div>

    <div class="card mt-3">
        <div class="card-header">Historial de pujas</div>
        <ul class="list-group list-group-flush">
            @foreach($pujas as $puja)
            <li class="list-group-item d-flex justify-content-between">
                <span>{{ $puja['user']['name'] ?? 'Usuario desconocido' }}</span>
                <span class="text-danger fw-bold">${{ number_format($puja['monto'], 2, ',', '.') }}</span>
            </li>
            @endforeach
        </ul>
    </div>
</div>

{{-- SweetAlert listener --}}
<script>
    document.addEventListener('livewire:navigated', () => {
        window.Livewire.on('swal', e => {
            Swal.fire({
                icon: 'success',
                title: e.message,
                showConfirmButton: false,
                timer: 1800
            });
        });

        window.Livewire.on('swal:error', e => {
            Swal.fire({
                icon: 'error',
                title: 'Oops... No puedes pujar por debajo del valor actual ',
                text: e.message,
                confirmButtonColor: '#d33'
            });
        });
    });
</script>