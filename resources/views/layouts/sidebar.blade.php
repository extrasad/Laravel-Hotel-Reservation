<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info" style="background-image: url({{ asset('images/vendor/adminbsb-materialdesign/user-img-background.jpg') }});">
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $userName = isset(auth()->user()->name) ? auth()->user()->name : ''  }}</div>
                <div class="email">{{ auth()->user()->userRole(auth()->user()->id) }}</div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <i class="material-icons">input</i>Cerrar sesión</a>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf

                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">Navegación principal</li>
                <li {{ Request::is('home') ? 'class=active' : '' }}>
                    <a href="{{ route('home') }}">
                        <i class="material-icons">home</i>
                        <span>Dashboard</span>
                    </a>
                </li>

                @if(!auth()->user()->isRecepcionista())

                <li {{ Request::is( 'users', 'users/*') ? 'class=active' : '' }}>
                    <a href="{{ route('users.index') }}">
                        <i class="material-icons">text_fields</i>
                        <span>Usuarios</span>
                    </a>
                </li>
                <li {{ Request::is( 'roles', 'roles/*') ? 'class=active' : '' }}>
                    <a href="{{ route('roles.index') }}">
                        <i class="material-icons">layers</i>
                        <span>Roles</span>
                    </a>
                </li>
                <li {{ Request::is( 'autos', 'autos/*') ? 'class=active' : '' }}>
                    <a href="{{ route('autos.index') }}">
                        <i class="material-icons">layers</i>
                        <span>Autos</span>
                    </a>
                </li>
                <li {{ Request::is( 'clientes', 'clientes/*') ? 'class=active' : '' }}>
                    <a href="{{ route('clientes.index') }}">
                        <i class="material-icons">layers</i>
                        <span>Clientes</span>
                    </a>
                </li>
                <li {{ Request::is( 'consumos', 'consumos/*') ? 'class=active' : '' }}>
                    <a href="{{ route('consumos.index') }}">
                        <i class="material-icons">layers</i>
                        <span>Consumos</span>
                    </a>
                </li>
                <li {{ Request::is( 'empleados', 'empleados/*') ? 'class=active' : '' }}>
                    <a href="{{ route('empleados.index') }}">
                        <i class="material-icons">layers</i>
                        <span>Empleados</span>
                    </a>
                </li>
                <li {{ Request::is( 'habitacion', 'habitacion/*') ? 'class=active' : '' }}>
                    <a href="{{ route('habitacion.index') }}">
                        <i class="material-icons">layers</i>
                        <span>Habitaciones</span>
                    </a>
                </li>
                <li {{ Request::is( 'productos', 'productos/*') ? 'class=active' : '' }}>
                    <a href="{{ route('productos.index') }}">
                        <i class="material-icons">layers</i>
                        <span>Productos</span>
                    </a>
                </li>
                <li {{ Request::is( 'turnos', 'turnos/*') ? 'class=active' : '' }}>
                    <a href="{{ route('turnos.index') }}">
                        <i class="material-icons">layers</i>
                        <span>Turnos</span>
                    </a>
                </li>
                <li {{ Request::is( 'tarifarios', 'tarifarios/*') ? 'class=active' : '' }}>
                    <a href="{{ route('tarifarios.index') }}">
                        <i class="material-icons">layers</i>
                        <span>Tarifarios</span>
                    </a>
                </li>
                <li {{ Request::is( 'reservacion', 'reservacion/*') ? 'class=active' : '' }}>
                    <a href="{{ route('reservacion.index') }}">
                        <i class="material-icons">layers</i>
                        <span>Reservación</span>
                    </a>
                </li>
                <li {{ Request::is( 'promos', 'promos/*') ? 'class=active' : '' }}>
                    <a href="{{ route('promos.index') }}">
                        <i class="material-icons">layers</i>
                        <span>Promos</span>
                    </a>
                </li>
                <li {{ Request::is( 'diex', 'diex/*') ? 'class=active' : '' }}>
                    <a href="{{ route('diex.index') }}">
                        <i class="material-icons">layers</i>
                        <span>Diex</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                <a href="javascript:void(0);">Afrodita</a>.
            </div>
            <div class="version">
                <b>Version: </b> 1.0.0
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
    
</section>