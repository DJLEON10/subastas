@extends('layouts.app')

@section('title','Crear Producto')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
        </div>
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
                        {{-- ⚠ No cambiamos las rutas, se mantienen --}}
                        <form method="POST" action="{{ route('productos.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="card-header" style="background-color:#70AADB ; color:white">
                                        <h4 class="title">Datos del Producto</h4>
                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Nombre <strong style="color:red;">(*)</strong></label>
                                            <input type="text" class="form-control" name="nombre" placeholder="Ejemplo: Televisor Samsung" autocomplete="off" value="{{ old('nombre') }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-sm-6 col-md-3 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Precio <strong style="color:red;">(*)</strong></label>
                                            <input type="number" step="0.01" class="form-control" name="precio" placeholder="Ejemplo: 1500.00" value="{{ old('precio') }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-sm-6 col-md-3 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Cantidad <strong style="color:red;">(*)</strong></label>
                                            <input type="number" class="form-control" name="cantidad" placeholder="Ejemplo: 25" value="{{ old('cantidad') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="categoria" class="form-label fw-bold">Categoría del Producto</label>
                                            <select name="categoria" id="categoria" class="form-control categoria" data-nombre="categoria">
                                                <option value="">-- Selecciona una categoría --</option>

                                                <optgroup label="Tecnología">
                                                    <option value="electronica">Electrónica</option>
                                                    <option value="celulares">Celulares y Accesorios</option>
                                                    <option value="computadores">Computadores y Laptops</option>
                                                    <option value="videojuegos">Videojuegos y Consolas</option>
                                                    <option value="audio">Audio y Sonido</option>
                                                    <option value="televisores">Televisores</option>
                                                </optgroup>

                                                <optgroup label="Moda y Estilo">
                                                    <option value="ropa">Ropa</option>
                                                    <option value="calzado">Calzado</option>
                                                    <option value="accesorios">Accesorios</option>
                                                    <option value="joyeria">Joyería y Relojes</option>
                                                    <option value="belleza">Belleza y Cuidado Personal</option>
                                                </optgroup>

                                                <optgroup label="Hogar y Electrodomésticos">
                                                    <option value="muebles">Muebles</option>
                                                    <option value="electrodomesticos">Electrodomésticos</option>
                                                    <option value="decoracion">Decoración</option>
                                                    <option value="cocina">Cocina y Utensilios</option>
                                                    <option value="herramientas">Herramientas</option>
                                                </optgroup>

                                                <optgroup label="Coleccionables y Arte">
                                                    <option value="monedas">Monedas y Billetes</option>
                                                    <option value="figuras">Figuras y Miniaturas</option>
                                                    <option value="arte">Arte y Pinturas</option>
                                                    <option value="comics">Cómics y Cartas Coleccionables</option>
                                                </optgroup>

                                                <optgroup label="Deportes y Ocio">
                                                    <option value="deportes">Artículos Deportivos</option>
                                                    <option value="bicicletas">Bicicletas</option>
                                                    <option value="camping">Camping y Aventura</option>
                                                    <option value="fitness">Fitness y Gimnasio</option>
                                                </optgroup>

                                                <optgroup label="Vehículos">
                                                    <option value="autos">Autos</option>
                                                    <option value="motos">Motos</option>
                                                    <option value="partes">Partes y Accesorios</option>
                                                </optgroup>

                                                <optgroup label="Niños y Bebés">
                                                    <option value="juguetes">Juguetes</option>
                                                    <option value="ropa_bebe">Ropa de Bebé</option>
                                                    <option value="cuidado_bebe">Cuidado del Bebé</option>
                                                </optgroup>

                                                <optgroup label="Libros y Educación">
                                                    <option value="libros">Libros</option>
                                                    <option value="revistas">Revistas</option>
                                                    <option value="musica">Música y Películas</option>
                                                    <option value="instrumentos">Instrumentos Musicales</option>
                                                </optgroup>

                                                <optgroup label="Otros">
                                                    <option value="animales">Animales y Mascotas</option>
                                                    <option value="servicios">Servicios</option>
                                                    <option value="otros">Otros Productos</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Descripción <strong style="color:red;">(*)</strong></label>
                                            <textarea class="form-control" name="descripcion" rows="3" placeholder="Escribe una breve descripción...">{{ old('descripcion') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Incremento Minimo <strong style="color:red;">(*)</strong></label>
                                            <input type="number" class="form-control" name="incrementoMinimo" placeholder="" value="{{ old('incrementoMinimo') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Imagen <strong style="color:red;">(*)</strong></label>
                                            <input type="file" class="form-control-file" name="image" id="image">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Fecha de Inicio <strong style="color:red;">(*)</strong></label>
                                            <input type="date" class="form-control-file" name="fechaInicio" id="fechaInicio">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Fecha de Finalizacion <strong style="color:red;">(*)</strong></label>
                                            <input type="date" class="form-control-file" name="fechaFin" id="fechaFin">
                                        </div>
                                    </div>

                                </div>


                            </div>





                            <div class="row">
                                <div class="card-header" style="background-color:#70AADB ; color:white">
                                    <h4 class="title">Ubicación del Producto</h4>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-md-3 col-xs-12">
                                    <label class="control-label" for="pais">País <strong style="color:red;">(*)</strong></label>
                                    <select id="pais" name="pais_id" class="form-control">
                                        <option value="">Seleccione País</option>
                                        @foreach($paises as $pais)
                                        <option value="{{ $pais->_id }}">{{ $pais->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-md-3 col-xs-12">
                                    <label class="control-label" for="departamento">Departamento <strong style="color:red;">(*)</strong></label>
                                    <select id="departamento" name="departamento_id" class="form-control" data-route="{{ route('getDepartamentos') }}">
                                        <option value="">Seleccione Departamento</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-md-3 col-xs-12">
                                    <label class="control-label" for="ciudad">Ciudad <strong style="color:red;">(*)</strong></label>
                                    <select id="ciudad" name="ciudad_id" class="form-control" data-route="{{ route('getCiudads') }}">
                                        <option value="">Seleccione Ciudad</option>
                                    </select>
                                </div>

                            </div><br>

                            <input type="hidden" class="form-control" name="estado" value="1">
                            <input type="hidden" class="form-control" name="registradopor" value="{{ Auth::user()->id }}">
                    </div>

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-2 col-xs-4">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>
                            </div>
                            <div class="col-lg-2 col-xs-4">
                                <a href="{{ route('productos.index') }}" class="btn btn-danger btn-block btn-flat">Atrás</a>
                            </div>
                        </div>
                    </div>
                    </form>
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