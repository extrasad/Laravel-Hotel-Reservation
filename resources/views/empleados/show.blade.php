@extends('layouts.app')


@section('content')

<div class="block-header">
    <h2>INFORMACION DE EMPLEADO</h2>
</div>

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('empleados.index') }}"> Atras</a>

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
                    <li class="list-group-item"><strong class="font-bold col-orange">Número de cedula:</strong> {{ $empleado->ci }}</li>
                    <li class="list-group-item"><strong class="font-bold col-orange">Nombre:</strong> {{ $empleado->nombre }}</li>
                    <li class="list-group-item"><strong class="font-bold col-orange">Turnos:</strong>
                        @if(!empty($empleado->empleados_turnos($empleado->id)))
                        @foreach($empleado->empleados_turnos($empleado->id) as $turno)
                            <label class="badge badge-success">{{ $turno->turno_id }}</label> 
                        @endforeach
                        @endif                    
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection