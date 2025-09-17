@extends('layouts.app')

@section('title','Crear Ciudad')

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
						<form method="POST" action="{{ route('ciudads.store') }}">
							@csrf
							<div class="card-body">
								<div class="row">
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
										<div class="form-group label-floating">
											<label class="control-label" for="departamento">Departamento <strong style="color:red;">(*)</strong></label>
											<select class="form-control" id="departamento" name="departamento_id" data-route="{{ route('getDepartamentos') }}">
											</select>
										</div>
									</div>
									<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
										<div class="form-group label-floating">
											<label class="control-label">Nombre <strong style="color:red;">(*)</strong></label>
											<input type="text" class="form-control" name="nombre" placeholder="Por ejemplo, Ocaña" autocomplete="off" value="{{ old('nombre') }}">
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
										<a href="{{ route('ciudads.index') }}" class="btn btn-danger btn-block btn-flat">Atras</a>
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
	<script src="{{asset('backend/dist/js/getDepartamentos.js')}}"></script>
@endpush
