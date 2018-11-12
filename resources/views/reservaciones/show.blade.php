@extends('layouts.app')


@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2> Mostrar reservacion</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('reservaciones.index') }}"> Atras</a>

            </div>

        </div>

    </div>


    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>ID:</strong>

                {{ $reservacion->id }}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Fecha de entrada:</strong>

                {{ $reservacion->fecha_entrada }}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Fecha de salida:</strong>

                {{ $reservacion->fecha_salida }}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Hora de entrada:</strong>

                {{ $reservacion->hora_entrada }}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Hora de salida:</strong>

                {{ $reservacion->hora_salida }}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Observacion:</strong>

                {{ $reservacion->observacion }}

            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Estado:</strong>

                {{ $reservacion->estado }}

            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Consumo:</strong>

                {{ $reservacion->consumo }}

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Cliente:</strong>
                    @if(!empty($reservacion->cliente1))
                    @foreach($reservacion->cliente1 as $cliente)
                    {{ $reservacion->cliente->id }}
                    @endforeach
                    @endif
            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Acompañante:</strong>
                    @if(!empty($reservacion->cliente2))
                    @foreach($reservacion->cliente2 as $cliente)
                    {{ $reservacion->cliente->id }}
                    @endforeach
                    @endif
            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Auto:</strong>

                {{ $reservacion->auto }}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Habitacion:</strong>

                {{ $reservacion->habitacion }}

            </div>

        </div>

        </div>

    </div>

@endsection