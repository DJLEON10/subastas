
<div class="menusidebar">
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <div class="contenedorlogosi">
            <div class="imglogo">
                <a href="home" class="alog">
                    <img src="{{ asset('img/Recurso 3 (2).png') }}" alt="" class="col-20 col-md-12" style="width: 500px; height: 200px;">
                </a>
            </div>
        </div>
        <!-- Sidebar -->
        <div class="sidebar">
            <div style="height: 10px"></div>
            <div class="sidebar">
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar placeholder" type="search" placeholder="Buscar" aria-label="Search" style="color: white;">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                            <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <nav class="mt-3">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
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
                        <li class="nav-item">
                            <a href="#" class="nav-link palabritas">
                                <i class="fas fa-user-friends"></i>
                                <p>Personas<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item palabritas">
                                    <a href="{{ route('habitantes.index') }}" class="nav-link palabritas">
                                        <i class="fa fa-user"></i>
                                        <p>Habitantes de Calle</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item palabritas">
                                    <a href="{{ route('familiares.index') }}" class="nav-link palabritas">
                                        <i class="fas fa-users"></i>
                                        <p>Familiares</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item palabritas">
                            <a href="{{ route('sliders.index') }}" class="nav-link palabritas">
                                <i class="fas fa-images"></i>
                                <p>Slider</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </aside>
</div>
