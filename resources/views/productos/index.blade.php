@extends('layouts.app')


@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Productos</h2>

            </div>

            <div class="pull-right">

                @can('producto-create')

                <a class="btn btn-success" href="{{ route('productos.create') }}"> Crear un nuevo producto</a>

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

            <th>Descripcion</th>

            <th width="280px">Acción</th>

        </tr>

	    @foreach ($productos as $producto)

	    <tr>

	        <td>{{ ++$i }}</td>

            <th>{{ $producto->costo }}</th>

            <th>{{ $producto->descripcion}}</th>

	        <td>

                <form action="{{ route('productos.destroy',$producto->id) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('productos.show',$producto->id) }}">Mostrar</a>

                    @can('producto-edit')

                    <a class="btn btn-primary" href="{{ route('productos.edit',$producto->id) }}">Editar</a>

                    @endcan


                    @csrf

                    @method('DELETE')

                    @can('producto-delete')

                    <button type="submit" class="btn btn-danger">Borrar</button>

                    @endcan

                </form>

	        </td>

	    </tr>

	    @endforeach

    </table>


    {!! $productos->links() !!}


@endsection