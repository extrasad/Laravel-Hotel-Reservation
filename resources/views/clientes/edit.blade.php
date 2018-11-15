@extends('layouts.app')


@section('content')

<div class="block-header">
    <h2>EDITAR CLIENTE</h2>
</div>

<div class="row">

    <div class="col-lg-12 m-b-20">

        <div class="pull-right">
            
            <a class="btn btn-primary" href="{{ route('clientes.index') }}"> Atras</a>
        
        </div>

    </div>

</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Editar cliente
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

                <form action="{{ route('clientes.update',$cliente->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <label for="ci">Cédula de identidad</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="ci" name="ci" value="{{ $cliente->ci }}" class="form-control" placeholder="Cedula de Identidad">
                        </div>
                    </div>
                    <label for="nombre">Nombre</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="nombre" name="nombre" value="{{ $cliente->nombre }}" class="form-control" placeholder="Nombre">
                        </div>
                    </div>
                    <label for="nacionalidad">Nacionalidad</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="nacionalidad" class="form-control" value="{{ $cliente->nacionalidad }}" placeholder="Nacionalidad">
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