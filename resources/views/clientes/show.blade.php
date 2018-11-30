@extends('layouts.app')


@section('content')

<div class="block-header">
    <h2>INFORMACION DE CLIENTE</h2>
</div>

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('clientes.index') }}"> Atras</a>

        </div>

    </div>

</div>
<div class="row clearfix">
    <!-- Basic Examples -->
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    {{ $cliente->nombre }}
                    <small>Información detallada del cliente {{ $cliente->nombre }} </small>
                </h2>
            </div>
            <div class="body">
                <ul class="list-group">
                    <li class="list-group-item"><strong class="font-bold col-orange">Número de cedula:</strong> {{ $cliente->ci }}</li>
                    <li class="list-group-item"><strong class="font-bold col-orange">Nombre:</strong> {{ $cliente->nombre }}</li>
                    <li class="list-group-item"><strong class="font-bold col-orange">Nacionalidad:</strong> {{ $cliente->nacionalidad }}</li>
                    <li class="list-group-item"><strong class="font-bold col-orange">Observación:</strong> {{ $cliente->observacion }} </li>
                    <li class="list-group-item"><strong class="font-bold col-orange">Estado:</strong> {{ $cliente->estado }}</li>
                    <li class="list-group-item"><strong class="font-bold col-orange">Fecha:</strong> {{ $cliente->created_at->format('d/m/Y') }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection