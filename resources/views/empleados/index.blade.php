@extends('layouts.app')


@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Empleados</h2>

            </div>

            <div class="pull-right">

                @can('empleado-create')

                <a class="btn btn-success" href="{{ route('empleados.create') }}"> Crear un nuevo empleado</a>

                @endcan

            </div>

        </div>

    </div>


    @if ($message = Session::get('success'))

        <div class="alert alert-success">

            <p>{{ $message }}</p>

        </div>

    @endif


    <table class="table table-bordered">

        <tr>

            <th>No</th>

            <th>Cedula de Identidad</th>

            <th>Nombre</th>

            <th>Turnos</th>

            <th width="280px">Acción</th>

        </tr>

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

    </table>


    {!! $empleados->links() !!}


@endsection