@extends('layouts.app')


@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2> Mostrar reservacion</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('reservacion.index') }}"> Atras</a>

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

                {{ $reservacion->created_at->format('d/m/Y') }}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Hora de entrada:</strong>

                {{ $reservacion->created_at->format('H:i:s') }}

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

                <strong>Hora de salida:</strong>

                {{ $reservacion->hora_salida }}

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

                {{ $reservacion->consumo->costo }}

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Cliente:</strong>
                    @if(!empty($reservacion->cliente1->ci))
                        {{ $reservacion->cliente1->ci }}
                    @endif
            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Acompañante:</strong>
                    @if(!empty($reservacion->cliente2->ci))
                    {{ $reservacion->cliente2->ci  }}
                    @endif
            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Auto:</strong>

                {{ $reservacion->auto->placa }}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Habitacion:</strong>

                {{ $reservacion->habitacion->habitacion }}

            </div>

        </div>

        </div>

    </div>

@endsection