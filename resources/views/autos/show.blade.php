@extends('layouts.app')


@section('content')

<div class="block-header">
    <h2>INFORMACION DE AUTO</h2>
</div>

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('autos.index') }}"> Atras</a>

        </div>

    </div>

</div>
<div class="row clearfix">
    <!-- Basic Examples -->
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    {{$auto->placa}}
                    <small>Información detallada del auto con placa {{$auto->placa}}</small>
                </h2>
            </div>
            <div class="body">
                <ul class="list-group">
                    <li class="list-group-item"><strong class="font-bold col-orange">Placa:</strong> {{ $auto->placa }}</li>
                    <li class="list-group-item"><strong class="font-bold col-orange">Modelo:</strong> {{ $auto->modelo }}</li>
                    <li class="list-group-item"><strong class="font-bold col-orange">Color:</strong> {{ $auto->color }}</li>
                    <li class="list-group-item"><strong class="font-bold col-orange">Observación:</strong> {{ $auto->observacion }}</li>
                    <li class="list-group-item"><strong class="font-bold col-orange">Estado:</strong> {{ $auto->estado }}</li>
                    <li class="list-group-item"><strong class="font-bold col-orange">Fecha:</strong> {{ $auto->created_at->format('d/m/Y')}} </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection