@extends('layouts.app')

@section('content')

<div class="block-header">
    <h2>EMPLEADOS</h2>
</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Tabla de empleados
                    <small>Esta sección permite crear y observar los actuales empleados registrados del sistema.</small>
                </h2>
            </div>


            <div class="body table-responsive">

                @if ($message = Session::get('success'))

                    <div class="alert alert-success">
            
                        <p>{{ $message }}</p>
            
                    </div>
            
                @endif

                @can('empleado-create')

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 align-right">
                            <a class="btn btn-success" href="{{ route('empleados.create') }}"> Crear un nuevo empleado</a>
                        </div>
                    </div>

                @endcan

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>

                            <th>Cedula de Identidad</th>
                
                            <th>Nombre</th>
                
                            <th>Turnos</th>
                
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($empleados as $empleado)
                        <tr>
                
                            <td>{{ ++$i }}</td>
                
                            <th>{{ $empleado->ci }}</th>
                
                            <th>{{ $empleado->nombre }}</th>
                
                            <th>
                            
                            @if(!empty($empleado->empleados_turnos($empleado->id)))
                                @foreach($empleado->empleados_turnos($empleado->id) as $turno)
                                    <label class="badge badge-success">{{ $turno->turno_id }}</label> 
                                @endforeach
                            @endif
                            </th>
                
                            <td>
                
                                <form action="{{ route('empleados.destroy',$empleado->id) }}" method="POST">
                
                                    <a class="btn btn-info" href="{{ route('empleados.show',$empleado->id) }}">Mostrar</a>
                
                                    @can('empleado-edit')
                
                                    <a class="btn btn-primary" href="{{ route('empleados.edit',$empleado->id) }}">Editar</a>
                
                                    @endcan
                
                
                                    @csrf
                
                                    @method('DELETE')
                
                                    @can('empleado-delete')
                
                                    <button type="submit" class="btn btn-danger">Borrar</button>
                
                                    @endcan
                
                                </form>
                
                            </td>
                
                        </tr>
                
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{!! $empleados->links() !!}


@endsection