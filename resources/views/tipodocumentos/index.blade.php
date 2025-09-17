@extends('layouts.app')

@section('title','Listado De Tipos De Documentos ')

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
							<a href="{{ route('tipodocumentos.create') }}" class="btn btn-primary float-right" title="Nuevo"><i class="fas fa-plus nav-icon"></i></a>
						@endif
							</div>
						@include('components.search', ['route' => route('tipodocumentos.index')]) 
						<div class="card-body">
							<table id="example1" class="table table-bordered table-hover" style="width:100%">
								<thead class="text-primary">
									<tr>
										<th width="10px">ID</th>
										<th>Tipo de Documento</th>
										<th>Abreviatura</th>
										<th width="60px">Estado</th>
										<th width="90px">Acción</th>
									</tr>
								</thead>
								<tbody>
									@foreach($tipodocumentos as $tipodocumento)
									<tr>
										<td>{{ $tipodocumento->id }}</td>
										<td>{{ $tipodocumento->nombre }}</td>
										<td>{{ $tipodocumento->abreviatura }}</td>

										<td>
											<input data-type="tipodocumento" data-id="{{$tipodocumento->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" 
											data-toggle="toggle" data-on="Activo" data-off="Inactivo" {{ $tipodocumento->estado ? 'checked' : '' }}>
										</td>
										<td>
											@if(Auth::user()->rol != '0')
												<a href="{{ route('tipodocumentos.edit',$tipodocumento->id) }}" class="btn btn-info btn-sm" title="Editar"><i class="fas fa-pencil-alt"></i></a>
											@endif
											@if(Auth::user()->rol != '0')
											<form class="d-inline delete-form" action="{{ route('tipodocumentos.destroy', $tipodocumento) }}"  method="POST">
												@csrf
												@method('DELETE')
												<button type="submit" class="btn btn-danger btn-sm" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
											</form>
											@endif
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							<div class="d-flex justify-content-between align-items-center mt-3">
								<div class="d-flex justify-content-start">
									@if ($tipodocumentos->total() > 0)
										<div class="d-flex flex-fill justify-content-start">
											<p class="small text-muted mb-0">
												{{ __('Mostrando') }}
												<span class="fw-semibold">{{ $tipodocumentos->firstItem() }}</span>
												{{ __('a') }}
												<span class="fw-semibold">{{ $tipodocumentos->lastItem() }}</span>
												{{ __('de') }}
												<span class="fw-semibold">{{ $tipodocumentos->total() }}</span>
												{{ __('resultados') }}
											</p>
										</div>
									@endif
								</div>
								<div class="d-flex justify-content-end">
								{{ $tipodocumentos->appends(['search' => request('search'), 'per_page' => request('per_page')])->links('pagination::bootstrap-4') }}
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
                url: "{{ route('cambioestadotipodocumento') }}",
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
