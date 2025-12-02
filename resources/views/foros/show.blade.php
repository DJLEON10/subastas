@extends('layouts.app')

@section('title', 'Detalles del Foro')

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
                    <h3>{{ $foro->titulo }}</h3>
                </div>

                <div class="card-body">

                    <p class="fw-bold">Descripción:</p>
                    <p>{{ $foro->descripcion }}</p>

                    <p class="text-muted mt-3">
                        Creado por: <strong>{{ $foro->user->name }}</strong><br>
                        Fecha: {{ $foro->created_at->format('d/m/Y H:i') }}
                    </p>
                    @livewire('foro-mensaje', ['foroId' => $foro->_id])
                </div>

                <div class="card-footer">
                    <a href="{{ route('foros.index') }}" class="btn btn-primary">Volver</a>
                </div>

            </div>

        </div>

    </section>

</div>

@endsection
