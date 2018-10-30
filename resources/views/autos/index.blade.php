@extends('layouts.app')


@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Autos</h2>

            </div>

            <div class="pull-right">

                @can('auto-create')

                <a class="btn btn-success" href="{{ route('autos.create') }}"> Crear un nuevo auto</a>

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

            <th>Placa</th>

            <th>Modelo</th>

            <th>Color</th>

            <th>Observación</th>

            <th>Estado</th>

            <th>Fecha</th>

            <th width="280px">Acción</th>

        </tr>

	    @foreach ($autos as $auto)

	    <tr>

	        <td>{{ ++$i }}</td>

	        <th>{{ $auto->placa }}</th>

            <th>{{ $auto->modelo }}</th>

            <th>{{ $auto->color }}</th>

            <th>{{ $auto->observacion }}</th>

            <th>{{ $auto->estado }}</th>

            <th>{{ $auto->created_at->format('d/m/Y') }}</th>

	        <td>

                <form action="{{ route('autos.destroy',$auto->id) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('autos.show',$auto->id) }}">Mostrar</a>

                    @can('auto-edit')

                    <a class="btn btn-primary" href="{{ route('autos.edit',$auto->id) }}">Editar</a>

                    @endcan


                    @csrf

                    @method('DELETE')

                    @can('auto-delete')

                    <button type="submit" class="btn btn-danger">Borrar</button>

                    @endcan

                </form>

	        </td>

	    </tr>

	    @endforeach

    </table>


    {!! $autos->links() !!}


@endsection