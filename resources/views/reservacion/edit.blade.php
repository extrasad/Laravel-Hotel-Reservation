@extends('layouts.app')


@section('content')


    @if(auth()->user()->isRecepcionista())

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            HABITACION ##
                        </h2>
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <strong class="font-bold col-orange">Ci cliente:</strong> 15351254
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <strong class="font-bold col-orange">Nombre cliente:</strong> John Doe
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <strong class="font-bold col-orange">Ci cliente:</strong> 15351254
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <strong class="font-bold col-orange">Nombre cliente:</strong> John Doe
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <strong class="font-bold col-orange">Placa auto:</strong> asda15
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            AGREGAR CONSUMO
                            {{ dump($productos) }}
                        </h2>
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">

                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" value="" placeholder="Buscar producto..." name="search-producto"></input>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-5 col-sm-5 col-md-5">
                                <strong class="font-bold col-orange">Cocossette</strong>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <label>Canntidad:</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" class="form-control" placeholder="Ingrese la cantidad">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-3">
                                <button type="button" class="btn btn-primary btn-lg m-l-15 waves-effect">AGREGAR</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Tabla de consumo
                    <small>Esta sección permite observar los consumos actuales de la habitacion.</small>
                </h2>
            </div>


            <div class="body table-responsive">

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                
                            <th>Costo</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                
                            <td>Cocossette</td>
                
                            <th>231</th>
                
                            <th>2312Bs</th>
                
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                    
                            <td>Costo Total:</td>
                                
                            <th>2312Bs</th>
                
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
    @else
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
                    <label for="habitacion-reservacion">{{ $reservacion->habitacion->habitacion }}</label>
                    <input type="text" id="habitacion-reservacion" name="habitacion" value="{{ $reservacion->habitacion->habitacion }}" hidden>
                </div>

            </div>

		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

		            <button type="submit" class="btn btn-primary">Enviar</button>

		    </div>

    </form>
    @endif

@endsection