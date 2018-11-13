@extends('layouts.app')


@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Habitaciones</h2>

            </div>

            <div class="pull-right">

                @can('habitacion-create')

                <a class="btn btn-success" href="{{ route('habitacion.create') }}"> Crear una nueva habitacion</a>

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

            <th>Costo</th>

            <th>Habitacion</th>

            <th>Observación</th>

            <th>Caracteristicas</th>

            <th>Tipo de habitacion</th>

            <th>Estado</th>

            <th width="280px">Acción</th>

        </tr>

	    @foreach ($habitaciones as $habitacion)

	    <tr>

	        <td>{{ ++$i }}</td>

	        <th>{{ $habitacion->costo }}</th>

            <th>{{ $habitacion->habitacion }}</th>

            <th>{{ $habitacion->observacion }}</th>

            <th>{{ $habitacion->caracteristicas }}</th>

            <th>{{ $habitacion->tipo }}</th>

            <th>{{ $habitacion->estado }}</th>

	        <td>

                <form action="{{ route('habitacion.destroy',$habitacion->id) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('habitacion.show',$habitacion->id) }}">Mostrar</a>

                    @can('habitacion-edit')

                    <a class="btn btn-primary" href="{{ route('habitacion.edit',$habitacion->id) }}">Editar</a>

                    @endcan


                    @csrf

                    @method('DELETE')

                    @can('habitacion-delete')

                    <button type="submit" class="btn btn-danger">Borrar</button>

                    @endcan

                </form>

	        </td>

	    </tr>

	    @endforeach

    </table>


    {!! $habitaciones->links() !!}


@endsection