@extends('layouts.app')


@section('content')

<div class="block-header">
    <h2>EDITAR ROL</h2>
</div>

<div class="row">

    <div class="col-lg-12 m-b-20">

        <div class="pull-right">
            
            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Atras</a>
        
        </div>

    </div>

</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Editar rol
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

                {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
                    <label for="name">Nombre</label>
                    <div class="form-group">
                        <div class="form-line">
                            {!! Form::text('name', null, array('placeholder' => 'Ingrese nombre del rol','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <label>Permisos</label>
                    <div class="form-group">
                        <div class="form-line">
                            @foreach($permission as $value)

                            {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'filled-in', 'id' => 'input-'.$value->id)) }}
                            <label for="input-{{$value->id}}" class="">{{ $value->name}}</label>
                
                            </br>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary waves-effect">Editar rol</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection