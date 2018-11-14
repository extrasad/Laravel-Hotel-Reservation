@extends('layouts.app')


@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Agregar nuevo turno</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('turnos.index') }}"> Atras</a>

            </div>

        </div>

    </div>


    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>Whoops!</strong> Hay algunos problemas con los datos ingresados.<br><br>

            <ul>

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form action="{{ route('turnos.store') }}" method="POST">

    	@csrf


         <div class="row">

		    <div class="col-xs-12 col-sm-12 col-md-12">

		        <div class="form-group">

		            <strong>Fecha:</strong>

                     <input type="date" name="fecha" class="form-control">

		        </div>

		    </div>

		    <div class="col-xs-12 col-sm-12 col-md-12">

		        <div class="form-group">

		            <strong>Hora entrada:</strong>

		           <input type="time" name="hora_entrada" class="form-control">

		        </div>

		    </div>

		    <div class="col-xs-12 col-sm-12 col-md-12">

		        <div class="form-group">

		            <strong>Hora salida:</strong>

		           <input type="time" name="hora_salida" class="form-control">

		        </div>

		    </div>

		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">


		            <button type="submit" class="btn btn-primary">Enviar</button>

		    </div>

    </form>

@endsection