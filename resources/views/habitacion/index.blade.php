@extends('layouts.app')

@section('content')

<div class="block-header">
    <h2>HABITACIONES</h2>
</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Tabla de habitaciones
                    <small>Esta sección permite crear y observar los actuales habitaciones registradas del sistema.</small>
                </h2>
            </div>


            <div class="body table-responsive">

                @if ($message = Session::get('success'))

                    <div class="alert alert-success">
            
                        <p>{{ $message }}</p>
            
                    </div>
            
                @endif

                @can('habitacion-create')

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 align-right">
                            <a class="btn btn-success" href="{{ route('habitacion.create') }}"> Crear una nueva habitacion</a>
                        </div>
                    </div>

                @endcan

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Costo</th>
                
                            <th>Habitacion</th>
                
                            <th>Observación</th>
                
                            <th>Caracteristicas</th>
                
                            <th>Tipo de habitacion</th>
                
                            <th>Estado</th>
                
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($habitaciones as $habitacion)

                        <tr>
                
                            <td>{{ ++$i }}</td>
                
                            <th>{{ $habitacion->costo }}</th>
                
                            <th>{{ $habitacion->habitacion }}</th>
                
                            <th>{{ $habitacion->observacion }}</th>
                
                            <th>{{ $habitacion->caracteristicas }}</th>
                
                            <th>{{ $habitacion->tipo }}</th>
                
                            <th>{{ $habitacion->estado }}</th>
                
                            <td>
                
                                <form action="{{ route('habitacion.destroy',$habitacion->id) }}" method="POST">
                
                                    <a class="btn btn-info" href="{{ route('habitacion.show',$habitacion->id) }}">Mostrar</a>
                
                                    @can('habitacion-edit')
                
                                    <a class="btn btn-primary" href="{{ route('habitacion.edit',$habitacion->id) }}">Editar</a>
                
                                    @endcan
                
                
                                    @csrf
                
                                    @method('DELETE')
                
                                    @can('habitacion-delete')
                
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

{!! $habitaciones->links() !!}


@endsection