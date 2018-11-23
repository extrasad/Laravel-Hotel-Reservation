@extends('layouts.app')

@section('content')
<div class="block-header">
    <h2>DASHBOARD</h2>
</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Habitaciones
                    <small>Selecciona, la habitación a la que quieres acceder</small>
                </h2>
            </div>
            <div class="body">
                <div class="icon-button-demo">
                    @foreach( $habitaciones as $habitacion)
                        @if($habitacion->estado === 'Disponible')
                            <a href="{{ route('reservacion.custom_create', $habitacion->id) }}" class="btn btn-success waves-effect">
                                {{ $habitacion->habitacion }}
                            </a>
                        @elseif( $habitacion->estado === 'Dañada')
                        <button type="button" class="btn btn-danger waves-effect">
                            {{ $habitacion->habitacion }}
                        </button>

                        @elseif( $habitacion->estado === 'Ocupada')
                            <a href="{{ route('reservacion.edit', $habitacion->id)}}" class="btn btn-primary waves-effect">
                                {{ $habitacion->habitacion }}
                            </a>
                        @else
                        <button type="button" class="btn btn-warning waves-effect">
                            {{ $habitacion->habitacion }}
                        </button>
                        @endif
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <span class="label label-primary">Ocupada</span>
                        <span class="label label-danger">Dañada</span>
                        <span class="label label-success">Disponible</span>
                        <span class="label label-warning">Mantenimiento</span>
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
                    INLINE LAYOUT
                </h2>
                
            </div>
            <div class="body">
                <form>
                    <div class="row clearfix">
                    <!-- AGREGAR POR DEFECTO LOS VALORES DLE DIA DE HOY -->
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                            <label>Desde:</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="date" class="form-control" placeholder="Email Address">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                            <label>Hasta:</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="date" class="form-control" placeholder="Password">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <button type="button" class="btn btn-primary btn-lg m-l-15 waves-effect">ENVIAR</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-teal hover-expand-effect">
            <div class="icon">
                <i class="material-icons">equalizer</i>
            </div>
            <div class="content">
                <div class="text">HOSPEDADOS</div>
                <div class="number">{{ $clientes }}</div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-green hover-expand-effect">
            <div class="icon">
                <i class="material-icons">flight_takeoff</i>
            </div>
            <div class="content">
                <div class="text">HAB. OCUPADAS</div>
                <div class="number">{{ $habOcupadas }}</div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-light-green hover-expand-effect">
            <div class="icon">
                <i class="material-icons">battery_charging_full</i>
            </div>
            <div class="content">
                <div class="text">HABITACIONES</div>
                <div class="number">{{ $habActivas }}</div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-lime hover-expand-effect">
            <div class="icon">
                <i class="material-icons">brightness_low</i>
            </div>
            <div class="content">
                <div class="text">CLIENTES REGISTRADOS</div>
                <div class="number">{{ $clientesMeta }}</div>
            </div>
        </div>
    </div>
</div>

@endsection
