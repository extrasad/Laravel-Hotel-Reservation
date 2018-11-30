@extends('layouts.app')


@section('content')

<div class="block-header">
    <h2>USUARIOS</h2>
</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Tabla de usuarios
                    <small>Esta sección permite crear y observar los actuales usuarios del sistema.</small>
                </h2>
            </div>


            <div class="body table-responsive">

                @if ($message = Session::get('success'))
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 align-right">
                        <a class="btn btn-success" href="{{ route('users.create') }}"> Crear Nuevo Usuario</a>
                    </div>
                </div>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nombre</th>
                            <th>Username</th>
                            <th>Rol</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $user)

                        <tr>

                            <td>{{ ++$i }}</td>

                            <td>{{ $user->name }}</td>

                            <td>{{ $user->username }}</td>

                            <td>

                            @if(!empty($user->getRoleNames()))

                                @foreach($user->getRoleNames() as $v)

                                <label class="badge badge-success">{{ $v }}</label>

                                @endforeach

                            @endif

                            </td>

                            <td>

                            <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Mostrar</a>

                            <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Editar</a>

                                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}

                                    {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}

                                {!! Form::close() !!}

                            </td>

                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{!! $data->render() !!}


@endsection