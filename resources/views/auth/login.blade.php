<!DOCTYPE html>
<html>

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
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Afrodita</a>
            <small>Afrodita - Hoteles</small>
        </div>
        <div class="card">
            <div class="body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="msg">Iniciar sesión</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" id="email" placeholder="Nombre de usuario" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                        </div>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input id="password" type="password" placeholder="Contraseña" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                        </div>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input class="filled-in chk-col-pink" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">Recuérdame</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <a href="{{ route('register') }}">Registro</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>