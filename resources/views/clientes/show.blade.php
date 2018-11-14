@extends('layouts.app')


@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2> Mostrar Cliente</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('clientes.index') }}"> Atras</a>

            </div>

        </div>

    </div>


    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Cedula de Identidad:</strong>

                {{ $cliente->ci }}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Nombre:</strong>

                {{ $cliente->nombre }}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Nacionalidad:</strong>

                {{ $cliente->nacionalidad }}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Observación:</strong>

                {{ $cliente->observacion }}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Estado:</strong>

                {{ $cliente->estado }}

            </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Fecha:</strong>

                {{ $cliente->created_at->format('d/m/Y') }}

            </div>

        </div>

        </div>

    </div>

@endsection