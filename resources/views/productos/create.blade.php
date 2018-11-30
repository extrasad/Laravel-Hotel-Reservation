@extends('layouts.app')


@section('content')

<div class="block-header">
    <h2>AGREGAR PRODUCTO</h2>
</div>

<div class="row">

    <div class="col-lg-12 m-b-20">

        <div class="pull-right">
            
            <a class="btn btn-primary" href="{{ route('productos.index') }}"> Atras</a>
        
        </div>

    </div>

</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Creación de producto
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

                <form action="{{ route('productos.store') }}" method="POST">
                    @csrf

                    <label for="costo">Costo</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="number" id="costo" step="any" name="costo" class="form-control" placeholder="Costo">
                        </div>
                    </div>
                    <label for="descripcion">Descripción</label>
                    <div class="form-group">
                        <div class="form-line">
                            <textarea id="descripcion" class="form-control" style="height:150px" name="descripcion" placeholder="Descripción"></textarea>
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