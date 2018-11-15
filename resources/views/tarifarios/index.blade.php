@extends('layouts.app')


@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Tarifario</h2>

            </div>

            <div class="pull-right">

                @can('tarifario-create')

                <a class="btn btn-success" href="{{ route('tarifarios.create') }}"> Crear un nuevo Tarifario</a>

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

            <th>Tipo de habitación</th>

            <th width="280px">Acción</th>

        </tr>

	    @foreach ($tarifarios as $tarifario)

	    <tr>

	        <td>{{ ++$i }}</td>

	        <th>{{ $tarifario->tipo }}</th>

	        <td>

                <form action="{{ route('tarifarios.destroy',$tarifario->id) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('tarifarios.show',$tarifario->id) }}">Mostrar</a>

                    @can('tarifario-edit')

                    <a class="btn btn-primary" href="{{ route('tarifarios.edit',$tarifario->id) }}">Editar</a>

                    @endcan


                    @csrf

                    @method('DELETE')

                    @can('tarifario-delete')

                    <button type="submit" class="btn btn-danger">Borrar</button>

                    @endcan

                </form>

	        </td>

	    </tr>

	    @endforeach

    </table>


    {!! $tarifarios->links() !!}


@endsection