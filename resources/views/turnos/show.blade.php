@extends('layouts.app')


@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2> Mostrar Turno</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('turnos.index') }}"> Atras</a>

            </div>

        </div>

    </div>


    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Fecha:</strong>

                {{ $turno->fecha }}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Hora de Entrada:</strong>

                {{ $turno->hora_entrada }}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Hora de Salida:</strong>

                {{ $turno->hora_salida }}

            </div>

        </div>

    </div>

@endsection