<div class="col-md-4">
    <div class="card text-center p-3">
        <div class="form-group label-floating">
            @if($habitante->image)
                <img src="{{ asset('uploads/habitante/'.$habitante->image) }}" 
                     alt="{{ $habitante->nombre }}" width="150px">
            @else
                No hay imagen disponible.
            @endif
        </div> 
        
        <h5>{{ $habitante->nombre }} {{ $habitante->apellido }}</h5>
        <p>{{ $habitante->descripcion }}</p>

        <!-- ✅ Toggle centrado -->
        <div class="d-flex justify-content-center my-2">
            <input data-type="habitante" data-id="{{ $habitante->id }}" 
                   class="toggle-class" type="checkbox" 
                   data-onstyle="success" data-offstyle="danger" 
                   data-toggle="toggle" data-on="Activo" data-off="Inactivo" 
                   {{ $habitante->estado ? 'checked' : '' }}>
        </div>

        <!-- ✅ Botones alineados horizontalmente -->
        <div class="d-flex justify-content-center mt-2">
            @if(Auth::user()->rol != '0')
                <a href="{{ route('habitantes.edit', $habitante->id) }}" 
                   class="btn btn-info btn-sm mx-1" title="Editar">
                    <i class="fas fa-pencil-alt"></i>
                </a>
            @endif
            <a href="{{ route('habitantes.show', $habitante->id) }}"class="btn btn-primary btn-sm" title="Ver"><i class="fas fa-eye"></i></a>

            @if(Auth::user()->rol != '0')
            <form action="{{ route('habitantes.destroy', $habitante->id) }}" method="POST" class="d-inline delete-form">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
    </form>

            @endif
        </div>
    </div>
</div>
