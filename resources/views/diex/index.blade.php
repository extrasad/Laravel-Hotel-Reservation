@extends('layouts.app')


@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Lista Negra</h2>

            </div>

            <div class="pull-right">

                @can('diex-create')

                <a class="btn btn-success" href="{{ route('diex.create') }}"> Crear nuevo registro</a>

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

            <th>Nombre</th>

            <th>Cedula de identidad</th>

            <th>Observación</th>

            <th>Placa</th>

            <th>Estado</th>

            <th width="280px">Acción</th>

        </tr>

	    @foreach ($diex as $diex)

	    <tr>

	        <td>{{ ++$i }}</td>

	        <th>{{ $diex->nombre }}</th>

            <th>{{ $diex->ci }}</th>

            <th>{{ $diex->observacion }}</th>

            <th>{{ $diex->placa }}</th>

            <th>{{ $diex->estado }}</th>

	        <td>

                <form action="{{ route('diex.destroy',$diex->id) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('diex.show',$diex->id) }}">Mostrar</a>

                    @can('diex-edit')

                    <a class="btn btn-primary" href="{{ route('diex.edit',$diex->id) }}">Editar</a>

                    @endcan


                    @csrf

                    @method('DELETE')

                    @can('diex-delete')

                    <button type="submit" class="btn btn-danger">Borrar</button>

                    @endcan

                </form>

	        </td>

	    </tr>

	    @endforeach

    </table>

{!! $diex->links() !!}

@endsection