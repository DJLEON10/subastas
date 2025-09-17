@extends('layouts.app')

@section('title', 'Editar Usuario')

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
                            <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input id="name" type="text" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus placeholder="Nombre">

                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" name="email" value="{{ $user->email }}" required autocomplete="email" placeholder="Correo">

                                </div>
                                <div class="form-group">
                                    <label for="password">Nueva Contraseña (opcional)</label>
                                    <input id="password" type="password" name="password" autocomplete="new-password" placeholder="Dejar en blanco para mantener la actual">
                                </div>

                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="image">Fotografía</label>

                                        @php
                                        $userPhotoPath = 'uploads/users/' . $user->photo;
                                        @endphp

                                        <!-- Mostrar la imagen actual si existe -->
                                        @if (!empty($user->photo) && file_exists(public_path($userPhotoPath)))
                                        <div>
                                            <img src="{{ asset($userPhotoPath) }}" alt="Foto de {{ $user->name }}"
                                                class="img-thumbnail" style="width: 150px; height: 150px;">
                                        </div>
                                        @else
                                        <div>
                                            <img src="{{ asset('backend/dist/img/mia.jpg') }}" alt="Imagen por defecto"
                                                class="img-thumbnail" style="width: 150px; height: 150px;">
                                        </div>
                                        @endif

                                        <!-- Input para subir una nueva imagen -->
                                        <input type="file" class="form-control-file mt-2" name="image" id="image">
                                    </div>
                                    <div class="form-group">
                                        <label for="rol">Rol</label>
                                        <select name="rol" id="rol" class="form-control">
                                            <option value="0" {{ $user->rol == 0 ? 'selected' : '' }}>Usuario</option>
                                            <option value="1" {{ $user->rol == 1 ? 'selected' : '' }}>Administrador</option>
                                        </select>
                                    </div>
                                    <input type="hidden" class="form-control" name="status" value="1">
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-lg-2 col-xs-4">
                                                <button type="submit" class="btn btn-primary btn-block btn-flat" onclick="console.log('Botón presionado');">
                                                    Registrar
                                                </button>
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