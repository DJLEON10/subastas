@extends('layouts.app')

@section('title','Crear Slider')

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
						<div class="container">
							<form method="POST" action="{{ route('sliders.store') }}" enctype="multipart/form-data">
								@csrf
								<div class="card-body" style="padding: 30px; background-color: #f8f9fa; border-radius: 10px; border: 1px solid #e0e0e0; margin-top: 20px;">
									<div class="row">
										<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
											<div class="form-group" style="margin-bottom: 15px;">
												<label class="control-label" style="font-weight: bold; font-size: 15px; color: #fff; background-color: #17a2b8; padding: 5px 10px; border-radius: 5px;">
													Titulo <strong style="color: red;">(*)</strong>
												</label>
												<input type="text" class="form-control" name="titulo" placeholder="Por ejemplo, Titulo" autocomplete="off" value="{{ old('titulo') }}"
													style="border: 2px solid #ddd; border-radius: 5px; padding: 10px; font-size: 14px; color: #333; width: 100%; transition: border-color 0.3s, box-shadow 0.3s;">
											</div>
										</div>
										<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
											<div class="form-group" style="margin-bottom: 15px;">
												<label class="control-label" style="font-weight: bold; font-size: 15px; color: #fff; background-color: #17a2b8; padding: 5px 10px; border-radius: 5px;">
													Nombre Boton <strong style="color: red;">(*)</strong>
												</label>
												<input type="text" class="form-control" name="nombre_boton" placeholder="Por ejemplo, Nombre boton" autocomplete="off" value="{{ old('nombre_boton') }}"
													style="border: 2px solid #ddd; border-radius: 5px; padding: 10px; font-size: 14px; color: #333; width: 100%; transition: border-color 0.3s, box-shadow 0.3s;">
											</div>
										</div>
										<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
											<div class="form-group" style="margin-bottom: 15px;">
												<label class="control-label" style="font-weight: bold; font-size: 15px; color: #fff; background-color: #17a2b8; padding: 5px 10px; border-radius: 5px;">
													Link Boton <strong style="color: red;">(*)</strong>
												</label>
												<input type="text" class="form-control" name="link_boton" placeholder="Por ejemplo, link boton" autocomplete="off" value="{{ old('link_boton') }}"
													style="border: 2px solid #ddd; border-radius: 5px; padding: 10px; font-size: 14px; color: #333; width: 100%; transition: border-color 0.3s, box-shadow 0.3s;">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12 col-sm-24 col-md-12 col-xs-12">
											<div class="form-group" style="margin-bottom: 15px;">
												<label class="control-label" style="font-weight: bold; font-size: 15px; color: #fff; background-color: #17a2b8; padding: 5px 10px; border-radius: 5px;">
													Descripcion <strong style="color: red;">(*)</strong>
												</label>
												<textarea name="descripcion" id="descripcion" rows="4" class="form-control" placeholder="Descripción del slider..."
													style="border: 2px solid #ddd; border-radius: 5px; padding: 10px; font-size: 14px; color: #333; width: 100%; transition: border-color 0.3s, box-shadow 0.3s;"></textarea>
											</div>
										</div>
										<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
											<div class="form-group" style="margin-bottom: 15px;">
												<label class="control-label" style="font-weight: bold; font-size: 15px; color: #fff; background-color: #17a2b8; padding: 5px 10px; border-radius: 5px;">
													Imagen <strong style="color: red;">(*)</strong>
												</label>
												<input type="file" class="form-control" name="imagen" autocomplete="off" value="{{ old('imagen') }}"
													style="border: 2px solid #ddd; border-radius: 5px; padding: 10px; font-size: 14px; color: #333; width: 100%; transition: border-color 0.3s, box-shadow 0.3s;">

											</div>
										</div>
									</div>
									<input type="hidden" name="estado" value="1">
									<input type="hidden" name="registradopor" value="{{ Auth::user()->id }}">
								</div>
								<div class="card-footer" style="padding: 20px; background-color: #f1f1f1; border-top: 1px solid #e0e0e0; text-align: center;">
									<button type="submit" class="btn btn-primary" style="font-size: 16px; padding: 10px 20px; border-radius: 8px; font-weight: bold; background-color: #28a745; color: #fff; border: none; transition: background-color 0.3s, color 0.3s;">
										Registrar
									</button>
									<a href="{{ route('sliders.index') }}" class="btn btn-danger" style="font-size: 16px; padding: 10px 20px; border-radius: 8px; font-weight: bold; background-color: #dc3545; color: #fff; border: none; transition: background-color 0.3s, color 0.3s;">
										Atras
									</a>
								</div>
							</form>
						</div>

					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection