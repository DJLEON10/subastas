@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">Detalles del Slider</h1>
                </div>
                <div class="card-body">
                    <p><strong>Título:</strong> {{ $slider->titulo }}</p>
                    <p><strong>Descripción:</strong> {{ $slider->descripcion ?? 'No disponible' }}</p>
                    <p><strong>Nombre del Botón:</strong> {{ $slider->nombre_boton }}</p>
                    <p><strong>Link del Botón:</strong>
                        <a href="{{ $slider->link_boton }}" target="_blank">{{ $slider->link_boton }}</a>
                    </p>
                    <p><strong>Estado:</strong> {{ $slider->estado == 1 ? 'Activo' : 'Inactivo' }}</p>

                    <p>
                        @if ($slider->imagen!=null)
                        <label class="control-label">Imagen <strong style="color:red;">(*)</strong></label>
                    <p>
                        <img src="{{ asset('uploads/sliders/'.$slider->imagen) }}" style="height: 70px; width: 70px" alt="">
                    </p>

                    @elseif ($slider->imagen==null)

                    @endif
                                </p>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('sliders.index') }}" class="btn btn-primary">Volver a la lista</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection