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

                        <tr>
                
                            <td>Cocossette</td>
                
                            <td></td>
                
                            <th>2312Bs</th>
                
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                    
                            <td>Costo Total:</td>
                                
                            <th>2312Bs</th>
                
                        </tr>
                    </tfoot>
                </table>
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
            let previousSelected;

            // Events
            addProductoBtn.on('click', addRequisito);
            tableBody.on('click', '.btn-remove-requisito', removeRequisito);
            // tableBody.on('click', '.btns-quantity', quantityLogic);

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
                    tableBody.append(`
                        <tr id="producto-${valProducto}" class="producto-table-row">

                            <td>
                                <label for="productos[${indexProducto}][${nombreProducto}]" >${nombreProducto}</label>
                                <input type="text" id="productos[${indexProducto}][${nombreProducto}]" name="productos[${indexProducto}][${nombreProducto}]" value="${valProducto}" hidden>
                            </td>

                            <td>
                                <input type="number" data-costoprod="${costoProducto}" data-cantidad="1" id="productos[${indexProducto}][cantidad]" name="productos[${indexProducto}][cantidad]" value="${valProducto}">
                            </td>

                            <td class="product-quantity">${costoProducto}</td>

                            <td class="producto-remove">
                                <span class="btn-remove-requisito" data-delete="#producto-${valProducto}">
                                    x
                                </span>
                            </td>
                        </tr>
                    `);
                }

                previousSelected = productoSelect.find(':selected');
                
            }

            function addNoRequisito() {
                const type = requisitoSelect.data('type');
                tableBody.append('<tr class="form__table-row form__table-no-element"><td class="form__table-no-element">No se han agregado ' + type + '</td></tr>');
            }

            function removeRequisito(e) {
                const thisEL = e.target.parentNode;
                const dataRemove = thisEL.dataset.delete;
                console.log(dataRemove);
                $(dataRemove).remove();

                if (tableBody.children().length < 1) {
                    addNoRequisito();
                }
            }

            function quantityLogic() {
                const thisEl = $(this);
                const cantidadBase = thisEl.data('cantidad');
                const costo = thisEl.data('costoprod');
                const value = thisEl.val();
                const parent = thisEl.parent().parent().parent().parent();
                
                if (cantidadBase === value) {
                    
                }

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