@extends('layouts.app')


@section('content')

<div class="block-header">
    <h2>INFORMACION DE TARIFARIO</h2>
</div>

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('tarifarios.index') }}"> Atras</a>

        </div>

    </div>

</div>
<div class="row clearfix">
    <!-- Basic Examples -->
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    {{ $tarifario->tipo }}
                    <small>Información detallada del tarifario para la habitacion de tipo {{ $tarifario->tipo }} </small>
                </h2>
            </div>
            <div class="body">
                <ul class="list-group">
                    <li class="list-group-item"><strong class="font-bold col-orange">Tipo de habitación:</strong> {{ $tarifario->tipo }} </li>
                    <li class="list-group-item"><strong class="font-bold col-orange">Costo:</strong> {{ $tarifario->precio }} </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection