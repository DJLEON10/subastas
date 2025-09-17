@extends('layouts.app')

@section('title','Crear Familiar')

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
						<form method="POST" action="{{ route('familiares.store') }}">
							@csrf
							<div class="card-body">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
										<div class="form-group label-floating">
											<label class="control-label">Habitante <strong style="color:red;">(*)</strong></label>
											<select class="form-control" name="habitante_id" id="habitante" value="{{ old('habitante') }}">
												<option value>Seleccione Habitante</option>
												@foreach($habitantes as $habitante)
													<option value="{{ $habitante->id }}">{{ $habitante->nombre }}</option>
												@endforeach
                    						</select>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
										<div class="form-group label-floating">
											<label class="control-label">Nombre <strong style="color:red;">(*)</strong></label>
											<input type="text" class="form-control" name="nombre" placeholder="Por ejemplo, Carolina" autocomplete="off" value="{{ old('nombre') }}">
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
										<div class="form-group label-floating">                                            
                                                <label for="parentezco">Parentezco <strong style="color:red;">(*)</strong></label>
                                                <select name="parentezco" id="parentezco">
                                                    <option value="">Seleccione un Parentezo</option>
                                                    <option value="Hermano">Hermano</option>
                                                    <option value="Papa">Papa</option>
                                                    <option value="Mama">Mama</option>
                                                    <option value="Primo">Primo</option>
                                                    <option value="Sobrino">Sobrino</option>
                                                    <option value="Ti@">Ti@</option>
													<option value="Amigo">Amigo</option>
													<option value="Otro">Otro</option>
                                                </select>                                            
                                        </div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
										<div class="form-group label-floating">
											<label class="control-label">direccion <strong style="color:red;">(*)</strong></label>
											<input type="text" class="form-control" name="direccion" placeholder="Por ejemplo, kdx ----" autocomplete="off" value="{{ old('direccion') }}">
										</div>
										<div class="form-group label-floating">
											<label class="control-label">celular <strong style="color:red;">(*)</strong> </label>
											<input type="text" class="form-control" name="celular" placeholder="Por ejemplo, 368456987" autocomplete="off" value="{{ old('celular') }}">
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
										<a href="{{ route('familiares.index') }}" class="btn btn-danger btn-block btn-flat">Atras</a>
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
