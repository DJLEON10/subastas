@extends('layouts.app')

@section('title', 'Crear Usuario')

@section('content')

<div class="content-wrapper">
	<section class="content-header" style="text-align: right;">
		<div class="container-fluid">
		</div>
    </section>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-secondary">
                            <h3>@yield('title')</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nombre">
									@error('name')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Correo">
									@error('email')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Contraseña">
									@error('password')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Confirmar Contraseña</label>
                                    <input type="password" name="confirm_password" class="form-control" required>
                                </div>
								<div class="form-group">
                                    <label for="photo">Fotografía</label>
                                    <input type="file" class="form-control-file" name="image" id="image" >
                                </div>
								<input type="hidden" class="form-control" name="status" value="1">
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-2 col-xs-4">
                                            <button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>
                                        </div>
                                        <div class="col-lg-2 col-xs-4">
                                            <a href="{{ route('users.index') }}" class="btn btn-danger btn-block btn-flat">Atrás</a>
                                        </div>
                                    </div>
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