@extends('layouts.app')


@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2> Mostrar consumo</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('consumos.index') }}"> Atras</a>

            </div>

        </div>

    </div>


    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Costo:</strong>

                {{ $consumo->costo }}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Estado:</strong>

                {{ $consumo->estado }}

            </div>

        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Productos:</strong>

                @foreach($consumo->producto as $producto)
                    {{ $producto->descripcion }}
                @endforeach

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Reservacion ID:</strong>

                    {{ $consumo->reservacion->id}}

            </div>

        </div>

        </div>

    </div>

@endsection