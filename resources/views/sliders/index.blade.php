@extends('layouts.app')

@section('title','Listado de Sliders')

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
							<a href="{{ route('sliders.create') }}" class="btn btn-primary float-right" title="Nuevo"><i class="fas fa-plus nav-icon"></i></a>
						</div>
						<div class="card-body">
							<table id="example1" class="table table-bordered table-hover" style="width:100%">
								<thead class="text-primary">
									<th width="10px">ID</th>
									<th>titulo</th>
									<th>descripcion</th>
									<th>nombre_boton</th>
									<th>link_boton</th>
									<th>imagen</th>
									<th width="60px">Estado</th>
									<th width="90px">Acción</th>
								</thead>
								<tbody>
									@foreach($sliders as $slider)
									<tr>
										<td>{{ $slider->id }}</td>
										<td>{{ $slider->titulo }}</td>
										<td>{{ $slider->descripcion }}</td>
										<td>{{ $slider->nombre_boton }}</td>
										<td style="max-width: 80px;">{{ $slider->link_boton }}</td>
										<td>{{ $slider->imagen}}</td>
										<td>

											<input data-type="slider" data-id="{{ $slider->id }}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger"
												data-toggle="toggle" data-on="Activo" data-off="Inactivo" {{ $slider->estado ? 'checked' : '' }}>

										</td>
										<td>
											<a href="{{ route('sliders.edit', $slider->id) }}" class="btn btn-info btn-sm" title="Editar"><i class="fas fa-pencil-alt"></i></a>
											<a href="{{ route('sliders.show', $slider->id) }}" class="btn btn-warning btn-sm" title="Ver"><i class="fas fa-eye"></i></a>
											<form class="d-inline delete-form" action="{{ route('sliders.destroy', $slider) }}" method="POST">
												@csrf
												@method('DELETE')
												<button type="submit" class="btn btn-danger btn-sm" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
											</form>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@if (session('successMsg'))
    <div class="alert alert-success">
        {{ session('successMsg') }}
    </div>
@endif



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
                url: "{{ route('cambioestadoslider') }}",
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
