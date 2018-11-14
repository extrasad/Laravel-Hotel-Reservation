@extends('layouts.app')


@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Turnos</h2>

            </div>

            <div class="pull-right">

                @can('turno-create')

                <a class="btn btn-success" href="{{ route('turnos.create') }}"> Crear un nuevo turno</a>

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

            <th>Fecha</th>

            <th>Hora de Entrada</th>

            <th>Hora de Salida</th>

            <th width="280px">Acción</th>

        </tr>

	    @foreach ($turnos as $turno)

	    <tr>

	        <td>{{ ++$i }}</td>

            <th>{{ $turno->fecha }}</th>

            <th>{{ $turno->hora_entrada }}</th>

            <th>{{ $turno->hora_salida }}</th>

	        <td>

                <form action="{{ route('turnos.destroy',$turno->id) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('turnos.show',$turno->id) }}">Mostrar</a>

                    @can('turno-edit')

                    <a class="btn btn-primary" href="{{ route('turnos.edit',$turno->id) }}">Editar</a>

                    @endcan


                    @csrf

                    @method('DELETE')

                    @can('turno-delete')

                    <button type="submit" class="btn btn-danger">Borrar</button>

                    @endcan

                </form>

	        </td>

	    </tr>

	    @endforeach

    </table>


    {!! $turnos->links() !!}


@endsection