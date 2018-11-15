@extends('layouts.app')


@section('content')

<div class="block-header">
    <h2>INFORMACION DE TURNO</h2>
</div>

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('turnos.index') }}"> Atras</a>

        </div>

    </div>

</div>
<div class="row clearfix">
    <!-- Basic Examples -->
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    {{ $turno->fecha }}
                    <small>Información detallada del turno con fecha {{ $turno->fecha }} </small>
                </h2>
            </div>
            <div class="body">
                <ul class="list-group">
                    <li class="list-group-item"><strong class="font-bold col-orange">Fecha:</strong> {{ $turno->fecha }} </li>
                    <li class="list-group-item"><strong class="font-bold col-orange">Hora de entrada:</strong> {{ $turno->hora_entrada }}</li>
                    <li class="list-group-item"><strong class="font-bold col-orange">Hora de salida:</strong> {{ $turno->hora_salida }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection