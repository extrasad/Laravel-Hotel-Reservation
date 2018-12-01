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
                @if(Request::is('habitacion/*') )
                @if(isset($habitacion))
                <li>
                    <a href="#">
                        <i class="material-icons">hotel</i>
                        <span>{{ $habitacion->habitacion }}</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="material-icons">verified_user</i>
                        <span>{{ $habitacion->estado }}</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="material-icons">attach_money</i>
                        <span>{{ $habitacion->costo }}</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="material-icons">report</i>
                        <span>{{ $habitacion->observacion }}</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="material-icons">format_list_numbered</i>
                        <span>{{ $habitacion->caracteristicas }}</span>
                    </a>
                </li>
                @elseif(Request::is('reservacion-custom-create/*'))
                <li>
                    <a href="#">
                        <i class="material-icons">hotel</i>
                        <span>{{ $habitacion_find->habitacion }}</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="material-icons">verified_user</i>
                        <span>{{ $habitacion_find->estado }}</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="material-icons">attach_money</i>
                        <span>{{ $habitacion_find->costo }}</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="material-icons">report</i>
                        <span>{{ $habitacion_find->observacion }}</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="material-icons">format_list_numbered</i>
                        <span>{{ $habitacion_find->caracteristicas }}</span>
                    </a>
                </li>
                @endif
                
                @elseif(Request::is('reservacion/*'))
                <li>
                    <a href="#">
                        <i class="material-icons">hotel</i>
                        <span>{{ $habitaciones->habitacion }}</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="material-icons">verified_user</i>
                        <span>{{ $habitaciones->estado }}</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="material-icons">attach_money</i>
                        <span>{{ $habitaciones->costo }}</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="material-icons">report</i>
                        <span>{{ $habitaciones->observacion }}</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="material-icons">format_list_numbered</i>
                        <span>{{ $habitaciones->caracteristicas }}</span>
                    </a>
                </li>
                @endif
                @if(!auth()->user()->isRecepcionista())

                <li {{ Request::is( 'users', 'users/*') ? 'class=active' : '' }}>
                    <a href="{{ route('users.index') }}">
                        <i class="material-icons">account_box</i>
                        <span>Usuarios</span>
                    </a>
                </li>
                <li {{ Request::is( 'roles', 'roles/*') ? 'class=active' : '' }}>
                    <a href="{{ route('roles.index') }}">
                        <i class="material-icons">supervisor_account</i>
                        <span>Roles</span>
                    </a>
                </li>
                <li {{ Request::is( 'autos', 'autos/*') ? 'class=active' : '' }}>
                    <a href="{{ route('autos.index') }}">
                        <i class="material-icons">directions_car</i>
                        <span>Autos</span>
                    </a>
                </li>
                <li {{ Request::is( 'clientes', 'clientes/*') ? 'class=active' : '' }}>
                    <a href="{{ route('clientes.index') }}">
                        <i class="material-icons">accessibility</i>
                        <span>Clientes</span>
                    </a>
                </li>
                <li {{ Request::is( 'consumos', 'consumos/*') ? 'class=active' : '' }}>
                    <a href="{{ route('consumos.index') }}">
                        <i class="material-icons">add_shopping_cart</i>
                        <span>Consumos</span>
                    </a>
                </li>
                <li {{ Request::is( 'empleados', 'empleados/*') ? 'class=active' : '' }}>
                    <a href="{{ route('empleados.index') }}">
                        <i class="material-icons">assignment_ind</i>
                        <span>Empleados</span>
                    </a>
                </li>
                <li {{ Request::is( 'habitacion', 'habitacion/*') ? 'class=active' : '' }}>
                    <a href="{{ route('habitacion.index') }}">
                        <i class="material-icons">hotel</i>
                        <span>Habitaciones</span>
                    </a>
                </li>
                <li {{ Request::is( 'productos', 'productos/*') ? 'class=active' : '' }}>
                    <a href="{{ route('productos.index') }}">
                        <i class="material-icons">shopping_cart</i>
                        <span>Productos</span>
                    </a>
                </li>
                <li {{ Request::is( 'turnos', 'turnos/*') ? 'class=active' : '' }}>
                    <a href="{{ route('turnos.index') }}">
                        <i class="material-icons">schedule</i>
                        <span>Turnos</span>
                    </a>
                </li>
                <li {{ Request::is( 'tarifarios', 'tarifarios/*') ? 'class=active' : '' }}>
                    <a href="{{ route('tarifarios.index') }}">
                        <i class="material-icons">assignment</i>
                        <span>Tarifarios</span>
                    </a>
                </li>
                <li {{ Request::is( 'reservacion', 'reservacion/*') ? 'class=active' : '' }}>
                    <a href="{{ route('reservacion.index') }}">
                        <i class="material-icons">book</i>
                        <span>Reservación</span>
                    </a>
                </li>
                <li {{ Request::is( 'promos', 'promos/*') ? 'class=active' : '' }}>
                    <a href="{{ route('promos.index') }}">
                        <i class="material-icons">card_giftcard</i>
                        <span>Promos</span>
                    </a>
                </li>
                <li {{ Request::is( 'diex', 'diex/*') ? 'class=active' : '' }}>
                    <a href="{{ route('diex.index') }}">
                        <i class="material-icons">block</i>
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