@extends('layouts.app')


@section('content')

<div class="block-header">
    <h2>EDITAR AUTO</h2>
</div>

<div class="row">

    <div class="col-lg-12 m-b-20">

        <div class="pull-right">
            
            <a class="btn btn-primary" href="{{ route('autos.index') }}"> Atras</a>
        
        </div>

    </div>

</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Creación de auto
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

                <form action="{{ route('autos.update',$auto->id) }}" method="POST">
                    @csrf

                    @method('PUT')

                    <label for="placa">Placa</label>
                    <div class="form-group">
                        <div class="form-line">
                                <input type="text" id="placa" name="placa" value="{{ $auto->placa }}" class="form-control" placeholder="Placa">
                            </div>
                    </div>
                    <label for="modelo">Modelo</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="modelo" name="modelo" value="{{ $auto->modelo }}" class="form-control" placeholder="Modelo">
                        </div>
                    </div>
                    <label for="color">Color</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="color" name="color" value="{{ $auto->color }}" class="form-control" placeholder="Color">
                        </div>
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