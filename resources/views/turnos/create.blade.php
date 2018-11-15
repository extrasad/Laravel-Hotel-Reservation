@extends('layouts.app')


@section('content')

<div class="block-header">
    <h2>AGREGAR TURNO</h2>
</div>

<div class="row">

    <div class="col-lg-12 m-b-20">

        <div class="pull-right">
            
            <a class="btn btn-primary" href="{{ route('turnos.index') }}"> Atras</a>
        
        </div>

    </div>

</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Creación de turno
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

                <form action="{{ route('turnos.store') }}" method="POST">
                    @csrf

                    <label for="fecha">Fecha</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="date" id="fecha" name="fecha" class="form-control">
                        </div>
                    </div>
                    <label for="hora_entrada">Hora de entrada</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="time" id="hora_entrada" name="hora_entrada" class="form-control">
                        </div>
                    </div>
                    <label for="hora_salida">Hora de salida</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="time" id="hora_salida" name="hora_salida" class="form-control">
                        </div>
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