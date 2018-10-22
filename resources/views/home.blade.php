@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                @if(Auth::user()->hasRole('Admin Root'))
                <div>Acceso como Administrador Root</div>
                @elseif(Auth::user()->hasRole('Admin Recepcionista'))
                <div>Acceso como Administrador Recepcionista</div>
                @elseif(Auth::user()->hasRole('Admin Hotel'))
                <div>Acceso como Administrador Hotel</div>
                @endif
                You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
