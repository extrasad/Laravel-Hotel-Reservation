@extends('layouts.app')


@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2> Mostrar producto</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('productos.index') }}"> Atras</a>

            </div>

        </div>

    </div>


    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Costo:</strong>

                {{ $producto->costo }}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Descripcion:</strong>

                {{ $producto->descripcion}}

            </div>

        </div>

    </div>

@endsection