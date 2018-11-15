@extends('layouts.app')


@section('content')

<div class="block-header">
    <h2>INFORMACION DE CONSUMO</h2>
</div>

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('consumos.index') }}"> Atras</a>

        </div>

    </div>

</div>
<div class="row clearfix">
    <!-- Basic Examples -->
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    {{ $consumo->costo }}
                    <small>Información detallada del consumo con costo de {{ $consumo->costo }}</small>
                </h2>
            </div>
            <div class="body">
                <ul class="list-group">
                    <li class="list-group-item"><strong class="font-bold col-orange">Costo:</strong> {{ $consumo->costo }}</li>
                    <li class="list-group-item"><strong class="font-bold col-orange">Estado:</strong> {{ $consumo->estado }}</li>
                    <li class="list-group-item"><strong class="font-bold col-orange">Productos:</strong> 
                        @foreach($consumo->producto as $producto)
                            {{ $producto->descripcion }}
                        @endforeach
                    </li>
                    <li class="list-group-item"><strong class="font-bold col-orange">Reservación ID:</strong> {{ $consumo->reservacion->id}}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection