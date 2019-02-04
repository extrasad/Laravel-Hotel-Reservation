@extends('layouts.app')

@section('content')
<div class="body table-responsive">

                @if ($message = Session::get('error'))

                    <div class="alert alert-warning">
            
                        <p>{{ $message }}</p>
            
                    </div>
                @elseif($message = Session::get('success'))

                    <div class="alert alert-success">
            
                        <p>{{ $message }}</p>
            
                    </div>
                @endif
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
                        <a href="{{ route('habitacion.edit', $habitacion->id)}}"class="btn btn-danger waves-effect">
                            {{ $habitacion->habitacion }}
                        </a>

                        @elseif( $habitacion->estado === 'Ocupada')
                            <a href="{{ route('reservacion.edit', $habitacion->id)}}" class="btn btn-primary waves-effect">
                                {{ $habitacion->habitacion }}
                            </a>
                        @else
                        <a href="{{ route('habitacion.edit', $habitacion->id)}}" class="btn btn-warning waves-effect">
                            {{ $habitacion->habitacion }}
                        </a>
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
                    REPORTE RÁPIDO
                </h2>
                
            </div>
            <div class="body">
                <form action="{{ route('reporte_dashboard.pdf')}}" method="POST">
                    @csrf
                    
                    <div class="row clearfix">
                        <div class="col-md-6">
                            <label>Desde:</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="date" class="form-control" name="fecha_inicio" value="{{ date('Y-m-d') }}" placeholder="Fecha inicio">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Hasta:</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="date" class="form-control" name="fecha_fin" value="{{ date('Y-m-d') }}" placeholder="Fecha fin">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-6">
                            <label>Desde:</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="time" class="form-control" name="hora_inicio" value="{{ date("H:i") }}" placeholder="Hora Inicio">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Hasta:</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="time" class="form-control" name="hora_fin" value="{{ date("H:i") }}" placeholder="Hora fin">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect">ENVIAR</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-blue hover-expand-effect">
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
        <div class="info-box bg-light-blue hover-expand-effect">
            <div class="icon">
                <i class="material-icons">people</i>
            </div>
            <div class="content">
                <div class="text">HAB. OCUPADAS</div>
                <div class="number">{{ $habOcupadas }}</div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-cyan hover-expand-effect">
            <div class="icon">
                <i class="material-icons">hotel</i>
            </div>
            <div class="content">
                <div class="text">HABITACIONES</div>
                <div class="number">{{ $habActivas }}</div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-teal hover-expand-effect">
            <div class="icon">
                <i class="material-icons">people_outline</i>
            </div>
            <div class="content">
                <div class="text">CLIENTES</div>
                <div class="number">{{ $clientesMeta }}</div>
            </div>
        </div>
    </div>
</div>

@endsection
