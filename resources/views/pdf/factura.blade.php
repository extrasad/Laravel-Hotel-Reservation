@extends('layouts.pdf')


@section('content')
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>Codigo de Reservacion</th>
                <th>CI Cliente</th>
                <th>CI Acompañante</th>
                <th>Nombre Cliente</th>
                <th>Nombre Acompañante</th>
                <th>Concepto</th>
                <th>Cantidad</th>
                <th>Consumo</th>
                <th>Subtotal</th>
                <th>Total</th>
            </tr>                            
        </thead>
        <tbody>
            <tr>
                @foreach($reservacion as $detalle)
                <td>{{ $detalle->id }}</td>
                <td>{{ $detalle->cliente1->ci }}</td>
                <td>{{ $detalle->cliente2->ci }}</td>
                <td>{{ $detalle->cliente1->nombre }}</td>
                <td>{{ $detalle->cliente2->nombre }}</td>
                <td>
                    {{ $detalle->habitacion->tipo }}
                    {{ $detalle->habitacion->tipo }}
                </td>
                <td>{{ $detalle->habitacion->tipo }}</td>
                <td>
                @if(!empty($detalle->consumo->producto))
                @foreach($detalle->consumo->producto as $producto)
                    <label class="badge badge-success">{{ $producto->descripcion }}</label> 
                @endforeach
                @endif
                </td>
                <td>{{ $detalle->costo }}</td>
                <td>{{ $detalle->costo }}</td>
                @endforeach
            </tr>
        </tbody>
    </table>
@endsection
