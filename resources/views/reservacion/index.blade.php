@extends('layouts.app')

@section('content')

<div class="block-header">
    <h2>RESERVACIONES</h2>
</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Tabla de reservaciones
                    <small>Esta sección permite crear y observar los actuales reservaciones registradas del sistema.</small>
                </h2>
            </div>


            <div class="body table-responsive">

                @if ($message = Session::get('success'))

                    <div class="alert alert-success">
            
                        <p>{{ $message }}</p>
            
                    </div>
            
                @endif

                @can('reservacion-create')

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 align-right">
                            <a class="btn btn-success" href="{{ route('reservacion.create') }}"> Crear una nueva reservacion</a>
                        </div>
                    </div>

                @endcan

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                
                            <th>Estado</th>
                
                            <th>Consumo</th>
                
                            <th>Cliente</th>
                
                            <th>Acompañante</th>
                
                            <th>Auto</th>
                
                            <th>Habitacion</th>
                
                            <th>Costo</th>
                
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservaciones as $reservacion)
                        <tr>
                
                            <td>{{ ++$i }}</td>
                
                            <th>{{ $reservacion->id }}</th>
                
                            <th>{{ $reservacion->estado }}</th>
                
                            <th>@if(isset($reservacion->consumo->costo))
                            {{ $reservacion->consumo->costo}}
                            @endif
                            </th>
                
                            <th>{{ $reservacion->cliente1->ci }}</th>
                
                            <th>{{ $reservacion->cliente2->ci }}</th>
                
                            <th>{{ $reservacion->auto->placa }}</th>
                
                            <th>{{ $reservacion->habitacion->habitacion }}</th>
                
                            <th>{{ $reservacion->costo }}</th>
                
                
                            <td>
                
                                <form action="{{ route('reservacion.destroy',$reservacion->id) }}" method="POST">
                
                                    <a class="btn btn-info" href="{{ route('reservacion.show',$reservacion->id) }}">Mostrar</a>
                
                                    <a href="{{ route('reservacion.pdf',$reservacion->id) }}" class="btn btn-sm btn-primary">Descargar Factura en PDF</a>
                
                                    @can('reservacion-edit')
                
                                    <a class="btn btn-primary" href="{{ route('reservacion.edit',$reservacion->id) }}">Editar</a>
                
                                    @endcan
                
                
                                    @csrf
                
                                    @method('DELETE')
                
                                    @can('reservacion-delete')
                
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

{!! $reservaciones->links() !!}

@endsection