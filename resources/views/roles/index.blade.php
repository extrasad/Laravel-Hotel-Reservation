@extends('layouts.app')


@section('content')

<div class="block-header">
    <h2>ROLES</h2>
</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Tabla de roles
                    <small>Esta sección permite crear y observar los actuales roles del sistema.</small>
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
                        <a class="btn btn-success" href="{{ route('roles.create') }}"> Crear Nuevo Rol</a>
                    </div>
                </div>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nombre</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $role)

                            <tr>
                        
                                <td>{{ ++$i }}</td>
                        
                                <td>{{ $role->name }}</td>
                        
                                <td>
                        
                                    <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Mostrar</a>
                        
                                    @can('role-edit')
                        
                                        <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Editar</a>
                        
                                    @endcan
                        
                                    @can('role-delete')
                        
                                        {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                        
                                            {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                        
                                        {!! Form::close() !!}
                        
                                    @endcan
                        
                                </td>
                        
                            </tr>
                        
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{!! $roles->render() !!}


@endsection