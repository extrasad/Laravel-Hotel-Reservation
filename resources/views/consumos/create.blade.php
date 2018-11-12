@extends('layouts.app')


@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Agregar nuevo consumo</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('consumos.index') }}"> Atras</a>

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


    {!! Form::open(array('route' => 'consumos.store','method'=>'POST')) !!}

    	@csrf


         <div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Estado:</strong>

            {!! Form::select('estado', ['Pendiente por pagar' => 'Pendiente por pagar', 'Cancelado' => 'Cancelado']); !!}

        </div>

    </div>
        <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Productos:</strong>

            {!! Form::select('productos[]', $productos,[], array('class' => 'form-control','multiple')) !!}

        </div>

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        
                <div class="form-group">
        
                    <strong>Reservacion ID:</strong>
        
                    {!! Form::select('reservacion', $reservaciones); !!}
        
                </div>
        
        </div>

		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

		            <button type="submit" class="btn btn-primary">Enviar</button>

		    </div>

    {!! Form::close() !!}
    

@endsection