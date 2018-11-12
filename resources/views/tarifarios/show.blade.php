@extends('layouts.app')


@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2> Mostrar Tarifario</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('tarifarios.index') }}"> Atras</a>

            </div>

        </div>

    </div>


    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Tipo de habitación:</strong>

                {{ $tarifario->tipo }}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Precio:</strong>

                {{ $tarifario->precio }}

            </div>

        </div>

    </div>

@endsection