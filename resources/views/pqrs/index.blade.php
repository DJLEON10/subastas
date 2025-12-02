@extends('layouts.app')

@section('title','Listado De PQRS')

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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-secondary" style="font-size: 1.75rem;font-weight: 500; line-height: 1.2; margin-bottom: 0.5rem;">
                            @yield('title')
                            @if(Auth::user()->rol != '0')
                                <a href="{{ route('pqrs.create') }}" class="btn btn-primary float-right" title="Nuevo">
                                    <i class="fas fa-plus nav-icon"></i>
                                </a>
                            @endif
                        </div>

                        @include('components.search', ['route' => route('pqrs.index')])

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover" style="width:100%">
                                <thead class="text-primary">
                                    <tr>
                                        <th>Usuario</th>
                                        <th>Tipo</th>
                                        <th>Asunto</th>
                                        <th>Descripción</th>
                                        <th width="80px">Estado</th>
                                        <th width="140px">Fecha Creación</th>
                                        <th width="120px">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pqrs as $pqr)
                                        <tr>
                                            {{-- Usuario (si cargaste la relación with('usuario') en el controlador) --}}
                                            <td>
                                                {{ optional($pqr->usuario)->name ?? 'Sin usuario' }}
                                            </td>

                                            <td>{{ $pqr->tipo }}</td>
                                            <td>{{ $pqr->asunto }}</td>
                                            <td>{{ Str::limit($pqr->descripcion, 50) }}</td>

                                            @if(Auth::user()->rol != '0')
                                                <td>
                                                    <input 
                                                        data-type="pqrs"
                                                        data-id="{{ $pqr->id }}"
                                                        class="toggle-class"
                                                        type="checkbox"
                                                        data-onstyle="success"
                                                        data-offstyle="danger"
                                                        data-toggle="toggle"
                                                        data-on="Activo"
                                                        data-off="Inactivo"
                                                        {{ $pqr->estado ? 'checked' : '' }}>
                                                </td>
                                                <td>
                                                    {{ optional($pqr->created_at)->format('d/m/Y H:i') }}
                                                </td>
                                                <td>
                                                    {{-- Si quieres botón ver, lo puedes agregar aquí --}}
                                                    {{-- <a href="{{ route('pqrs.show', $pqr->id) }}" class="btn btn-secondary btn-sm" title="Ver"><i class="fas fa-eye"></i></a> --}}

                                                    <a href="{{ route('pqrs.edit', $pqr->id) }}" class="btn btn-info btn-sm" title="Editar">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>

                                                    <form class="d-inline delete-form" action="{{ route('pqrs.destroy', $pqr) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            @else
                                                {{-- Si el rol 0 no puede gestionar, solo mostramos estado y fecha como texto --}}
                                                <td>{{ $pqr->estado ? 'Activo' : 'Inactivo' }}</td>
                                                <td>{{ optional($pqr->created_at)->format('d/m/Y H:i') }}</td>
                                                <td>-</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div class="d-flex justify-content-start">
                                    @if ($pqrs->total() > 0)
                                        <div class="d-flex flex-fill justify-content-start">
                                            <p class="small text-muted mb-0">
                                                {{ __('Mostrando') }}
                                                <span class="fw-semibold">{{ $pqrs->firstItem() }}</span>
                                                {{ __('a') }}
                                                <span class="fw-semibold">{{ $pqrs->lastItem() }}</span>
                                                {{ __('de') }}
                                                <span class="fw-semibold">{{ $pqrs->total() }}</span>
                                                {{ __('resultados') }}
                                            </p>
                                        </div>
                                    @endif
                                </div>
                                <div class="d-flex justify-content-end">
                                    {{ $pqrs->appends([
                                        'search'   => request('search'),
                                        'per_page' => request('per_page')
                                    ])->links('pagination::bootstrap-4') }}
                                </div>
                            </div>

                        </div> {{-- card-body --}}
                    </div> {{-- card --}}
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
            const pqr_id = $(this).data('id');

            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{ route('cambioestadopqrs') }}",
                data: {
                    'estado': estado,
                    'id': pqr_id,
                },
                success: function (data) {
                    // Puedes ajustar el mensaje según lo que devuelvas en el controlador
                    toastr.success(data.success || 'Estado actualizado correctamente');
                },
                error: function (xhr, status, error) {
                    toastr.error('No se pudo actualizar el estado.');
                }
            });
        });
    });
</script>
@endpush