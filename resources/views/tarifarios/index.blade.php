@extends('layouts.app')

@section('content')

<div class="block-header">
    <h2>TARIFARIOS</h2>
</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Tabla de tarifarios
                    <small>Esta sección permite crear y observar los actuales tarifarios registrados del sistema.</small>
                </h2>
            </div>


            <div class="body table-responsive">

                @if ($message = Session::get('success'))

                    <div class="alert alert-success">
            
                        <p>{{ $message }}</p>
            
                    </div>
            
                @endif

                @can('tarifario-create')

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 align-right">
                        <a class="btn btn-success" href="{{ route('tarifarios.create') }}"> Crear un nuevo Tarifario</a>
                    </div>
                </div>

                @endcan

<<<<<<< HEAD
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
=======
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
>>>>>>> master

                            <th>Tipo de habitación</th>
                
                            <th>Precio</th>
                
                            <th width="280px">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tarifarios as $tarifario)

                        <tr>

                            <td>{{ ++$i }}</td>

                            <th>{{ $tarifario->tipo }}</th>

                            <th>{{ $tarifario->precio }}</th>

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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{!! $tarifarios->links() !!}

@endsection