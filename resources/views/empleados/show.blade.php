@extends('layouts.app')


@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2> Mostrar empleado</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('empleados.index') }}"> Atras</a>

            </div>

        </div>

    </div>


    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Cedula de Identidad:</strong>

                {{ $empleado->ci }}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Nombre:</strong>

                {{ $empleado->nombre }}

            </div>

        </div>

    </div>

@endsection