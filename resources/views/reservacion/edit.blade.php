@extends('layouts.app')


@section('content')


    @if(auth()->user()->isRecepcionista())

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            HABITACION ##
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form action="{{ route('reservacion.cerrar', $reservacion->id) }}" method="POST">
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
                                        <th>Costo</th>
                                        <th>Accion</th>
                                    </tr>
                                </thead>
                                <tbody class="table__body producto-table-body">
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
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-link waves-effect">CONFIRMAR</button>
                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCELAR</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script type="text/javascript">

        jQuery(document).ready( function($) {

            const addProductoBtn = $('#addProducto');
            const tableBody = $('.producto-table-body');
            const tableRow = $('.producto-table-row');
            const productoSelect = $('#productoSelect');
            let previousSelected;

            // Events
            addProductoBtn.on('click', addRequisito);
            tableBody.on('click', '.btn-remove-requisito', removeRequisito);
            tableBody.on('keyup mouseup', '.input-cantidad', quantityLogic);
            addProductoBtn.on('click', totalQuantity);
            tableBody.on('keyup mouseup', '.input-cantidad', totalQuantity);

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
                                <input type="text" id="productos[${indexProducto}][${nombreProducto}]" name="productos[${indexProducto}][nombre]" value="${nombreProducto}" hidden>
                            </td>

                            <td>
                                <input type="number" class="input-cantidad" data-costoprod="${costoProducto}" data-cantidad="1" id="productos[${indexProducto}][cantidad]" name="productos[${indexProducto}][cantidad]" value="1">
                            </td>

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