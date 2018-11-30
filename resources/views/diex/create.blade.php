@extends('layouts.app')


@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Agregar nuevo registro en la lista negra</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('diex.index') }}"> Atras</a>

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


    <form action="{{ route('diex.store') }}" method="POST">

    	@csrf


         <div class="row">

		    <div class="col-xs-12 col-sm-12 col-md-12">

		        <div class="form-group">

		            <strong>Nombre:</strong>

		            <input type="text" name="nombre" class="form-control" placeholder="Nombre">

		        </div>

		    </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

		        <div class="form-group">

		            <strong>Cedula de Identidad:</strong>

		            <input type="text" name="ci" class="form-control" placeholder="Cedula de Identidad">

		        </div>

		    </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

		        <div class="form-group">

		            <strong>Placa:</strong>

		            <input type="text" name="placa" class="form-control" placeholder="Placa">

		        </div>

		    </div>

		    <div class="col-xs-12 col-sm-12 col-md-12">

		        <div class="form-group">

		            <strong>Observación:</strong>

		            <textarea class="form-control" style="height:150px" name="observacion" placeholder="Observación"></textarea>

		        </div>

		    </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
        
                <div class="form-group">
        
                    <strong>Estado</strong>
        
                    {!! Form::select('estado', ['Solicitado' => 'Solicitado', 'Advertencia' => 'Advertencia']); !!}
        
                </div>
        
            </div>

		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

		            <button type="submit" class="btn btn-primary">Enviar</button>

		    </div>

    </form>

@endsection