@extends('layouts.app')


@section('content')

<div class="block-header">
    <h2>EDITAR HABITACION</h2>
</div>

<div class="row">

    <div class="col-lg-12 m-b-20">

        <div class="pull-right">
            
            <a class="btn btn-primary" href="{{ route('habitacion.index') }}"> Atras</a>
        
        </div>

    </div>

</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Editar habitación
                </h2>
            </div>
            <div class="body">
                @if ($errors->any())

                    <div class="alert alert-danger">
            
                        <strong>Whoops!</strong> Hay algunos problemas con los datos ingresados.<br><br>
            
                        <ul>
            
                            @foreach ($errors->all() as $error)
            
                                <li>{{ $error }}</li>
            
                            @endforeach
            
                        </ul>
            
                    </div>
            
                @endif

                <form action="{{ route('habitacion.update', $habitacion->id) }}" method="POST">

                    @csrf
            
                    @method('PUT')

                    <label for="habitacion">Habitacion</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="number" id="habitacion" name="habitacion" value="{{ $habitacion->habitacion }}" class="form-control" placeholder="Habitacion">
                        </div>
                    </div>
                    <label for="observacion">Observación</label>
                    <div class="form-group">
                        <div class="form-line">
                            <textarea id="observacion" class="form-control" style="height:150px" name="observacion" placeholder="Observación">{{ $habitacion->observacion }}</textarea>
                        </div>
                    </div>
                    <label for="caracteristicas">Características</label>
                    <div class="form-group">
                        <div class="form-line">
                            <textarea id="caracteristicas" class="form-control" style="height:150px" name="caracteristicas" placeholder="Caracteristicas">{{ $habitacion->caracteristicas }}</textarea>
                        </div>
                    </div>
                    <label>Estado</label>
                    <div class="form-group">
                        {!! Form::select('estado', ['Disponible' => 'Disponible', 'En limpieza' => 'En limpieza', 'Dañada' => 'Dañada'], array('default' => $habitacion->estado)); !!}
                    </div>
                    <label>Tipo de habitacion</label>
                    <div class="form-group">
                        {!! Form::select('tipo',$tipo, $habitacion->tipo); !!}
                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary waves-effect">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection