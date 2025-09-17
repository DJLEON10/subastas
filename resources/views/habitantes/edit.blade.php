
@extends('layouts.app')

@section('title','Editar Institución')

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
                        <form method="POST" action="{{ route('habitantes.update' , $habitante->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="card-header" style="background-color:#70AADB ; color:white">
										<h4 class="title">Datos De Habitante de Calle</h4>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Nombre <strong style="color:red;">(*)</strong></label>
                                            <input type="text" class="form-control" name="nombre" placeholder="Por ejemplo, Institución Educativa José eusebio Caro" autocomplete="off" value="{{ $habitante->nombre }}">
                                        </div>
                                    </div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Apellido <strong style="color:red;">(*)</strong></label>
                                            <input type="text" class="form-control" name="apellido" placeholder="Por ejemplo, Juan Carlos Vargas" autocomplete="off" value="{{ $habitante->apellido }}">
                                        </div>
                                    </div>
								</div>
								<div class="row">
                                    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                                        <div class="form-group label-floating">
											<label class="control-label" for="tipodocumento">Tipo Documento <strong style="color:red;">(*)</strong></label>
											<select id="tipodocumento" name="tipodocumento_id" class="form-control">
												<option value="">Seleccione Tipo Documento</option>
                                                @foreach($tipodocumentos as $tipodocumento)
                                                <option {{ $tipodocumento->id == $habitante->tipodocumento->id ? 'selected' : '' }} value="{{ $tipodocumento->id }}">{{ $tipodocumento->nombre }}</option>
                                                @endforeach
											</select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Numero de Documento <strong style="color:red;">(*)</strong></label>
                                            <input type="text" class="form-control" name="numerodocumento" placeholder="Por ejemplo, 1106956387" autocomplete="off" value="{{ $habitante->numerodocumento }}">
                                        </div>
                                    </div>
								</div>
                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Imagen <strong style="color:red;">(*)</strong></label>
                                            
                                            <!-- Mostrar la imagen actual -->
                                            @if($habitante->image)
                                                <img src="{{ asset('storage/' . $habitante->image) }}" alt="Escudo de la Institución" style="max-width: 100px; max-height: 100px;">
                                            @endif
                                            
                                            <!-- Campo para cargar una nueva imagen -->
                                            <input type="file" class="form-control-file" name="image" id="image">
                                            
                                            <!-- Guardar la ruta de la imagen actual en un campo oculto -->
                                            <input type="hidden" name="current_image" value="{{ $habitante->image }}">
                                        </div>
                                </div>
								
								<div class="row">
									<div class="card-header" style="background-color:#70AADB ; color:white">
										<h4 class="title">Datos De Ubicación</h4>
                                    </div>
									<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                                        <label class="control-label" for="pais">País <strong style="color:red;">(*)</strong></label>
                                            <select id="pais" name="pais_id" class="form-control">
                                                <option value="">Seleccione País</option>
                                                @foreach($paises as $pais)
                                                    <option value="{{ $pais->id }}" {{ $pais->id == $habitante->ciudad->departamento->pais->id ? 'selected' : '' }}>
                                                        {{ $pais->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                                        <label class="control-label" for="departamento">Departamento <strong style="color:red;">(*)</strong></label>
                                        <select id="departamento" name="departamento_id" class="form-control " data-route="{{ route('getDepartamentosEdit') }}">
                                            <option value="">Seleccione Departamento</option>
                                            @foreach($departamentos as $departamento)
                                                <option value="{{ $departamento->id }}" {{ $departamento->id == $habitante->ciudad->departamento->id ? 'selected' : '' }}>
                                                    {{ $departamento->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                                        <label class="control-label" for="ciudad">Ciudad <strong style="color:red;">(*)</strong></label>
                                        <select id="ciudad" name="ciudad_id" class="form-control" data-route="{{ route('getCiudads') }}">
                                            <option value="">Seleccione Ciudad</option>
                                            @foreach($ciudads as $ciudad)
                                                <option value="{{ $ciudad->id }}" {{ $ciudad->id == $habitante->ciudad->id ? 'selected' : '' }}>
                                                    {{ $ciudad->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
								</div><br>
								<div class="row">
									<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                                    <div class="form-group label-floating">
                                            <label class="control-label">Comuna <strong style="color:red;">(*)</strong></label>
                                            <select class="form-control" name="comuna" id="comuna">
													<option {{old('comuna',$habitante->comuna)=="comuna_1"? 'selected':''}}  value="comuna_1">Comuna 1</option>
													<option {{old('comuna',$habitante->comuna)=="comuna_2"? 'selected':''}}  value="comuna_2">Comuna 2</option>
                                                    <option {{old('comuna',$habitante->comuna)=="comuna_3"? 'selected':''}}  value="comuna_3">Comuna 3</option>
                                                    <option {{old('comuna',$habitante->comuna)=="comuna_4"? 'selected':''}}  value="comuna_4">Comuna 4</option>
													<option {{old('comuna',$habitante->comuna)=="comuna_5"? 'selected':''}}  value="comuna_5">Comuna 5</option>
                                                    <option {{old('comuna',$habitante->comuna)=="comuna_6"? 'selected':''}}  value="comuna_6">Comuna 6</option>
										    </select>
                                        </div>
                                    </div>
								</div>	
                                <input type="hidden" class="form-control" name="estado" value="1">
                                <input type="hidden" class="form-control" name="registradopor" value="{{ Auth::user()->id }}">
                            
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-2 col-xs-4">
                                        <button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>
                                    </div>
                                    <div class="col-lg-2 col-xs-4">
                                        <a href="{{ route('habitantes.index') }}" class="btn btn-danger btn-block btn-flat">Atras</a>
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
    <script src="{{ asset('backend/dist/js/getCiudadsEdit.js') }}"></script>
    <script src="{{ asset('backend/dist/js/getDepartamentosEdit.js') }}"></script>

    <script src="{{ asset('backend/dist/js/getEdit.js') }}"></script>

@endpush



