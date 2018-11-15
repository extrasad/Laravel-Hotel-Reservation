@extends('layouts.app')


@section('content')

<div class="block-header">
    <h2>INFORMACION DE PRODUCTO</h2>
</div>

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('productos.index') }}"> Atras</a>

        </div>

    </div>

</div>
<div class="row clearfix">
    <!-- Basic Examples -->
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    {{ $producto->costo }}
                    <small>Información detallada del producto con costo {{ $producto->costo }} </small>
                </h2>
            </div>
            <div class="body">
                <ul class="list-group">
                    <li class="list-group-item"><strong class="font-bold col-orange">Costo:</strong> {{ $producto->costo }} </li>
                    <li class="list-group-item"><strong class="font-bold col-orange">Descripcion:</strong> {{ $producto->descripcion}}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection