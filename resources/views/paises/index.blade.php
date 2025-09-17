@extends('layouts.app')

@section('title','Listado De Países')

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
								<a href="{{ route('paises.create') }}" class="btn btn-primary float-right" title="Nuevo"><i class="fas fa-plus nav-icon"></i></a>
							@endif
							</div>
						@include('components.search', ['route' => route('paises.index')]) 
						<div class="card-body">
							<table id="example1" class="table table-bordered table-hover" style="width:100%">
								<thead class="text-primary">
									<tr>
										<th width="10px">ID</th>
										<th>País</th>
										<th width="60px">Estado</th>
										<th width="90px">Acción</th>
									</tr>
								</thead>
								<tbody>
									@foreach($paises as $pais)
									<tr>
										<td>{{ $pais->id }}</td>
										<td>{{ $pais->nombre }}</td>
									@if(Auth::user()->rol != '0')
										<td>
											<input data-type="pais" data-id="{{$pais->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" 
											data-toggle="toggle" data-on="Activo" data-off="Inactivo" {{ $pais->estado ? 'checked' : '' }}>
										</td>
										<td>
											<a href="{{ route('paises.edit',$pais->id) }}" class="btn btn-info btn-sm" title="Editar"><i class="fas fa-pencil-alt"></i></a>
										
											<form class="d-inline delete-form" action="{{ route('paises.destroy', $pais) }}"  method="POST">
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
									@if ($paises->total() > 0)
										<div class="d-flex flex-fill justify-content-start">
											<p class="small text-muted mb-0">
												{{ __('Mostrando') }}
												<span class="fw-semibold">{{ $paises->firstItem() }}</span>
												{{ __('a') }}
												<span class="fw-semibold">{{ $paises->lastItem() }}</span>
												{{ __('de') }}
												<span class="fw-semibold">{{ $paises->total() }}</span>
												{{ __('resultados') }}
											</p>
										</div>
									@endif
								</div>
								<div class="d-flex justify-content-end">
								{{ $paises->appends(['search' => request('search'), 'per_page' => request('per_page')])->links('pagination::bootstrap-4') }}
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
                url: "{{ route('cambioestadopais') }}",
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
