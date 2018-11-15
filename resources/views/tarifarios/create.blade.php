@extends('layouts.app')


@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Agregar nuevo tarifario</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('tarifarios.index') }}"> Atras</a>

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


    <form action="{{ route('tarifarios.store') }}" method="POST">

    	@csrf


         <div class="row">

		    <div class="col-xs-12 col-sm-12 col-md-12">

		        <div class="form-group">

		            <strong>Tipo de habitación:</strong>

		            <input type="text" name="tipo" class="form-control" placeholder="Tipo de habitacion">

		        </div>

		    </div>

		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

		            <button type="submit" class="btn btn-primary">Enviar</button>

		    </div>

    </form>

@endsection