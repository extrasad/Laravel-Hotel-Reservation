{{-- @extends('layouts.app')


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

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Estado:</strong>

                    {!! Form::select('estado', ['Activa' => 'Activa', 'Inactiva' => 'Inactiva']); !!}

                 </div>

            </div>

		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

		            <button type="submit" class="btn btn-primary">Enviar</button>

		    </div>

    {!! Form::close() !!}

@endsection --}}

@extends('layouts.app')


@section('content')

<div class="block-header">
    <h2>AGREGAR RESERVACIÓN</h2>
</div>

<div class="row">

    <div class="col-lg-12 m-b-20">

        <div class="pull-right">
            
            <a class="btn btn-primary" href="{{ route('reservacion.index') }}"> Atras</a>
        
        </div>

    </div>

</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Creación de producto
                </h2>
            </div>
            <div class="body">
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
                    <label for="cliente1">CI Cliente</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="cliente1" class="form-control" name="cliente1"></input>
                        </div>
                    </div>
                    <label for="cliente2">CI Acompañante</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="cliente2" class="form-control" name="cliente2"></input>
                        </div>
                    </div>
                    <label for="auto">Placa</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="auto" class="form-control" name="auto"></input>
                        </div>
                    </div>
                    <label>Habitación</label>
                    <div class="form-group">
                        <div class="form-line">
                            {!! Form::select('habitacion', $habitaciones, array('class' => 'form-control')); !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary waves-effect">Enviar</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection