<div class="menusidebar">
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <div class="contenedorlogosi">
            <div class="imglogo" style="display: flex  ; justify-content: center; align-items: center; justify-items: center;">
                <a href="/home" class="alog">
                <img src="{{ asset('img/logosubasta.png') }}" alt="" class="col-20 col-md-12">
                </a>
            </div>
        </div>
        <!-- Sidebar -->
        <div class="sidebar">
            <div style="height: 10px"></div>
            <div class="sidebar">
                <div class="form-inline">
                    <div class="input-group buscador" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar placeholder buscar" type="search" placeholder="Buscar" aria-label="Search" style="color: white;">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <nav class="mt-3">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        {{-- SOLO ADMINISTRADOR PUEDE VER PARÁMETROS --}}
                        @if(Auth::check() && Auth::user()->rol == 1)
                        <li class="nav-item palabritas">
                            <a href="#" class="nav-link">
                                <i class="fas fa-cogs"></i>
                                <p>Parámetros<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item palabritas">
                                    <a href="{{ route('paises.index') }}" class="nav-link palabritas">
                                        <i class="nav-icon fas fa-globe"></i>
                                        <p>País</p>
                                    </a>
                                </li>
                                <li class="nav-item palabritas">
                                    <a href="{{ route('departamentos.index') }}" class="nav-link palabritas">
                                        <i class="nav-icon fas fa-map-marker"></i>
                                        <p>Departamento</p>
                                    </a>
                                </li>
                                <li class="nav-item palabritas">
                                    <a href="{{ route('ciudads.index') }}" class="nav-link palabritas">
                                        <i class="nav-icon fas fa-map-marker-alt"></i>
                                        <p>Ciudad</p>
                                    </a>
                                </li>
                                <li class="nav-item palabritas">
                                    <a href="{{ route('tipodocumentos.index') }}" class="nav-link palabritas">
                                        <i class="fa fa-id-card"></i>
                                        <p>Tipo De Documento</p>
                                    </a>
                                </li>
                                <li class="nav-item palabritas">
                                    <a href="{{ route('users.index') }}" class="nav-link palabritas">
                                        <i class="fa fa-users"></i>
                                        <p>Usuarios</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        {{-- SUBASTAS LO PUEDEN VER ADMIN, VENDEDOR Y COMPRADOR --}}
                        @if(Auth::check() && in_array(Auth::user()->rol, [1,2,3]))
                        <li class="nav-item">
                            <a href="#" class="nav-link palabritas">
                                <i class="fa fa-archive"></i>
                                <p>Subastas<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item palabritas">
                                    <a href="{{ route('productos.index') }}" class="nav-link palabritas">
                                        <i class="fa fa-shopping-cart"></i>
                                        <p>Productos</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item palabritas">
                                    <a href="{{ route('pqrs.index') }}" class="nav-link palabritas">
                                        <i class="fas fa-users"></i>
                                        <p>Formulario PQRS</p>
                                    <a href="{{ route('foros.index') }}" class="nav-link palabritas">
                                        <i class="fas fa-users"></i>
                                        <p>Foros</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        {{-- SLIDER SOLO ADMIN --}}
                        @if(Auth::check() && Auth::user()->rol == 1)
                        <li class="nav-item palabritas">
                            <a href="{{ route('sliders.index') }}" class="nav-link palabritas">
                                <i class="fas fa-images"></i>
                                <p>Slider</p>
                            </a>
                        </li>
                        @endif

                    </ul>
                </nav>
            </div>
        </div>
    </aside>
</div>
