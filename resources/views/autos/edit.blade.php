@extends('layouts.app')


@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Editar Auto</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('autos.index') }}"> Atras</a>

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


    <form action="{{ route('autos.update',$auto->id) }}" method="POST">

    	@csrf

        @method('PUT')


         <div class="row">

		    <div class="col-xs-12 col-sm-12 col-md-12">

		        <div class="form-group">

		            <strong>Placa:</strong>

		            <input type="text" name="placa" value="{{ $auto->placa }}" class="form-control" placeholder="Placa">

		        </div>

		    </div>

		    <div class="col-xs-12 col-sm-12 col-md-12">

		        <div class="form-group">

		            <strong>Modelo:</strong>

		            <input type="text" name="modelo" value="{{ $auto->modelo }}" class="form-control" placeholder="Modelo">

		        </div>

		    </div>

		    <div class="col-xs-12 col-sm-12 col-md-12">

		        <div class="form-group">

		            <strong>Color:</strong>

		            <input type="text" name="color" value="{{ $auto->color }}" class="form-control" placeholder="Color">

		        </div>

		    </div>

		    <div class="col-xs-12 col-sm-12 col-md-12">

		        <div class="form-group">

		            <strong>Observación:</strong>

		            <textarea class="form-control" style="height:150px" name="observacion" placeholder="Observación">{{ $auto->observacion }}</textarea>

		        </div>

		    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Estado:</strong>

            {!! Form::select('estado', ['Advertencia' => 'Advertencia', 'Solicitado' => 'Solicitado', 'Sin Problemas' => 'Sin Problemas']); !!}

        </div>

    </div>

		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

		            <button type="submit" class="btn btn-primary">Enviar</button>

		    </div>

    </form>


@endsection