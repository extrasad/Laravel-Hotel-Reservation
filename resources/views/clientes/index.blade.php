@extends('layouts.app')


@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Clientes</h2>

            </div>

            <div class="pull-right">

                @can('cliente-create')

                <a class="btn btn-success" href="{{ route('clientes.create') }}"> Crear un nuevo cliente</a>

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

            <th>Nacionalidad</th>

            <th>Observación</th>

            <th>Estado</th>

            <th>Fecha</th>

            <th width="280px">Acción</th>

        </tr>

	    @foreach ($clientes as $cliente)

	    <tr>

	        <td>{{ ++$i }}</td>

	        <th>{{ $cliente->ci }}</th>

            <th>{{ $cliente->nombre }}</th>

            <th>{{ $cliente->nacionalidad }}</th>

            <th>{{ $cliente->observacion }}</th>

            <th>{{ $cliente->estado }}</th>

            <th>{{ $cliente->created_at->format('d/m/Y') }}</th>

	        <td>

                <form action="{{ route('clientes.destroy',$cliente->id) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('clientes.show',$cliente->id) }}">Mostrar</a>

                    @can('cliente-edit')

                    <a class="btn btn-primary" href="{{ route('clientes.edit',$cliente->id) }}">Editar</a>

                    @endcan


                    @csrf

                    @method('DELETE')

                    @can('cliente-delete')

                    <button type="submit" class="btn btn-danger">Borrar</button>

                    @endcan

                </form>

	        </td>

	    </tr>

	    @endforeach

    </table>


    {!! $clientes->links() !!}


@endsection