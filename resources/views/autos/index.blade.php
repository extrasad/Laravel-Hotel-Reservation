@extends('layouts.app')


@section('content')

<div class="block-header">
    <h2>AUTOS</h2>
</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Tabla de autos
                    <small>Esta sección permite crear y observar los actuales autos registrados del sistema.</small>
                </h2>
            </div>


            <div class="body table-responsive">

                @if ($message = Session::get('success'))

                    <div class="alert alert-success">
            
                        <p>{{ $message }}</p>
            
                    </div>
            
                @endif

                @can('auto-create')

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 align-right">
                            <a class="btn btn-success" href="{{ route('autos.create') }}"> Crear un nuevo auto</a>
                        </div>
                    </div>

                @endcan

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Placa</th>
                            <th>Modelo</th>
                            <th>Color</th>
                            <th>Observación</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($autos as $auto)
                        <tr>
                
                            <td>{{ ++$i }}</td>
                
                            <th>{{ $auto->placa }}</th>
                
                            <th>{{ $auto->modelo }}</th>
                
                            <th>{{ $auto->color }}</th>
                
                            <th>{{ $auto->observacion }}</th>
                
                            <th>{{ $auto->estado }}</th>
                
                            <th>{{ $auto->created_at->format('d/m/Y') }}</th>
                
                            <td>
                
                                <form action="{{ route('autos.destroy',$auto->id) }}" method="POST">
                
                                    <a class="btn btn-info" href="{{ route('autos.show',$auto->id) }}">Mostrar</a>
                
                                    @can('auto-edit')
                
                                    <a class="btn btn-primary" href="{{ route('autos.edit',$auto->id) }}">Editar</a>
                
                                    @endcan
                
                
                                    @csrf
                
                                    @method('DELETE')
                
                                    @can('auto-delete')
                
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

{!! $autos->links() !!}


@endsection