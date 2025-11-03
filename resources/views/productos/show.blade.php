@extends('layouts.app')

@section('title', 'Datos del producto ' .$producto->nombre)
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid"></div>
    </section>
    @include('layouts.partial.msg')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-secondary">
                            <h3>@yield('title')</h3>
                        </div>
                        @csrf
                        <div class="card-body">
                            {{-- Imagen --}}
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 text-center mb-3">
                                <div class="form-group">
                                    @if($producto->image)
                                    <img src="{{ asset('uploads/producto/'.$producto->image) }}"
                                        alt="{{ $producto->nombre }}"
                                        width="150px"
                                        class="img-thumbnail">
                                    @else
                                    <p>No hay imagen disponible.</p>
                                    @endif
                                </div>
                            </div>


                            <div class="row">
                                <div class="card-header" style="background-color:#3A0B19; color:white">
                                    <h4 class="title">Datos Del producto</h4>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="control-label">Nombre</label>
                                        <p class="cuadro">{{ $producto->nombre }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="control-label">Cantidad</label>
                                        <p class="cuadro">{{ $producto->cantidad }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="control-label">Precio</label>
                                        <p class="cuadro">{{ $producto->precio }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="control-label">Incremento Minimo</label>
                                        <p class="cuadro">{{ $producto->incrementoMinimo }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="control-label">Categoria</label>
                                        <p class="cuadro">{{ $producto->categoria }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="control-label">Fecha de Inicio</label>
                                        <p class="cuadro">{{ $producto->fechaInicio }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="control-label">Fecha de Fin</label>
                                        <p class="cuadro">{{ $producto->fechaFin }}</p>
                                    </div>
                                </div>
                            </div>
                           <div class="row">
                                <div class="card-header" style="background-color:#3A0B19; color:white">
                                    <h4 class="title">Datos De Ubicación</h4>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label">País</label>
                                        <p class="cuadro">{{ $pais->nombre }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label">Departamento</label>
                                        <p class="cuadro">{{ $departamento->nombre }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label">Ciudad</label>
                                        <p class="cuadro">{{ $producto->ciudad->nombre }}</p>
                                    </div>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="card-header text-center" style="background-color:#3A0B19; color:white;">
                                    <h4 class="title">Descripción</h4>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <div class="form-group">
                                        <p class="cuadro">{{ $producto->descripcion }}</p>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" name="estado" value="1">
                            <input type="hidden" class="form-control" name="registradopor" value="{{ Auth::user()->id }}">
                        </div>
                        <div class="card-footer">
                            <div class="row">
                            <livewire:pujar-producto :producto-id="$producto->_id" />
                            <div class="col-lg-2 col-xs-4">
                                    <a href="{{ route('productos.index') }}" class="btn btn-danger btn-block btn-flat">Atrás</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="{{ asset('backend/dist/js/getCiudads.js') }}"></script>
@endpush