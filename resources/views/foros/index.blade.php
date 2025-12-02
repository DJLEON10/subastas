@extends('layouts.app')

@section('title', 'Listado de Foros')

@section('content')
<div class="content-wrapper">
    <section class="content-header text-right">
        <div class="container-fluid"></div>
    </section>

    @include('layouts.partial.msg')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header bg-secondary">
                            @yield('title')

                            @if(Auth::user()->rol == '1' || Auth::user()->rol == '3')
                                <a href="{{ route('foros.create') }}" class="btn btn-primary float-right" title="Nuevo Foro">
                                    <i class="fas fa-plus"></i>
                                </a>
                            @endif
                        </div>

                        @include('components.search', ['route' => route('foros.index')])

                        <div class="card-body">
                            <div class="row">

                                @if ($foros->count() > 0)
                                    @foreach($foros as $foro)
                                        <div class="col-md-4">
                                            <div class="card shadow-sm">
                                                <div class="card-body">
                                                    <h5 class="fw-bold">{{ $foro->titulo }}</h5>
                                                    <p class="text-muted small">{{ Str::limit($foro->descripcion, 120) }}</p>

                                                    <a href="{{ route('foros.show', $foro->_id) }}" class="btn btn-info btn-sm">
                                                        Ver
                                                    </a>

                                                    @if(Auth::user()->rol == '1' || Auth::user()->id == $foro->user_id)
                                                        <a href="{{ route('foros.edit', $foro->_id) }}" class="btn btn-warning btn-sm">
                                                            Editar
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-12 text-center py-5">
                                        <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">No se encontraron foros disponibles.</h5>
                                    </div>
                                @endif

                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    @if ($foros->total() > 0)
                                        <p class="small text-muted mb-0">
                                            Mostrando
                                            <span class="fw-semibold">{{ $foros->firstItem() }}</span>
                                            a
                                            <span class="fw-semibold">{{ $foros->lastItem() }}</span>
                                            de
                                            <span class="fw-semibold">{{ $foros->total() }}</span>
                                            resultados
                                        </p>
                                    @endif
                                </div>

                                <div>
                                    {{ $foros->links() }}
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
@endsection
