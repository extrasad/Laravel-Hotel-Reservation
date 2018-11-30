@extends('layouts.app')

@section('content')

<div class="block-header">
    <h2>AGREGAR EMPLEADO</h2>
</div>

<div class="row">

    <div class="col-lg-12 m-b-20">

        <div class="pull-right">
            
            <a class="btn btn-primary" href="{{ route('empleados.index') }}"> Atras</a>
        
        </div>

    </div>

</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Creación de empleado
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

                <form action="{{ route('empleados.store') }}" method="POST">
                    @csrf

                    <label for="ci">Cédula de identidad</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="ci" name="ci" class="form-control" placeholder="Cedula de Identidad">
                        </div>
                    </div>
                    <label for="nombre">Nombre</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre">
                        </div>
                    </div>
                    <label for="turnos">Turnos</label>
                    <div class="form-group">
                        {!! Form::select('turnos[]', $turnos,[], array('class' => 'form-control','multiple', 'id' => 'turnos')) !!}
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