@extends('layouts.app')


@section('content')

<div class="block-header">
    <h2>EDITAR CONSUMO</h2>
</div>

<div class="row">

    <div class="col-lg-12 m-b-20">

        <div class="pull-right">
            
            <a class="btn btn-primary" href="{{ route('consumos.index') }}"> Atras</a>
        
        </div>

    </div>

</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Editar consumo
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

                <form action="{{ route('consumos.update',$consumo->id) }}" method="POST">
                    @csrf

                    @method('PUT')

                    <label for="estado">Estado</label>
                    <div class="form-group">
                        {!! Form::select('estado',['Pendiente por pagar' => 'Pendiente por pagar', 'Cancelado' => 'Cancelado'], array('default' => $consumo->estado, 'id' => 'estado')); !!}
                    </div>
                    <label for="productos">Productos</label>
                    <div class="form-group">
                        {!! Form::select('productos[]', $productos,$consumoProducto, array('class' => 'form-control','multiple', 'id' => 'productos')) !!}
                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary waves-effect">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection