@extends('layouts.app')

@section('content')

<div class="block-header">
    <h2>PRODUCTOS</h2>
</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Tabla de productos
                    <small>Esta sección permite crear y observar los actuales productos registrados del sistema.</small>
                </h2>
            </div>


            <div class="body table-responsive">

                @if ($message = Session::get('success'))

                    <div class="alert alert-success">
            
                        <p>{{ $message }}</p>
            
                    </div>
            
                @endif

                @can('producto-create')

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 align-right">
                            <a class="btn btn-success" href="{{ route('productos.create') }}"> Crear un nuevo producto</a>
                        </div>
                    </div>

                @endcan

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>

                            <th>Costo</th>
                
                            <th>Descripcion</th>
                
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{!! $productos->links() !!}

@endsection