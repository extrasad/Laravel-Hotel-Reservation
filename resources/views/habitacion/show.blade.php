@extends('layouts.app')


@section('content')

<div class="block-header">
    <h2>INFORMACION DE EMPLEADO</h2>
</div>

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('habitacion.index') }}"> Atras</a>

        </div>

    </div>

</div>
<div class="row clearfix">
    <!-- Basic Examples -->
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    {{ $empleado->nombre }}
                    <small>Información detallada del empleado {{ $empleado->nombre }} </small>
                </h2>
            </div>
            <div class="body">
                <ul class="list-group">
                    <li class="list-group-item"><strong class="font-bold col-orange">Costo:</strong> {{ $habitacion->costo }} </li>
                    <li class="list-group-item"><strong class="font-bold col-orange">Habitacion:</strong> {{ $habitacion->habitacion }}</li>
                    <li class="list-group-item"><strong class="font-bold col-orange">Observación:</strong> {{ $habitacion->observacion }}</li>
                    <li class="list-group-item"><strong class="font-bold col-orange">Características:</strong> {{ $habitacion->caracteristicas }}</li>
                    <li class="list-group-item"><strong class="font-bold col-orange">Tipo de habitación:</strong> {{ $habitacion->tipo }}</li>
                    <li class="list-group-item"><strong class="font-bold col-orange">Estado:</strong> {{ $habitacion->estado }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection