@extends('layouts.app')

@section('title','Listado De Ciudades')

@section('content')

<div class="content-wrapper">
    <section class="content-header" style="text-align: right;">
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

								<a href="{{ route('ciudads.create') }}" class="btn btn-primary float-right" title="Nuevo"><i class="fas fa-plus nav-icon"></i></a>
							@endif
						</div>
						@include('components.search', ['route' => route('ciudads.index')])  
						<div class="card-body">
							<table id="example1" class="table table-bordered table-hover" style="width:100%">
                                <thead class="text-primary">
									<th width="10px">ID</th>
									<th>País</th>
									<th>Departamento</th>
									<th>Ciudad</th>
									<th width="60px">Estado</th>
									<th width="90px">Acción</th>
                                </thead>
                                <tbody>
									@foreach($ciudads as $ciudad)
									<tr>
										<td>{{ $ciudad->id }}</td>
										<td>{{ $ciudad->departamento->pais->nombre }}</td>
										<td>{{ $ciudad->departamento->nombre }}</td>
										<td>{{ $ciudad->nombre }}</td>
										@if(Auth::user()->rol != '0')
										<td>
												<input data-type="ciudad" data-id="{{$ciudad->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" 
												data-toggle="toggle" data-on="Activo" data-off="Inactivo" {{ $ciudad->estado ? 'checked' : '' }}>
										</td>
										<td>
											<a href="{{ route('ciudads.edit',$ciudad->id) }}" class="btn btn-info btn-sm" title="Editar"><i class="fas fa-pencil-alt"></i></a>
											<form class="d-inline delete-form" action="{{ route('ciudads.destroy', $ciudad) }}"  method="POST">
												@csrf
												@method('DELETE')
												<button type="submit" class="btn btn-danger btn-sm" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
											</form>
										</td>
										@endif
									</tr>
									@endforeach
								</tbody>
							</table>
							<div class="d-flex justify-content-between align-items-center mt-3">
								<div class="d-flex justify-content-start">
									@if ($ciudads->total() > 0)
										<div class="d-flex flex-fill justify-content-start">
											<p class="small text-muted mb-0">
												{{ __('Mostrando') }}
												<span class="fw-semibold">{{ $ciudads->firstItem() }}</span>
												{{ __('a') }}
												<span class="fw-semibold">{{ $ciudads->lastItem() }}</span>
												{{ __('de') }}
												<span class="fw-semibold">{{ $ciudads->total() }}</span>
												{{ __('resultados') }}
											</p>
										</div>
									@endif
								</div>
								<div class="d-flex justify-content-end">
								{{ $ciudads->appends(['search' => request('search'), 'per_page' => request('per_page')])->links('pagination::bootstrap-4') }}
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
                url: "{{ route('cambioestadociudad') }}",
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
