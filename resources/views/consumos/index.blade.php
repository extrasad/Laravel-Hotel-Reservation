@extends('layouts.app')


@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Consumos</h2>

            </div>

            <div class="pull-right">

                @can('consumo-create')

                <a class="btn btn-success" href="{{ route('consumos.create') }}"> Crear un nuevo consumo</a>

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

            <th>Estado</th>

            <th width="280px">Acción</th>

        </tr>

	    @foreach ($consumos as $consumo)

	    <tr>

	        <td>{{ ++$i }}</td>

            <th>{{ $consumo->costo }}</th>

            <th>{{ $consumo->created_at->format('H:i:s') }}</th>

            <th>{{ $consumo->estado }}</th>

            <th>{{ $consumo->created_at->format('d/m/Y') }}</th>

	        <td>

                <form action="{{ route('consumos.destroy',$consumo->id) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('consumos.show',$consumo->id) }}">Mostrar</a>

                    @can('consumo-edit')

                    <a class="btn btn-primary" href="{{ route('consumos.edit',$consumo->id) }}">Editar</a>

                    @endcan


                    @csrf

                    @method('DELETE')

                    @can('consumo-delete')

                    <button type="submit" class="btn btn-danger">Borrar</button>

                    @endcan

                </form>

	        </td>

	    </tr>

	    @endforeach

    </table>


    {!! $consumos->links() !!}


@endsection