@extends('layouts.app')

@section('content')

<div class="block-header">
    <h2>TURNOS</h2>
</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Tabla de turnos
                    <small>Esta sección permite crear y observar los actuales turnos registrados del sistema.</small>
                </h2>
            </div>


            <div class="body table-responsive">

                @if ($message = Session::get('success'))

                    <div class="alert alert-success">
            
                        <p>{{ $message }}</p>
            
                    </div>
            
                @endif

                @can('turno-create')

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 align-right">
                            <a class="btn btn-success" href="{{ route('turnos.create') }}"> Crear un nuevo turno</a>
                        </div>
                    </div>

                @endcan

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>

                            <th>Fecha</th>
                
                            <th>Hora de Entrada</th>
                
                            <th>Hora de Salida</th>
                
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($turnos as $turno)

                        <tr>
                
                            <td>{{ ++$i }}</td>
                
                            <th>{{ $turno->fecha }}</th>
                
                            <th>{{ $turno->hora_entrada }}</th>
                
                            <th>{{ $turno->hora_salida }}</th>
                
                            <td>
                
                                <form action="{{ route('turnos.destroy',$turno->id) }}" method="POST">
                
                                    <a class="btn btn-info" href="{{ route('turnos.show',$turno->id) }}">Mostrar</a>
                
                                    @can('turno-edit')
                
                                    <a class="btn btn-primary" href="{{ route('turnos.edit',$turno->id) }}">Editar</a>
                
                                    @endcan
                
                
                                    @csrf
                
                                    @method('DELETE')
                
                                    @can('turno-delete')
                
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

{!! $turnos->links() !!}

@endsection