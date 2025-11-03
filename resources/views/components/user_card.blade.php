<div class="col-md-4 col-sm-6 mb-4">
    <div class="card text-center p-3 shadow-sm product-card">
        <div class="mb-3">
            @if($producto->image)
            <img src="{{ asset('uploads/producto/' . $producto->image) }}"
                alt="{{ $producto->nombre }}"
                style="display:block; width:100%; height:200px; object-fit:contain; object-position:center; border-radius:10px; background-color:#f8f9fa;"
                class="mx-auto d-block">

            @else
            <div style="width:100%; height:200px; background:#e9ecef; border-radius:8px;"
                class="d-flex align-items-center justify-content-center">
                <span class="text-muted small">Sin imagen</span>
            </div>
            @endif
        </div>

        <h5 class="product-title mb-1">
            {{ $producto->nombre }} {{ $producto->apellido }}
        </h5>
        <p class="text-muted small mb-2">{{ $producto->descripcion }}</p>

        <!-- Toggle y botones... (igual que antes) -->
        <div class="d-flex justify-content-center my-2">
            <input data-type="producto" data-id="{{ $producto->id }}"
                class="toggle-class" type="checkbox"
                data-onstyle="success" data-offstyle="danger"
                data-toggle="toggle" data-on="Activo" data-off="Inactivo"
                {{ $producto->estado ? 'checked' : '' }}>
        </div>

        <div class="d-flex justify-content-center mt-2">
            @if(Auth::user()->rol != '0')
            <a href="{{ route('productos.edit', $producto->id) }}"
                class="btn btn-info btn-sm mx-1" title="Editar">
                <i class="fas fa-pencil-alt"></i>
            </a>
            @endif

            <a href="{{ route('productos.show', $producto->id) }}"
                class="btn btn-primary btn-sm mx-1" title="Ver">
                <i class="fas fa-eye"></i>
            </a>

            @if(Auth::user()->rol != '0')
            <form action="{{ route('productos.destroy', $producto->id) }}"
                method="POST" class="d-inline delete-form mx-1">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </form>
            @endif
        </div>
    </div>
</div>