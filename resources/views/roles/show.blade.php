{{-- @extends('layouts.app')


@section('content')

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2> Show Role</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>

        </div>

    </div>

</div>


<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Name:</strong>

            {{ $role->name }}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Permissions:</strong>

            @if(!empty($rolePermissions))

                @foreach($rolePermissions as $v)

                    <label class="label label-success">{{ $v->name }},</label>

                @endforeach

            @endif

        </div>

    </div>

</div>

@endsection --}}

@extends('layouts.app')


@section('content')

<div class="block-header">
    <h2>INFORMACION DE ROL</h2>
</div>

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>

        </div>

    </div>

</div>
<div class="row clearfix">
    <!-- Basic Examples -->
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                        {{ $role->name }}
                    <small>Información detallada del rol {{ $role->name }}</small>
                </h2>
            </div>
            <div class="body">
                <ul class="list-group">
                    <li class="list-group-item"><strong class="font-bold col-orange">Nombre de rol:</strong> {{ $role->name }} </li>
                    <li class="list-group-item">
                        <strong class="font-bold col-orange">Permisos:</strong>             
                        @if(!empty($rolePermissions))

                            @foreach($rolePermissions as $v)

                                <label class="label label-success">{{ $v->name }},</label>

                            @endforeach

                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection