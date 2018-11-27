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
                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <label for="searchCliente">CI Cliente</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" id="searchCliente" class="form-control" name="cliente1"></input>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="clientes-block">
                                <div id="clienteLista1" class="list-group text-center">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <label for="searchCliente2">CI Acompañante</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" id="searchCliente2" class="form-control" name="cliente2"></input>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="clientes-block">
                                <div id="clienteLista2" class="list-group">

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <label for="searchAuto">Placa</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="searchAuto" class="form-control" name="auto"></input>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="clientes-block">
                                <div id="clienteAuto" class="list-group">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <label>Habitación</label>
                    <div class="form-group">
                        <div class="form-line">
                            {!! Form::select('habitacion', $habitaciones, $habitacion_find->habitacion); !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary waves-effect">Enviar</button>
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="modal fade" id="clienteModal" tabindex="-1" role="dialog" style="display: none;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Cliente1 title</h4>
                        </div>
                        <div class="modal-body">
                        <form action="{{ route('clientes.store') }}" method="POST">
                            @csrf

                            <label for="ci">Cédula de identidad</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="ci" name="ci" class="form-control" placeholder="Cedula de Identidad">
                                </div>
                            </div>
                            <label for="nombre">Nombre</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre">
                                </div>
                            </div>
                            <label for="nacionalidad">Nacionalidad</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="nacionalidad" name="nacionalidad" class="form-control" placeholder="Nacionalidad">
                                </div>
                            </div>
                            <br>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-link waves-effect">SAVE CHANGES</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                        </form>
                    </div>
                </div>
                <button type="button" class="btn btn-default waves-effect m-r-20" data-toggle="modal" data-target="#clienteModal">MODAL - DEFAULT SIZE</button>
            </div>
            <div class="modal fade" id="clienteModal2" tabindex="-1" role="dialog" style="display: none;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Cliente2 title</h4>
                        </div>
                        <div class="modal-body">
                        <form action="{{ route('clientes.store') }}" method="POST">
                            @csrf

                            <label for="ci">Cédula de identidad</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="ci" name="ci" class="form-control" placeholder="Cedula de Identidad">
                                </div>
                            </div>
                            <label for="nombre">Nombre</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre">
                                </div>
                            </div>
                            <label for="nacionalidad">Nacionalidad</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="nacionalidad" name="nacionalidad" class="form-control" placeholder="Nacionalidad">
                                </div>
                            </div>
                            <br>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-link waves-effect">SAVE CHANGES</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                        </form>
                    </div>
                </div>
                <button type="button" class="btn btn-default waves-effect m-r-20" data-toggle="modal" data-target="#clienteModal2">MODAL - DEFAULT SIZE</button>
            </div>
            <div class="modal fade" id="autoModal" tabindex="-1" role="dialog" style="display: none;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Auto title</h4>
                        </div>
                        <div class="modal-body">
                        <form action="{{ route('autos.store') }}" method="POST">
                            @csrf

                            <label for="placa">Placa</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="placa" name="placa" class="form-control" placeholder="Placa">
                                </div>
                            </div>
                            <label for="modelo">Modelo</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="modelo" name="modelo" class="form-control" placeholder="Modelo">
                                </div>
                            </div>
                            <label for="color">Color</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="color" name="color" class="form-control" placeholder="Color">
                                </div>
                            </div>
                            <br>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-link waves-effect">SAVE CHANGES</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                        </form>
                    </div>
                </div>
                <button type="button" class="btn btn-default waves-effect m-r-20" data-toggle="modal" data-target="#autoModal">MODAL - DEFAULT SIZE</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    jQuery(document).ready(function($) {

        const searchField = $('#searchCliente');
        const lista1 = $('#clienteLista1');
        let previousValue;
        let typingTimer;

        // events 
        searchField.on("keyup", typingLogic);

        lista1.on('click', '.clientes1', function(){
            const thisEl = $(this);
            const val = thisEl.val();

            searchField.val('');
            searchField.val(val);
        });

        function typingLogic() {

            if (searchField.val() != previousValue) {
                clearTimeout(typingTimer);

                if (searchField.val()) {
                    typingTimer = setTimeout(getClientsResults2(searchField.val()), 750);
                } else {
                    lista1.html('');
                }
            }

            previousValue = searchField.val();
        }

        function getClientsResults2(value) {
            const searchVal = value;
            lista1.html('');

            $.ajax({
                type: 'get',
                url: '{{ URL::to('search-cliente-reservacion') }}',
                data: { 'search': searchVal },
                success:function(data){
                    console.log(data);

                    if (data.length < 1) {
                        lista1.append(`<button type="button" class="btn btn-default waves-effect m-l-20" data-toggle="modal" data-target="#clienteModal">CREAR CLIENTE</button>`);
                    } else {
                        data.map(function(cliente, index) {
                            lista1.append(`<button type="button" class="list-group-item clientes1" value="${cliente.ci}">${cliente.nombre}</button>`);
                        });
                    }

                }
            });
        }

    });
    
</script>
<script type="text/javascript">

    jQuery(document).ready(function($) {

        const searchField2 = $('#searchCliente2');
        const lista2 = $('#clienteLista2');
        let previousValue2;
        let typingTimer2;

        // events 
        searchField2.on("keyup", typingLogic2);

        lista2.on('click', '.clientes2', function(){
            const thisEl = $(this);
            const val = thisEl.val();

            searchField2.val('');
            searchField2.val(val);
        });

        function typingLogic2() {

            if (searchField2.val() != previousValue2) {
                clearTimeout(typingTimer2);

                if (searchField2.val()) {
                    typingTimer2 = setTimeout(getClientsResults(searchField2.val()), 750);
                } else {
                    lista2.html('');
                }
            }

            previousValue2 = searchField2.val();
        }

        function getClientsResults(value) {
            const searchVal = value;
            lista2.html('');

            $.ajax({
                type: 'get',
                url: '{{ URL::to('search-cliente-reservacion') }}',
                data: { 'search': searchVal },
                success:function(data){
                    console.log(data);

                    if (data.length < 1) {
                        lista2.append(`<button type="button" class="btn btn-default waves-effect m-l-20" data-toggle="modal" data-target="#clienteModal2">CREAR CLIENTE</button>`);
                    } else {
                        data.map(function(cliente, index) {
                            lista2.append(`<button type="button" class="list-group-item clientes2" value="${cliente.ci}">${cliente.nombre}</button>`);
                        });
                    }



                }
            });
        }

    });
    
</script>
<script type="text/javascript">

    jQuery(document).ready(function($) {

        const searchField3 = $('#searchAuto');
        const lista3 = $('#clienteAuto');
        let previousValue3;
        let typingTimer3;

        // events 
        searchField3.on("keyup", typingLogic3);

        lista3.on('click', '.autos', function(){
            const thisEl = $(this);
            const val = thisEl.val();

            searchField3.val('');
            searchField3.val(val);
        });

        function typingLogic3() {

            if (searchField3.val() != previousValue3) {
                clearTimeout(typingTimer3);

                if (searchField3.val()) {
                    typingTimer3 = setTimeout(getClientsResults(searchField3.val()), 750);
                } else {
                    lista3.html('');
                }
            }

            previousValue3 = searchField3.val();
        }

        function getClientsResults(value) {
            const searchVal = value;
            lista3.html('');

            $.ajax({
                type: 'get',
                url: '{{ URL::to('search-auto-reservacion') }}',
                data: { 'search': searchVal },
                success:function(data){
                    console.log(data);

                    if (data.length < 1) {
                        lista3.append(`<button type="button" class="btn btn-default waves-effect m-l-20" data-toggle="modal" data-target="#autoModal">CREAR AUTO</button>`);
                    } else {
                        data.map(function(auto, index) {
                            lista3.append(`<button type="button" class="list-group-item autos" value="${auto.placa}">${auto.placa}</button>`);
                        });
                    }

                }
            });
        }

    });
    
</script>
@endsection