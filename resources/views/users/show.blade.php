@extends('layouts.app')


@section('content')

<div class="block-header">
    <h2>INFORMACION DE USUARIO</h2>
</div>

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('users.index') }}"> Atras</a>

        </div>

    </div>

</div>
<div class="row clearfix">
    <!-- Basic Examples -->
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    {{ $user->name }}
                    <small>Información detallada del usuario {{ $user->name }}</small>
                </h2>
            </div>
            <div class="body">
                <ul class="list-group">
                    <li class="list-group-item"><strong class="font-bold col-orange">Nombre:</strong> {{ $user->name }} </li>

                    <li class="list-group-item"><strong class="font-bold col-orange">Nombre de usuario:</strong> {{ $user->username }} </li>
                    <li class="list-group-item">
                        <strong class="font-bold col-orange">Roles:</strong>             
                        @if(!empty($user->getRoleNames()))

                            @foreach($user->getRoleNames() as $v)
            
                                <label class="badge badge-success">{{ $v }}</label>
            
                            @endforeach
            
                        @endif 
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection