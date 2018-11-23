@extends('layouts.app')


@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Promociones</h2>

            </div>

            <div class="pull-right">

                @can('promo-create')

                <a class="btn btn-success" href="{{ route('promos.create') }}"> Crear una nueva promocion</a>

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

            <th>Tipo</th>

            <th>Descripcion</th>

            <th>Horas</th>

            <th width="280px">Acción</th>

        </tr>

	    @foreach ($promos as $promo)

	    <tr>

	        <td>{{ ++$i }}</td>

	        <th>{{ $promo->costo }}</th>

            <th>{{ $promo->tipo }}</th>

            <th>{{ $promo->descripcion }}</th>

            <th>{{ $promo->horas }}</th>

	        <td>

                <form action="{{ route('promos.destroy',$promo->id) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('promos.show',$promo->id) }}">Mostrar</a>

                    @can('promo-edit')

                    <a class="btn btn-primary" href="{{ route('promos.edit',$promo->id) }}">Editar</a>

                    @endcan


                    @csrf

                    @method('DELETE')

                    @can('promo-delete')

                    <button type="submit" class="btn btn-danger">Borrar</button>

                    @endcan

                </form>

	        </td>

	    </tr>

	    @endforeach

    </table>


    {!! $promos->links() !!}


@endsection