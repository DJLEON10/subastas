@extends('layouts.app')

@section('title', 'Listado De Habitantes de calle ')



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
                            @if(Auth::user()->rol != '0')
                                <a href="{{ route('habitantes.create') }}" class="btn btn-primary float-right" title="Nuevo">
                                    <i class="fas fa-plus nav-icon"></i>
                                </a>
                            @endif    
                        </div>
                        
                        @include('components.search', ['route' => route('habitantes.index')])
                        
                        <div class="card-body">
                            <div class="row">
                                @foreach($habitantes as $habitante)
                                    @include('components.user_card', ['habitante' => $habitante])
                                @endforeach
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div class="d-flex justify-content-start">
                                    @if ($habitantes->total() > 0)
                                        <p class="small text-muted mb-0">
                                            {{ __('Mostrando') }}
                                            <span class="fw-semibold">{{ $habitantes->firstItem() }}</span>
                                            {{ __('a') }}
                                            <span class="fw-semibold">{{ $habitantes->lastItem() }}</span>
                                            {{ __('de') }}
                                            <span class="fw-semibold">{{ $habitantes->total() }}</span>
                                            {{ __('resultados') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="d-flex justify-content-end">
                                    {{ $habitantes->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
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
@push('scripts')
<script>
    $(document).ready(function () {
        $('.toggle-class').change(function () {
            const estado = $(this).prop('checked') ? 1 : 0;
            const pais_id = $(this).data('id');

            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{ route('cambioestadohabitante') }}",
                data: {
                    'estado': estado,
                    'id': pais_id,
                },
                success: function (data) {
                    toastr.success(data.success);
                },
                error: function (xhr, status, error) {
                    toastr.error('No se pudo actualizar el estado.');
                }
            });
        });
    });
</script>
@endpush


