@extends('layouts.app')


@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Editar Promocion</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('promos.index') }}"> Atras</a>

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


    <form action="{{ route('promos.update', $promo->id) }}" method="POST">

    	@csrf

        @method('PUT')


         <div class="row">

		    <div class="col-xs-12 col-sm-12 col-md-12">

		        <div class="form-group">

		            <strong>Costo:</strong>

		           <input type="number" step="any" value="{{ $promo->costo }}" name="costo" class="form-control" placeholder="Costo">

		        </div>

		    </div>

		    <div class="col-xs-12 col-sm-12 col-md-12">

		        <div class="form-group">

		            <strong>Descripcion:</strong>

		            <textarea class="form-control" style="height:150px" name="descripcion" placeholder="Descripcion">{{ $promo->descripcion }}</textarea>

		        </div>

		    </div>

		    <div class="col-xs-12 col-sm-12 col-md-12">

		        <div class="form-group">

		            <strong>Tipo:</strong>

		            {!! Form::select('tipo', $tipo, $promo->tipo); !!}

		        </div>

		    </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Horas:</strong>

                    <input type="number" name="horas" class="form-control" value="{{ $promo->horas }}" placeholder="Horas">

                </div>

            </div>
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

		            <button type="submit" class="btn btn-primary">Enviar</button>

		    </div>

    </form>


@endsection