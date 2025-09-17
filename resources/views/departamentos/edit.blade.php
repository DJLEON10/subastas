@extends('layouts.app')

@section('title','Editar Departamento')

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
						<form method="POST" action="{{ route('departamentos.update',$departamento) }}">
							@csrf
							@method('PUT')
							<div class="card-body">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
										<div class="form-group label-floating">
											<label class="control-label">País <strong style="color:red;">(*)</strong></label>
											<select class="form-control" name="pais" id="pais" disabled>
												@foreach($paises as $pais)
												<option {{ $pais->id == $departamento->pais->id ? 'selected' : '' }} value="{{ $pais->id }}">{{ $pais->nombre }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
										<div class="form-group label-floating">
											<label class="control-label">Nombre <strong style="color:red;">(*)</strong></label>
											<input type="text" class="form-control" name="nombre" placeholder="Por ejemplo, Norte De Santander" autocomplete="off" value="{{ $departamento->nombre }}">
										</div>
									</div>
								</div>
								<input type="hidden" class="form-control" name="registradopor" value="{{ Auth::user()->id }}">
							</div>
							<div class="card-footer">
								<div class="row">
									<div class="col-lg-2 col-xs-4">
										<button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>
									</div>
									<div class="col-lg-2 col-xs-4">
										<a href="{{ route('departamentos.index') }}" class="btn btn-danger btn-block btn-flat">Atras</a>
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

@endpush