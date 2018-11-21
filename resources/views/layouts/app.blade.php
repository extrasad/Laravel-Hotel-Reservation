{{-- <html lang="{{ app()->getLocale() }}">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Afrodita</title>

    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->

    <link rel="dns-prefetch" href="https://fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pdf.css') }}" rel="stylesheet">


</head>

<body>

    <div id="app">

        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">

            <div class="container">

                <a class="navbar-brand" href="{{ url('/') }}">

                    Afrodita

                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

                    <span class="navbar-toggler-icon"></span>

                </button>


                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Left Side Of Navbar -->

                    <ul class="navbar-nav mr-auto"></ul>


                    <!-- Right Side Of Navbar -->

                    <ul class="navbar-nav ml-auto">

                        <!-- Authentication Links -->

                        @guest

                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>

                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>

                        @else

                            <li><a class="nav-link" href="{{ route('users.index') }}">Usuarios</a></li>

                            <li><a class="nav-link" href="{{ route('roles.index') }}">Roles</a></li>

                            <li><a class="nav-link" href="{{ route('autos.index') }}">Autos</a></li>

                            <li><a class="nav-link" href="{{ route('clientes.index') }}">Clientes</a></li>

                            <li><a class="nav-link" href="{{ route('consumos.index') }}">Consumos</a></li>

                            <li><a class="nav-link" href="{{ route('empleados.index') }}">Empleados</a></li>

                            <li><a class="nav-link" href="{{ route('habitacion.index') }}">Habitaciones</a></li>

                            <li><a class="nav-link" href="{{ route('productos.index') }}">Productos</a></li>

                            <li><a class="nav-link" href="{{ route('tarifarios.index') }}">Tarifario</a></li>

                            <li><a class="nav-link" href="{{ route('turnos.index') }}">Turnos</a></li>

                            <li><a class="nav-link" href="{{ route('reservacion.index') }}">Reservaciones</a></li>

                            <li><a class="nav-link" href="{{ route('diex.index') }}">Lista Negra</a></li>

                            <li class="nav-item dropdown">

                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                                    {{ Auth::user()->name }} <span class="caret"></span>

                                </a>


                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('logout') }}"

                                       onclick="event.preventDefault();

                                                     document.getElementById('logout-form').submit();">

                                        {{ __('Logout') }}

                                    </a>


                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">

                                        @csrf

                                    </form>

                                </div>

                            </li>

                        @endguest

                    </ul>

                </div>

            </div>

        </nav>


        <main class="py-4">

            <div class="container">

            @yield('content')

            </div>

        </main>

    </div>

</body>

</html> --}}
<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Afrodita</title>

    <!-- Fonts -->

    <link rel="dns-prefetch" href="https://fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
    <body class="theme-red">

        @include('layouts.header')

        @include('layouts.sidebar')

        <section class="content">

            <div class="container-fluid">

                @yield('content')
            
            </div>

        </section>
        
        <script type="text/javascript">
            const APP_URL = {!! json_encode(url('/')) !!};
        </script>

        <!-- Jquery Core Js -->
        <script src="{{ asset('js/plugins/jquery/jquery.min.js')}}"></script>

        <!-- Bootstrap Core Js -->
        <script src="{{ asset('js/plugins/bootstrap/js/bootstrap.js')}}"></script>

        <!-- Select Plugin Js -->

        <!-- Slimscroll Plugin Js -->
        <script src="{{ asset('js/plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

        <!-- Waves Effect Plugin Js -->
        <script src="{{ asset('js/plugins/node-waves/waves.js')}}"></script>

        <!-- Jquery CountTo Plugin Js -->
        <script src="{{ asset('js/plugins/jquery-countto/jquery.countTo.js')}}"></script>

        <!-- Morris Plugin Js -->
        <script src="{{ asset('js/plugins/raphael/raphael.min.js')}}"></script>
        <script src="{{ asset('js/plugins/morrisjs/morris.js')}}"></script>

        <!-- ChartJs -->
        <script src="{{ asset('js/plugins/chartjs/Chart.bundle.js') }}"></script>

        <!-- Flot Charts Plugin Js -->
        <script src="{{ asset('js/plugins/flot-charts/jquery.flot.js') }}"></script>
        <script src="{{ asset('js/plugins/flot-charts/jquery.flot.resize.js') }}"></script>
        <script src="{{ asset('js/plugins/flot-charts/jquery.flot.pie.js')}}"></script>
        <script src="{{ asset('js/plugins/flot-charts/jquery.flot.categories.js')}}"></script>
        <script src="{{ asset('js/plugins/flot-charts/jquery.flot.time.js')}}"></script>

        <!-- Sparkline Chart Plugin Js -->
        <script src="{{ asset('js/plugins/jquery-sparkline/jquery.sparkline.js')}}"></script>
    
        <!-- Custom Js -->
        <script src="{{ asset('js/admin.js')}}"></script>
        <script src="{{ asset('js/pages/index.js')}}"></script>

        <!-- Demo Js -->
        <script src="{{ asset('js/helpers.js')}}"></script>
        <script src="{{ asset('js/demo.js')}}"></script>

    </body>
</html>
