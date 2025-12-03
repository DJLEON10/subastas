@extends('layouts.app')

@section('title', 'Crear PQRS')

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
                            <a href="{{ route('pqrs.index') }}" class="btn btn-secondary float-right" title="Volver">
                                <i class="fas fa-arrow-left nav-icon"></i>
                            </a>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('pqrs.store') }}" method="POST">
                                @csrf

                                {{-- Usuario (campo oculto, siempre el autenticado) --}}
                                <input type="hidden" name="usuario_id" value="{{ Auth::id() }}">

                                <div class="row">
                                    {{-- Nombre del Usuario (solo lectura como texto) --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre_usuario">Nombre del Usuario</label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="nombre_usuario" 
                                                value="{{ Auth::user()->name }}" 
                                                readonly>
                                        </div>
                                    </div>

                                    {{-- Tipo de PQRS --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tipo">Tipo de PQRS <span class="text-danger">*</span></label>
                                            <select 
                                                class="form-control @error('tipo') is-invalid @enderror" 
                                                id="tipo" 
                                                name="tipo" 
                                                required>
                                                <option value="">Seleccione una opción</option>
                                                <option value="Petición" {{ old('tipo') == 'Petición' ? 'selected' : '' }}>Petición</option>
                                                <option value="Queja" {{ old('tipo') == 'Queja' ? 'selected' : '' }}>Queja</option>
                                                <option value="Reclamo" {{ old('tipo') == 'Reclamo' ? 'selected' : '' }}>Reclamo</option>
                                                <option value="Sugerencia" {{ old('tipo') == 'Sugerencia' ? 'selected' : '' }}>Sugerencia</option>
                                            </select>
                                            @error('tipo')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- Asunto --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="asunto">Asunto <span class="text-danger">*</span></label>
                                            <input 
                                                type="text" 
                                                class="form-control @error('asunto') is-invalid @enderror" 
                                                id="asunto" 
                                                name="asunto" 
                                                value="{{ old('asunto') }}" 
                                                placeholder="Breve descripción del asunto" 
                                                required>
                                            @error('asunto')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- Descripción --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="descripcion">Descripción Detallada <span class="text-danger">*</span></label>
                                            <textarea 
                                                class="form-control @error('descripcion') is-invalid @enderror" 
                                                id="descripcion" 
                                                name="descripcion" 
                                                rows="5" 
                                                placeholder="Describa su solicitud de manera detallada" 
                                                required>{{ old('descripcion') }}</textarea>
                                            @error('descripcion')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- Email de contacto --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="correo">Correo Electrónico <span class="text-danger">*</span></label>
                                            <input 
                                                type="email" 
                                                class="form-control @error('correo') is-invalid @enderror" 
                                                id="correo" 
                                                name="correo" 
                                                value="{{ old('correo', Auth::user()->email) }}" 
                                                placeholder="ejemplo@correo.com" 
                                                required>
                                            @error('correo')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Teléfono --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="telefono">Teléfono</label>
                                            <input 
                                                type="tel" 
                                                class="form-control @error('telefono') is-invalid @enderror" 
                                                id="telefono" 
                                                name="telefono" 
                                                value="{{ old('telefono') }}" 
                                                placeholder="Número de contacto">
                                            @error('telefono')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                @if(Auth::user()->rol != '0')
                                    {{-- Solo admin puede cambiar el estado inicial --}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="estado">Estado Inicial</label>
                                                <div class="form-check form-switch">
                                                    <input 
                                                        class="form-check-input" 
                                                        type="checkbox" 
                                                        id="estado" 
                                                        name="estado" 
                                                        value="1" 
                                                        {{ old('estado', 1) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="estado">
                                                        Activo
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    {{-- Usuario normal: siempre activo por defecto --}}
                                    <input type="hidden" name="estado" value="1">
                                @endif
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group text-right">
                                            <a href="{{ route('pqrs.index') }}" class="btn btn-secondary">
                                                <i class="fas fa-times"></i> Cancelar
                                            </a>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save"></i> Crear PQRS
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </form>
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
    $(document).ready(function() {
        // Validación adicional si es necesaria
        $('form').on('submit', function(e) {
            // Puedes agregar validaciones personalizadas aquí
        });
    });
</script>
@endpush