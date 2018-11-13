@extends('layouts.app')


@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Editar Consumo</h2>

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


    <form action="{{ route('consumos.update',$consumo->id) }}" method="POST">

    	@csrf

        @method('PUT')


         <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">
        
                <div class="form-group">
        
                    <strong>Estado:</strong>
        
                    {!! Form::select('estado',['Pendiente por pagar' => 'Pendiente por pagar', 'Cancelado' => 'Cancelado'], array('default' => $consumo->estado)); !!}
        
                </div>
        
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Productos:</strong>

                    {!! Form::select('productos[]', $productos,$consumoProducto, array('class' => 'form-control','multiple')) !!}

                </div>

            </div>


		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

		            <button type="submit" class="btn btn-primary">Enviar</button>

		    </div>

    </form>


@endsection