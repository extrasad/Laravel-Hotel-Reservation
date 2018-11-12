@extends('layouts.app')


@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Editar Habitacion</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('habitaciones.index') }}"> Atras</a>

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


    <form action="{{ route('habitaciones.update', $habitacion->id) }}" method="POST">

    	@csrf

        @method('PUT')


         <div class="row">

		    <div class="col-xs-12 col-sm-12 col-md-12">

		        <div class="form-group">

		            <strong>Habitacion:</strong>

		            <input type="text" name="habitacion" value="{{ $habitacion->habitacion }}" class="form-control" placeholder="Habitacion">

		        </div>

		    </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

		        <div class="form-group">

		            <strong>Tipo de Habitación:</strong>

		            <input type="text" name="tipo" value="{{ $habitacion->tipo }}" class="form-control" placeholder="Tipo de Habitacion">

		        </div>

		    </div>

		    <div class="col-xs-12 col-sm-12 col-md-12">

		        <div class="form-group">

		            <strong>Observación:</strong>

		            <textarea class="form-control" style="height:150px" name="observacion" placeholder="Observación">{{ $habitacion->observacion }}</textarea>

		        </div>

		    </div>

		    <div class="col-xs-12 col-sm-12 col-md-12">

		        <div class="form-group">

		            <strong>Caracteristicas:</strong>

		            <textarea class="form-control" style="height:150px" name="caracteristicas" placeholder="Caracteristicas">{{ $habitacion->caracteristicas }}</textarea>

		        </div>

		    </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Estado:</strong>

                    {!! Form::select('estado', ['Ocupada' => 'Ocupada', 'Disponible' => 'Disponible', 'En limpieza' => 'En limpieza'], array('default' => $habitacion->estado)); !!}

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Tipo de habitacion:</strong>

                    {!! Form::select('tipo',$habitacion->tipo, $tipo); !!}

                </div>

            </div>
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

		            <button type="submit" class="btn btn-primary">Enviar</button>

		    </div>

    </form>


@endsection