@extends('layouts.app')


@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Editar Reservacion</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('reservacion.index') }}"> Atras</a>

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

    <form action="{{ route('reservacion.update', $reservacion->id) }}" method="POST">

    	@csrf

        @method('PUT')


         <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">

		        <div class="form-group">

		            <strong>Fecha de salida:</strong>

                    {!! Form::date('fecha_salida', $reservacion->fecha_salida) !!}

		        </div>

		    </div>

		    <div class="col-xs-12 col-sm-12 col-md-12">

		        <div class="form-group">

		            <strong>Hora salida:</strong>

		           {!! Form::time('hora_salida', $reservacion->hora_salida) !!}

		        </div>
		    </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

		        <div class="form-group">

		            <strong>Observación:</strong>

		            <textarea class="form-control" style="height:150px" name="observacion" placeholder="Observación">{{ $reservacion->observacion }}</textarea>

		        </div>

		    </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Estado:</strong>

                    {!! Form::select('estado',['Activa' => 'Activa', 'Inactiva' => 'Inactiva'], array('default' => $reservacion->estado)); !!}

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>CI Cliente:</strong>

                    <input type="text" class="form-controller" value="{{ $reservacion->cliente1->ci }}" name="cliente1"></input>

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>CI Acompañante:</strong>

                    <input type="text" class="form-controller" value="{{ $reservacion->cliente2->ci }}" name="cliente2"></input>

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Placa:</strong>

                    <input type="text" class="form-controller" value="{{ $reservacion->auto->placa }}" name="auto"></input>

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Habitacion:</strong>

                    {!! Form::select('habitacion', $habitaciones, $reservacion->habitacion->habitacion); !!}

                </div>

            </div>

		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

		            <button type="submit" class="btn btn-primary">Enviar</button>

		    </div>

    </form>


@endsection