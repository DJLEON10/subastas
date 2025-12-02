@extends('layouts.app')

@section('title', 'Crear Foro')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid"></div>
    </section>

    @include('layouts.partial.msg')

    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header bg-secondary">
                    <h3>@yield('title')</h3>
                </div>

                <form method="POST" action="{{ route('foros.store') }}">
                    @csrf

                    <div class="card-body">

                        <div class="card-header" style="background-color:#70AADB; color:white;">
                            <h4 class="title">Datos del Foro</h4>
                        </div>

                        <br>

                        <div class="row">

                            <div class="col-md-6">
                                <label class="control-label">Título <strong style="color:red;">(*)</strong></label>
                                <input type="text" name="titulo" class="form-control" value="{{ old('titulo') }}" placeholder="Ejemplo: Debate sobre IA">
                            </div>

                            <div class="col-md-12 mt-3">
                                <label>Descripción <strong style="color:red;">(*)</strong></label>
                                <textarea class="form-control" name="descripcion" rows="4" placeholder="Describe el tema del foro...">{{ old('descripcion') }}</textarea>
                            </div>

                        </div>

                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                    </div>

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-2 col-xs-4">
                                <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                            </div>
                            <div class="col-lg-2 col-xs-4">
                                <a href="{{ route('foros.index') }}" class="btn btn-danger btn-block">Atrás</a>
                            </div>
                        </div>
                    </div>

                </form>

            </div>

        </div>
    </section>
</div>

@endsection
