@extends('layouts.app')

@section('title', 'Editar Ciudad')

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
                        <form method="POST" action="{{ route('ciudads.update', $ciudad) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label" for="pais">País</label>
                                            <select id="pais" name="pais_id" class="form-control">
                                                @foreach($paises as $pais)
                                                    <option {{ $pais->id == $ciudad->departamento->pais->id ? 'selected' : '' }} value="{{ $pais->id }}">{{ $pais->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label" for="departamento">Departamento</label>
                                            <select class="form-control" id="departamento" name="departamento_id" data-route="{{ route('getDepartamentos') }}" data-old="{{ $ciudad->departamento->id }}">
                                                <option value="">Seleccione Departamento</option>
                                                @foreach($departamentos as $departamento)
                                                    <option {{ $departamento->id == $ciudad->departamento->id ? 'selected' : '' }} value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Nombre <strong style="color:red;">(*)</strong></label>
                                            <input type="text" class="form-control" name="nombre" placeholder="Por ejemplo, Ocaña" autocomplete="off" value="{{ $ciudad->nombre }}">
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
                                        <a href="{{ route('ciudads.index') }}" class="btn btn-danger btn-block btn-flat">Atrás</a>
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
	<script src="{{ asset('backend/dist/js/getDepartamentosEdit.js') }}"></script>
@endpush
