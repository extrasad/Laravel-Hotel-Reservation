@extends('layouts.app')


@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Agregar nueva reservacion</h2>

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


    {!! Form::open(array('route' => 'reservacion.store','method'=>'POST')) !!}

    	@csrf


         <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">

		        <div class="form-group">

		            <strong>Observación:</strong>

		            <textarea class="form-control" style="height:150px" name="observacion" placeholder="Observación"></textarea>

		        </div>

		    </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>CI Cliente:</strong>

                    <input type="text" class="form-controller" name="cliente1"></input>

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>CI Acompañante:</strong>

                    <input type="text" class="form-controller" name="cliente2"></input>

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Placa:</strong>

                    <input type="text" class="form-controller" name="auto"></input>

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Habitacion:</strong>

                    {!! Form::select('habitacion', $habitaciones); !!}

                </div>

            </div>

		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

		            <button type="submit" class="btn btn-primary">Enviar</button>

		    </div>

    {!! Form::close() !!}

@endsection