@extends('layouts.app')


@section('content')

<div class="block-header">
    <h2>CREAR USUARIO</h2>
</div>

<div class="row">

    <div class="col-lg-12 m-b-20">

        <div class="pull-right">
            
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Atras</a>
        
        </div>

    </div>

</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Creación de usuario
                </h2>
            </div>
            <div class="body">
                @if (count($errors) > 0)

                    <div class="alert alert-danger">
                
                        <strong>Whoops!</strong> Hay algunos problemas con los datos ingresados.<br><br>
                
                        <ul>
                
                            @foreach ($errors->all() as $error)
                
                                <li>{{ $error }}</li>
                
                            @endforeach
                
                        </ul>
                
                    </div>
                
                @endif

                {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
                    <label for="name">Nombre</label>
                    <div class="form-group">
                        <div class="form-line">
                            {!! Form::text('name', null, array('placeholder' => 'Ingrese el nombre','class' => 'form-control','id' => 'name')) !!}
                        </div>
                    </div>
                    <label for="username">Nombre de usuario</label>
                    <div class="form-group">
                        <div class="form-line">
                            {!! Form::text('username', null, array('placeholder' => 'Ingrese el nombre de usuario','class' => 'form-control','id' => 'username')) !!}
                        </div>
                    </div>
                    <label for="password">Contraseña</label>
                    <div class="form-group">
                        <div class="form-line">
                            {!! Form::password('password', array('placeholder' => 'Ingrese la contraseña','class' => 'form-control', 'id' => 'password')) !!}
                        </div>
                    </div>
                    <label for="confirm-password">Confirmar contraseña</label>
                    <div class="form-group">
                        <div class="form-line">
                            {!! Form::password('confirm-password', array('placeholder' => 'Confirme la contraseña','class' => 'form-control', 'id' => 'confirm-password')) !!}
                        </div>
                    </div>
                    <label for="roles">Roles</label>
                    <div class="form-group">
                        <div class="form-line">
                            {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple', 'id' => 'roles')) !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary waves-effect">Crear usuario</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection