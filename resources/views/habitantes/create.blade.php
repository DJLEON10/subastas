@extends('layouts.app')

@section('title','Crear Habitante')

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
                        <form method="POST" action="{{ route('habitantes.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="card-header" style="background-color:#70AADB ; color:white">
										<h4 class="title">Datos De Habitante de Calle</h4>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Nombre <strong style="color:red;">(*)</strong></label>
                                            <input type="text" class="form-control" name="nombre" placeholder="Por ejemplo, camilo " autocomplete="off" value="{{ old('nombre') }}">
                                        </div>
                                    </div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Apellido <strong style="color:red;">(*)</strong></label>
                                            <input type="text" class="form-control" name="apellido" placeholder="Por ejemplo, cifuentes" autocomplete="off" value="{{ old('apellido') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">descripcion <strong style="color:red;">(*)</strong></label>
                                            <input type="text" class="form-control" name="descripcion" placeholder="Por ejemplo, drogas , alcohol" autocomplete="off" value="{{ old('descripcion') }}">
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
													<option value="{{ $tipodocumento->id }}">{{ $tipodocumento->nombre }}</option>
												@endforeach
											</select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Numero de Documento <strong style="color:red;">(*)</strong></label>
                                            <input type="text" class="form-control" name="numerodocumento" placeholder="Por ejemplo, 1106956387" autocomplete="off" value="{{ old('numerodocumento') }}">
                                        </div>
                                    </div>
								</div>
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Imagen <strong style="color:red;">(*)</strong></label>
                                            <input type="file" class="form-control-file" name="image" id="image" >
                                        </div>
                                    </div>
								</div>
								<div class="row">
									<div class="card-header" style="background-color:#70AADB ; color:white">
										<h4 class="title">Datos De Nacimiento</h4>
                                    </div>
									<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                                        <label class="control-label" for="pais">País <strong style="color:red;">(*)</strong></label>
                                        <select id="pais" name="pais_id" class="form-control">
                                            <option value="">Seleccione País</option>
                                            @foreach($paises as $pais)
                                                <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                                        <label class="control-label" for="departamento">Departamento <strong style="color:red;">(*)</strong></label>
                                        <select id="departamento" name="departamento_id" class="form-control" data-route="{{ route('getDepartamentos') }}">
                                            <option value="">Seleccione Departamento</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                                        <label class="control-label" for="ciudad">Ciudad <strong style="color:red;">(*)</strong></label>
                                        <select id="ciudad" name="ciudad_id" class="form-control" data-route="{{ route('getCiudads') }}">
                                            <option value="">Seleccione Ciudad</option>
                                        </select>
                                    </div>
								</div><br>
								<div class="row">
									<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                                        <div class="form-group label-floating">                                            
                                                <label for="comuna">Comuna</label>
                                                <select name="comuna" id="comuna">
                                                    <option value=""></option>
                                                    <option value="comuna_1">Comuna 1</option>
                                                    <option value="comuna_2">Comuna 2</option>
                                                    <option value="comuna_3">Comuna 3</option>
                                                    <option value="comuna_4">Comuna 4</option>
                                                    <option value="comuna_5">Comuna 5</option>
                                                    <option value="comuna_6">Comuna 6</option>
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
    <script src="{{ asset('backend/dist/js/getCiudads.js') }}"></script>
@endpush
