@extends('layouts.app')

@section('content')

<div class="block-header">
    <h2>CONSUMOS</h2>
</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Tabla de consumos
                    <small>Esta sección permite crear y observar los actuales consumos registrados del sistema.</small>
                </h2>
            </div>


            <div class="body table-responsive">

                @if ($message = Session::get('success'))

                    <div class="alert alert-success">
            
                        <p>{{ $message }}</p>
            
                    </div>
            
                @endif
            

                @can('consumo-create')
                
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 align-right">
                            <a class="btn btn-success" href="{{ route('consumos.create') }}"> Crear un nuevo consumo</a>
                        </div>
                    </div>

                @endcan

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Costo</th>
                
                            <th>Estado</th>
                
                            <th>Productos</th>
                
                            <th>Reservacion ID</th>
                
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($consumos as $consumo)
                        <tr>
                
                            <td>{{ ++$i }}</td>
                
                            <th>{{ $consumo->costo }}</th>
                
                            <th>{{ $consumo->estado }}</th>
                            
                            <th>
                            @foreach($consumo->producto as $producto)
                                {{ $producto->descripcion }}
                            @endforeach
                            </th>
                
                            <th> {{ $consumo->reservacion->id }} </th>
                
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{!! $consumos->links() !!}


@endsection