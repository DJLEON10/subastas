

@extends('layouts.app')

@section('title', 'Datos Del Familiar del Habitante de calle ' . $familiar->habitante->nombre . ' ' . $familiar->habitante->apellido) 
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
                        @csrf
                        <div class="card-body">
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" style="display: flex; justify-content:center">
                                <div class="form-group label-floating">
                                @if(optional($familiar->habitante)->image)
    <img src="{{ asset('uploads/habitante/' . $familiar->habitante->image) }}" alt="{{ optional($familiar->habitante)->nombre }}" width="150px">
@else
    No hay imagen disponible.
@endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="card-header" style="background-color:#70AADB ; color:white">
                                    <h4 class="title">Datos De Familiar</h4>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                    <div class="form-group label-floating ">
                                        <label class="control-label">Nombre </label>
                                        <p class="cuadro">{{ $familiar->nombre }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                    <div class="form-group label-floating  ">
                                        <label class="control-label">Parentezco</label>
                                        <p class="cuadro">{{ $familiar->parentezco }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                                    <div class="form-group label-floating ">
                                        <label class="control-label" for="tipodocumento">Direccion</label>
                                        <p class="cuadro">{{ $familiar->direccion }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                                    <div class="form-group label-floating ">
                                        <label class="control-label">Numero celular</label>
                                        <p class="cuadro">{{ $familiar->celular }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
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