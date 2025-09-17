@extends('layouts.app')

@section('content')
    <div class="container mt-5 d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">Editar Slider</h2>
                </div>
                <div class="card-body">
                    
                    {{-- Mensaje de éxito --}}
                    @if (session('successMsg'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('successMsg') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Formulario de edición --}}
					<form action="{{ route('sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="form-group">
        <label for="titulo">Título</label>
        <input type="text" name="titulo" value="{{ old('titulo', $slider->titulo) }}" class="form-control" required>
    </div>
    
    <div class="form-group">
        <label for="nombre_boton">Nombre del Botón</label>
        <input type="text" name="nombre_boton" value="{{ old('nombre_boton', $slider->nombre_boton) }}" class="form-control" required>
    </div>
    
    <div class="form-group">
        <label for="link_boton">Link del Botón</label>
        <input type="url" name="link_boton" value="{{ old('link_boton', $slider->link_boton) }}" class="form-control">
    </div>
    
    <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" class="form-control">{{ old('descripcion', $slider->descripcion) }}</textarea>
    </div>

                        <div class="mb-3">
                            <label for="imagen" class="form-label fw-bold">Imagen</label>
                            <input type="file" name="imagen" class="form-control">
                            @if($slider->imagen)
                                <div class="mt-3">
                                    <label class="form-label">Imagen Actual:</label>
                                    <img src="{{ asset('uploads/slider/' . $slider->imagen) }}" alt="Imagen actual" class="img-thumbnail" style="width: 150px;">
                                </div>
                            @endif
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-lg mt-3">Guardar Cambios</button>
                            <a href="{{ route('sliders.index') }}" class="btn btn-secondary btn-lg mt-3">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
