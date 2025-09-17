@extends('layouts.app')

@section('title','Editar Familiar')

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
						<form method="POST" action="{{ route('familiares.update', $familiar) }}">
						@csrf
							@method('PUT')
							<div class="card-body">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
										<div class="form-group label-floating">
											<label class="control-label">Habitante <strong style="color:red;">(*)</strong></label>
											<select class="form-control" name="habitante_id" id="habitante_id" >
												@foreach($habitantes as $habitante)
													<option {{ $habitante->id == $familiar->habitante->id ? 'selected' : '' }} value="{{ $habitante->id }}">{{ $habitante->nombre }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
										<div class="form-group label-floating">
											<label class="control-label">Nombre <strong style="color:red;">(*)</strong></label>
											<input type="text" class="form-control" name="nombre" placeholder="Por ejemplo, Norte De Santander" autocomplete="off" value="{{ $familiar->nombre }}">
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
										<div class="form-group label-floating">
                                            <label class="control-label">Parentezco <strong style="color:red;">(*)</strong></label>
                                            <select class="form-control" name="parentezco" id="parentezco">
                                                <option {{old('parentezco',$familiar->parentezco)=="Hermano"? 'selected':''}}  value="Hermano">Hermano</option>
											    <option {{old('parentezco',$familiar->parentezco)=="Papa"? 'selected':''}}  value="Papa">Papa</option>
                                                <option {{old('parentezco',$familiar->parentezco)=="Mama"? 'selected':''}}  value="Mama">Mama</option>
												<option {{old('parentezco',$familiar->parentezco)=="Primo"? 'selected':''}}  value="Primo">Primo</option>
                                                <option {{old('parentezco',$familiar->parentezco)=="Sobrino"? 'selected':''}}  value="Sobrino">Sobrino</option>
                                                <option {{old('parentezco',$familiar->parentezco)=="Ti@"? 'selected':''}}  value="Ti@">Ti@</option>
                                                <option {{old('parentezco',$familiar->parentezco)=="Amigo"? 'selected':''}}  value="Amigo">Amigo</option>
                                                <option {{old('parentezco',$familiar->parentezco)=="Otro"? 'selected':''}}  value="Otro">Otro</option>

										    </select>
                                        </div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
										<div class="form-group label-floating">
											<label class="control-label">direccion <strong style="color:red;">(*)</strong></label>
											<input type="text" class="form-control" name="direccion" placeholder="Por ejemplo, kdx ----" autocomplete="off" value="{{ $familiar->direccion }}">
										</div>
										<div class="form-group label-floating">
											<label class="control-label">celular <strong style="color:red;">(*)</strong> </label>
											<input type="text" class="form-control" name="celular" placeholder="Por ejemplo, 368456987" autocomplete="off" value="{{ $familiar->celular }}">
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

@push('scripts')

@endpush