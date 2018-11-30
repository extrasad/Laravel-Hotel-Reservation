@extends('layouts.app')

@section('content')

<div class="block-header">
    <h2>CLIENTES</h2>
</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Tabla de clientes
                    <small>Esta sección permite crear y observar los actuales clientes registrados del sistema.</small>
                </h2>
            </div>


            <div class="body table-responsive">

                @if ($message = Session::get('success'))

                    <div class="alert alert-success">
            
                        <p>{{ $message }}</p>
            
                    </div>
            
                @endif

                @can('cliente-create')

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 align-right">
                            <a class="btn btn-success" href="{{ route('clientes.create') }}"> Crear un nuevo cliente</a>
                        </div>
                    </div>
                    
                @endcan

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>

                            <th>Cedula de Identidad</th>
                
                            <th>Nombre</th>
                
                            <th>Nacionalidad</th>
                
                            <th>Observación</th>
                
                            <th>Estado</th>
                
                            <th>Fecha</th>
                
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)

                        <tr>

                            <td>{{ ++$i }}</td>

                            <th>{{ $cliente->ci }}</th>

                            <th>{{ $cliente->nombre }}</th>

                            <th>{{ $cliente->nacionalidad }}</th>

                            <th>{{ $cliente->observacion }}</th>

                            <th>{{ $cliente->estado }}</th>

                            <th>{{ $cliente->created_at->format('d/m/Y') }}</th>

                            <td>

                                <form action="{{ route('clientes.destroy',$cliente->id) }}" method="POST">

                                    <a class="btn btn-info" href="{{ route('clientes.show',$cliente->id) }}">Mostrar</a>

                                    @can('cliente-edit')

                                    <a class="btn btn-primary" href="{{ route('clientes.edit',$cliente->id) }}">Editar</a>

                                    @endcan


                                    @csrf

                                    @method('DELETE')

                                    @can('cliente-delete')

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

{!! $clientes->links() !!}


@endsection