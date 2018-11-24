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

    <!-- Jquery Core Js -->
    <script src="{{ asset('js/plugins/jquery/jquery.min.js')}}"></script>
    
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
        
        <script type="text/javascript">
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
        </script>

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
