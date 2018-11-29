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

                {!! Form::open(array('route' => 'reservacion.store','method'=>'POST', 'id' => 'create-reservacion')) !!}
                    <div class="cliente-1">
                        <div id="cliente-1-form" class="row clearfix">
                            <div class="col-sm-3">
                                <label for="searchCliente">CI Cliente:</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" id="searchCliente" name="cliente1" class="form-control search-cliente"></input>
                                    </div>
                                </div>
                                <span class="input-feedback1"></span>
                            </div>
                        </div>
                    </div>

                    <div class="cliente-2">
                        <div id="cliente-2-form" class="row clearfix">
                            <div class="col-sm-3">
                                <label for="searchCliente2">CI Cliente</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" id="searchCliente2" name="cliente2" class="form-control search-cliente"></input>
                                    </div>
                                </div>
                                <span class="input-feedback2"></span>
                            </div>
                            
                        </div>
                    </div>

                    <div class="auto-vehiculo">
                        <div id="auto-form" class="row clearfix">
                            <div class="col-sm-3">
                                <label for="searchAuto">Placa:</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="searchAuto" name="auto" class="form-control placa-auto"></input>
                                    </div>
                                </div>
                                <span class="input-feedback3"></span>
                            </div>

                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-md-6">
                            <label>Habitación</label>
                            <div class="form-group">
                                <div class="form-line">
                                    {!! Form::select('habitacion', $habitaciones, $habitacion_find->habitacion, array('class' => 'form-control')); !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <button id="submit-form" type="button" data-selector="#create-reservacion" class="btn btn-primary waves-effect">Enviar</button>
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    jQuery(document).ready(function($) {

        const form = $('#create-reservacion');
        const submitBtn = $('#submit-form');

        // events 
        submitBtn.on("click", submitForm);

        function submitForm() {
            form.submit();
        }

    });
    
</script>
<script type="text/javascript">

    jQuery(document).ready(function($) {

        const searchField = $('#searchCliente');
        const inputFeedBack = $('.input-feedback1');
        const cliente1Form = $('#cliente-1-form');
        let previousValue;
        let typingTimer;

        // events 
        searchField.on("keypress", typingLogic);
        cliente1Form.on('click', '#registrar-cliente-1', registerClient1);

        function typingLogic(e) {

            if(e.which == 13){
                inputFeedBack.text('');
                if (searchField.val() != previousValue) {
                    clearTimeout(typingTimer);

                    if (searchField.val()) {
                        typingTimer = setTimeout(getClientsResults2(searchField.val()), 750);
                    } else {
                        inputFeedBack.text('Este campo es requerido');
                    }
                }
            }

            previousValue = searchField.val();
        }

        function getClientsResults2(value) {
            const searchVal = value;

            if ($('.cliente-1-inputs').length > 0) {
                $('.cliente-1-inputs').remove();
            }

            $.ajax({
                type: 'get',
                url: '{{ URL::to('search-cliente-reservacion') }}',
                data: { 'search': searchVal },
                success:function(data){
                    if (data.length > 0) {
                        console.log(data);
                        inputFeedBack.text(data[0].nombre + ' está registrado');
                    } else {
                        inputFeedBack.text('La cédula no concuerda, registre el cliente')
                        cliente1Form.append(`
                            <div class="col-sm-3 cliente-1-inputs">
                                <label for="nombre-cliente">Nombre:</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="nombre-cliente" class="form-control nombre-cliente"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 cliente-1-inputs">
                                <label for="nacionalidad-cliente">Nacionalidad:</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="nacionalidad-cliente" class="form-control nacionalidad-cliente"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 cliente-1-inputs">
                                <button id="registrar-cliente-1" type="button" class="btn btn-link waves-effect">REGISTRAR CLIENTE</button>
                            </div>
                        `);
                    }

                }
            });
        }

        function registerClient1() {
            const cedulaCliente = searchField.val();
            const nombreCliente = $('#nombre-cliente').val();
            const nacionalidadCliente = $('#nacionalidad-cliente').val();

            $.ajax({
                type: 'POST',
                url: '{{ URL::to('create-cliente') }}',
                data: { 
                    'ci': cedulaCliente,
                    'nombre': nombreCliente,
                    'nacionalidad': nacionalidadCliente
                },
                dataType: 'json',
                success:function(data){
                    console.log(data);
                }
            });
        }
    });
    
</script>
<script type="text/javascript">

    jQuery(document).ready(function($) {

        const searchField2 = $('#searchCliente2');
        const inputFeedBack2 = $('.input-feedback2');
        const cliente2Form = $('#cliente-2-form');
        let previousValue2;
        let typingTimer2;

        // events 
        searchField2.on("keypress", typingLogic2);
        cliente2Form.on('click', '#registrar-cliente-2', registerClient2);

        function typingLogic2(e) {
            
            if(e.which == 13) {
                inputFeedBack2.text('');
                if (searchField2.val() != previousValue2) {
                    clearTimeout(typingTimer2);

                    if (searchField2.val()) {
                        typingTimer2 = setTimeout(getClientsResults(searchField2.val()), 750);
                    } else {
                        inputFeedBack2.text('Este campo es requerido');
                    }
                }
            }

            previousValue2 = searchField2.val();
        }

        function registerClient2() {
            const cedulaCliente = searchField2.val();
            const nombreCliente = $('#nombre-cliente2').val();
            const nacionalidadCliente = $('#nacionalidad-cliente2').val();

            $.ajax({
                type: 'POST',
                url: '{{ URL::to('create-cliente') }}',
                data: { 
                    'ci': cedulaCliente,
                    'nombre': nombreCliente,
                    'nacionalidad': nacionalidadCliente
                },
                dataType: 'json',
                success:function(data){
                    console.log(data);
                }
            });
        }

        function getClientsResults(value) {
            const searchVal = value;

            if ($('.cliente-2-inputs').length > 0) {
                $('.cliente-2-inputs').remove();
            }

            $.ajax({
                type: 'get',
                url: '{{ URL::to('search-cliente-reservacion') }}',
                data: { 'search': searchVal },
                success:function(data){
                    if (data.length > 0) {
                        console.log(data);
                        inputFeedBack2.text(data[0].nombre + ' está registrado');

                    } else {
                        inputFeedBack2.text('La cédula no concuerda, registre el cliente')

                        cliente2Form.append(`
                            <div class="col-sm-3 cliente-2-inputs">
                                <label for="nombre-cliente2">Nombre</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="nombre-cliente2" class="form-control nombre-cliente"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 cliente-2-inputs">
                                <label for="nacionalidad-cliente">Nacionalidad</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="nacionalidad-cliente2" class="form-control nacionalidad-cliente"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 cliente-2-inputs">
                                <button id="registrar-cliente-2" type="button" class="btn btn-link waves-effect">REGISTRAR CLIENTE</button>
                            </div>
                        `);
                    }
                }
            });
        }

    });
    
</script>
<script type="text/javascript">

    jQuery(document).ready(function($) {

        const searchField3 = $('#searchAuto');
        const inputFeedBack3 = $('.input-feedback3');
        const autoForm = $('#auto-form');
        let previousValue3;
        let typingTimer3;

        // events 
        searchField3.on("keypress", typingLogic3);
        autoForm.on('click', '#registrar-auto', registerAuto);

        function typingLogic3(e) {
            if(e.which == 13){//Enter key pressed
                inputFeedBack3.text('');

                if (searchField3.val() != previousValue3) {
                    clearTimeout(typingTimer3);

                    if (searchField3.val()) {
                        typingTimer3 = setTimeout(getClientsResults(searchField3.val()), 750);
                    } else {
                        inputFeedBack3.text('Este campo es requerido');
                    }
                }

                previousValue3 = searchField3.val();
            }
        }

        function registerAuto() {
            const placaAuto = searchField3.val();
            const modeloAuto = $('#modelo-auto').val();
            const colorAuto = $('#color-auto').val();

            $.ajax({
                type: 'POST',
                url: '{{ URL::to('create-auto') }}',
                data: { 
                    'placa': placaAuto,
                    'modelo': modeloAuto,
                    'color': colorAuto
                },
                dataType: 'json',
                success:function(data){
                    console.log(data);
                }
            });
        }

        function getClientsResults(value) {
            const searchVal = value;

            if ($('.auto-inputs').length > 1) {
                $('.auto-inputs').remove();
            }

            $.ajax({
                type: 'get',
                url: '{{ URL::to('search-auto-reservacion') }}',
                data: { 'search': searchVal },
                success:function(data){
                    if (data.length > 0) {
                        console.log(data);
                        inputFeedBack3.text(data[0].placa + ' está registrada');

                    } else {
                        inputFeedBack3.text('La placa no concuerda, registre el auto')

                        autoForm.append(`
                            <div class="col-sm-3 auto-inputs">
                                <label for="modelo-auto">Modelo:</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="modelo-auto" class="form-control modelo-auto"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 auto-inputs">
                                <label for="color-auto">Color</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="color-auto" class="form-control color-auto"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 auto-inputs">
                                <button id="registrar-auto" type="button" class="btn btn-link waves-effect">REGISTRAR AUTO</button>
                            </div>
                        `);
                    }
                }
            });
        }

    });
    
</script>
@endsection