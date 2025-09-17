<form method="GET" action="{{ $route }}" class="form-inline">
    <div class="input-group ml-3">
        <input 
            type="text" 
            name="search" 
            class="form-control" 
            placeholder="{{ __('Buscar...') }}" 
            value="{{ request('search') }}" 
            aria-label="{{ __('Buscar') }}">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit">{{ __('Buscar') }}</button>
			@if(request('search'))
                <a href="{{ $route }}" class="btn btn-danger" title="Limpiar Búsqueda">
                    &times;
                </a>
            @endif
        </div>
    </div>
	<div class="input-group ml-3">
        <select name="per_page" class="form-control custom-select" style="width: 70px;" onchange="this.form.submit()">
            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
        </select>
    </div>
</form>