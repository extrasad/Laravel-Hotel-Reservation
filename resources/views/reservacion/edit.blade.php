@extends('layouts.app')


@section('content')


    @if(auth()->user()->isRecepcionista())

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            HABITACION {{ $reservacion->habitacion->habitacion }}
                        </h2>
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <strong class="font-bold col-orange">Ci cliente:</strong> {{ $reservacion->cliente1->ci }}
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <strong class="font-bold col-orange">Nombre cliente:</strong> {{ $reservacion->cliente1->nombre }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <strong class="font-bold col-orange">Ci cliente:</strong> {{ $reservacion->cliente2->ci }}
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <strong class="font-bold col-orange">Nombre cliente:</strong> {{ $reservacion->cliente2->nombre }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <strong class="font-bold col-orange">Placa auto:</strong> {{ $reservacion->auto->placa }}
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <strong class="font-bold col-orange">Nacionalidad cliente:</strong> {{ $reservacion->cliente1->nacionalidad }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form id="reservacionForm" action="{{ route('reservacion.cerrar', $reservacion->id) }}" method="POST">
            @csrf

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                AGREGAR CONSUMO
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" id="productoSelect">
                                            @foreach( $productos as $key => $producto)
                                                <option data-index="{{ $key }}" data-costo="{{ $producto->costo }}" value="{{ $producto->id }}">{{ $producto->descripcion }}</option>
                                            
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" id="addProducto" class="btn btn-primary btn-lg m-l-15 waves-effect">AGREGAR</button>
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
                                Tabla de consumo
                                <small>Esta sección permite observar los consumos actuales de la habitacion.</small>
                            </h2>
                        </div>
                        <div class="body table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unitario</th>
                                        <th>Subtotal</th>
                                        <th>Accion</th>
                                    </tr>
                                </thead>
                                <tbody class="table__body producto-table-body">
                                    @if($reservacion->consumo)
                                        {{ $consumo }}
                                        @foreach($productos_consumo as $productos)
                                            {{ $productos }}
                                        @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>Costo Total:</td>
                                        <th id="total-costo"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix m-b-20">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button type="button" class="btn btn-default waves-effect m-r-20" data-toggle="modal" data-target="#cerrarModal">CERRAR HABITACION</button>
                    @if(!$reservacion->consumo)
                        <button id="create-consumo" data-reservacion="{{ $reservacion->id }}" type="button" class="btn btn-default waves-effect m-r-20">REGISTRAR CONSUMO</button>
                    @else
                        <button id="edit-consumo" data-reservacion="{{ $reservacion->id }}" type="button" class="btn btn-default waves-effect m-r-20">REGISTRAR CONSUMO</button>
                        <button id="edit-consumo"  type="button" data-toggle="modal" data-target="#pagarModal" class="btn btn-default waves-effect m-r-20">PAGAR CONSUMO</button>
                    @endif
                    <button type="button" class="btn btn-default waves-effect m-r-20" data-toggle="modal" data-target="#cancelarModal">CANCELAR RESERVACION</button>
                    <div class="modal fade" id="cerrarModal" tabindex="-1" role="dialog" style="display: none;">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="defaultModalLabel">¿Desea cerrar esta habitación?</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row clearfix">
                                        <div class="col-sm-12">
                                            <label for="searchCliente">Observación:</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <textarea rows="4" class="form-control no-resize" name="observacion" placeholder="Escribe una observación..."></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="searchCliente">Estado:</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                {!! Form::select('estado', ['Solicitado' => 'Solicitado', 'Advertencia' => 'Advertencia']); !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button id="submit-form" type="button" data-selector="#reservacionForm" class="btn btn-link waves-effect">CONFIRMAR</button>
                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCELAR</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="modal fade" id="cancelarModal" tabindex="-1" role="dialog" style="display: none;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">¿Desea cancelar esta reservación?</h4>
                        </div>
                        <div class="modal-body">
                            <form id="cancelarReserva" action="{{ route('reservacion.cancelar_reservacion', $reservacion->id) }}" method="POST"></form>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <label for="searchCliente">Observación:</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea rows="4" class="form-control no-resize" name="observacion" placeholder="Escribe una observación..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button id="submit-cancelar" type="button" data-selector="#cancelarReserva" class="btn btn-link waves-effect">CONFIRMAR</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCELAR</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        <div class="modal fade" id="pagarModal" tabindex="-1" role="dialog" style="display: none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="defaultModalLabel">¿Desea pagar el consumo?</h4>
                    </div>
                    <div class="modal-footer">
                        @if($reservacion->consumo)
                        <button id="pagar-consumo" type="button" data-consumo="{{ $reservacion->id }}" data-selector="#reservacionForm" class="btn btn-link waves-effect">CONFIRMAR</button>
                        @endif
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCELAR</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        jQuery(document).ready( function($) {

            const addProductoBtn = $('#addProducto');
            const tableBody = $('.producto-table-body');
            const tableRow = $('.producto-table-row');
            const productoSelect = $('#productoSelect');
            const submitBtn = $('#submit-form');
            const consumoBtn = $('#create-consumo')
            const consumoEditBtn = $('#edit-consumo');
            const pagarBtn = $('#pagar-consumo');
            const cancelarBtn = $('#submit-cancelar');
            let previousSelected;

            // Events
            addProductoBtn.on('click', addRequisito);
            tableBody.on('click', '.btn-remove-requisito', removeRequisito);
            tableBody.on('keyup mouseup', '.input-cantidad', quantityLogic);
            addProductoBtn.on('click', totalQuantity);
            tableBody.on('keyup mouseup', '.input-cantidad', totalQuantity);
            submitBtn.on('click', submitForm);
            consumoBtn.on('click',sendConsumoForm);
            consumoEditBtn.on('click', editConsumoForm);
            cancelarBtn.on('click', cancelarReservacion);
            pagarBtn.on('click', pagarConsumo);

            function addRequisito() {
                if (tableBody.children().hasClass('form__table-no-element')) {
                    tableBody.children().remove();
                }

                const valProducto = productoSelect.val();
                const productoSelected = productoSelect.find(':selected');
                const costoProducto = productoSelected.data('costo');
                const nombreProducto = productoSelected.text();
                const indexProducto = productoSelected.data('index');

                if (productoSelected !== previousSelected) {
                    if ($("#producto-" + valProducto).length === 0) {
                        tableBody.append(`
                        <tr id="producto-${valProducto}" class="producto-table-row">

                            <td>
                                <label for="productos[${indexProducto}][${nombreProducto}]" >${nombreProducto}</label>
                                <input class="input-producto" type="text" id="productos[${indexProducto}][${nombreProducto}]" name="productos[${indexProducto}][nombre]" value="${nombreProducto}" hidden>
                            </td>

                            <td>
                                <input  type="number" class="form-control input-cantidad" data-costoprod="${costoProducto}" data-cantidad="1" id="productos[${indexProducto}][cantidad]" name="productos[${indexProducto}][cantidad]" value="1">
                            </td>

                            <td>${costoProducto}</td>
                            

                            <td class="product-quantity" data-price="${costoProducto}">${costoProducto}</td>

                            <td class="producto-remove">
                                <span class="btn-remove-requisito" data-delete="#producto-${valProducto}">
                                    x
                                </span>
                            </td>
                        </tr>
                    `);
                    }

                }
                previousSelected = productoSelect.find(':selected');
                
            }

            function pagarConsumo() {
                const thisEl = $(this);
                const table = $('.table-responsive');
                const consumoId = thisEl.data('consumo');
                thisEl.prop('disabled',true);
                

                $.ajax({ 
                    type : 'POST',
                    url : APP_URL + '/pagar-consumo/' + consumoId,
                    data: {},
                    success:function(data){
                        thisEl.prop('disabled',false);
                        window.location.reload();
                    },
                    error: function( jqXHR ,  textStatus,  errorThrown ) {
                        table.append(`
                            <div class="alert bg-pink alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                No hay productos para consumir
                            </div>
                        `);
                    }
                });
            }

            function editConsumoForm() {
                const thisEl = $(this);
                const table = $('.table-responsive');
                const inputsProduct = $('.producto-table-row');
                const reservacionId = $(this).data('reservacion');
                let productosArr = [];
                thisEl.prop('disabled',true);
                
                inputsProduct.each(function(index) {
                    const inputProduct = $(this).find('.input-producto');
                    const inputCantidad = $(this).find('.input-cantidad');
                    const a = {
                        'nombre': inputProduct.val(),
                        'cantidad': inputCantidad.val()
                    };
                    productosArr.push(a);
                });

                console.log(productosArr);

                $.ajax({ 
                    type : 'POST',
                    url : APP_URL + '/editar-consumo/' + reservacionId,
                    dataType: 'json',
                    data: {
                        productos: productosArr
                    },
                    success:function(data){
                        thisEl.prop('disabled',false);
                        window.location.reload();
                    },
                    error: function( jqXHR ,  textStatus,  errorThrown ) {
                        table.append(`
                            <div class="alert bg-pink alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                No hay productos para consumir
                            </div>
                        `);
                    }
                });
            }

            function sendConsumoForm() {
                const thisEl = $(this);
                const table = $('.table-responsive');
                const inputsProduct = $('.producto-table-row');
                const reservacionId = $(this).data('reservacion');
                let productosArr = [];
                thisEl.prop('disabled',true);
                
                inputsProduct.each(function(index) {
                    const inputProduct = $(this).find('.input-producto');
                    const inputCantidad = $(this).find('.input-cantidad');

                    const a = {
                        'nombre': inputProduct.val(),
                        'cantidad': inputCantidad.val()
                    };
                    productosArr.push(a);
                });

                console.log(productosArr);

                $.ajax({ 
                    type : 'POST',
                    url : APP_URL + '/agregar-consumo/' + reservacionId,
                    dataType: 'json',
                    data: {
                        productos: productosArr
                    },
                    success:function(data){
                        thisEl.prop('disabled',false);
                        window.location.reload();
                    },
                    error: function( jqXHR ,  textStatus,  errorThrown) {
                        table.append(`
                            <div class="alert bg-pink alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                No ha insertado ningún producto para consumir
                            </div>
                        `);
                    }
                });

            }

            function cancelarReservacion() {
                const thisEl = $(this);
                const selector = thisEl.data('selector');

                $(selector).submit();
            }

            function submitForm() {
                const thisEl = $(this);
                const selector = thisEl.data('selector');

                $(selector).submit();
            }

            function removeRequisito(e) {
                const thisEl = $(this);
                const parent = thisEl.parent().parent();
                parent.remove();

            }

            function quantityLogic() {
                const thisEl = $(this);
                const cantidadBase = thisEl.data('cantidad');
                const costo = thisEl.data('costoprod');
                const value = thisEl.val();
                const parent = thisEl.parent().parent();
                const valueShow = parent.find('.product-quantity');

                if (cantidadBase !== value) {
                    const costoMultiplied = costo * value;  
                    thisEl.data('cantidad', value);
                    valueShow.data('price', costoMultiplied);
                    valueShow.text('');
                    valueShow.text(costoMultiplied);
                }
            }

            function totalQuantity() {
                const costos = $('.product-quantity').toArray();
                const totalCosto = $('#total-costo');
                let costosArr = [];
                costos.forEach(function(el, index) {
                    const precio = $(el).data('price');
                    costosArr.push(precio)
                });
                const sum = costosArr.reduce(function(a, b) {
                    return a + b
                });

                totalCosto.text('');
                totalCosto.text(sum);
            }

        });
            
    </script>
    @else
    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Editar Reservacion</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('reservacion.index') }}"> Atras</a>

            </div>

        </div>

    </div>


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

    <form action="{{ route('reservacion.update', $reservacion->id) }}" method="POST">

    	@csrf

        @method('PUT')


         <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">

		        <div class="form-group">

		            <strong>Fecha de salida:</strong>

                    {!! Form::date('fecha_salida', $reservacion->fecha_salida) !!}

		        </div>

		    </div>

		    <div class="col-xs-12 col-sm-12 col-md-12">

		        <div class="form-group">

		            <strong>Hora salida:</strong>

		           {!! Form::time('hora_salida', $reservacion->hora_salida) !!}

		        </div>
		    </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>CI Cliente:</strong>

                    <input type="text" class="form-controller" value="{{ $reservacion->cliente1->ci }}" name="cliente1"></input>

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>CI Acompañante:</strong>

                    <input type="text" class="form-controller" value="{{ $reservacion->cliente2->ci }}" name="cliente2"></input>

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Placa:</strong>

                    <input type="text" class="form-controller" value="{{ $reservacion->auto->placa }}" name="auto"></input>

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Habitacion:</strong>
                    <label for="habitacion-reservacion">{{ $reservacion->habitacion->habitacion }}</label>
                    <input type="text" id="habitacion-reservacion" name="habitacion" value="{{ $reservacion->habitacion->habitacion }}" hidden>
                </div>

            </div>

		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

		            <button type="submit" class="btn btn-primary">Enviar</button>

		    </div>

    </form>
    @endif

@endsection