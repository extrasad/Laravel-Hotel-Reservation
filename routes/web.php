<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::auth();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/', function () {
    return redirect()->route('home');
});


Route::post('habitacion-cambio/{id}', 'HomeController@habitacion_cambio')->name('habitacion_cambio');

Route::post('create-auto', 'ReservacionController@create_auto')->name('create_auto');

Route::post('create-cliente', 'ReservacionController@create_cliente')->name('create_cliente');

Route::get('descargar-factura/{id}', 'ReservacionController@pdf')->name('reservacion.pdf');

Route::post('/agregar-consumo/{id}', 'ReservacionController@agregar_consumo')->name('reservacion.agregar_consumo');

Route::post('/editar-consumo/{id}', 'ReservacionController@editar_consumo')->name('reservacion.editar_consumo');

Route::post('/pagar-consumo/{id}', 'ReservacionController@consumo_cancelado')->name('reservacion.pagar_consumo');

Route::post('/cancelar-reservacion/{id}', 'ReservacionController@cancelar_reservacion')->name('reservacion.cancelar_reservacion');

Route::post('descargar-reporte/', 'HomeController@reporte_pdf')->name('reporte_dashboard.pdf');

Route::get('/search-cliente-reservacion', 'ReservacionController@searchCliente')->name('reservacion.cliente');

Route::get('/search-auto-reservacion', 'ReservacionController@searchAuto')->name('reservacion.auto');

Route::get('/search-producto-reservacion', 'ReservacionController@searchProducto')->name('reservacion.producto');

Route::get('/search-reservacion', 'ReservacionController@searchReservacion')->name('reservacion.search');

Route::get('/search-auto', 'AutoController@searchAuto')->name('auto.search');

Route::get('/search-cliente', 'ClienteController@searchCliente')->name('cliente.search');

Route::get('/search-consumo', 'ConsumoController@searchConsumo')->name('consumo.search');

Route::get('/search-diex', 'DiexController@searchDiex')->name('diex.search');

Route::get('/search-empleado', 'EmpleadoController@searchEmpleado')->name('empleado.search');

Route::get('/search-habitacion', 'HabitacionController@searchHabitacion')->name('habitacion.search');

Route::get('/search-producto', 'ProductoController@searchProducto')->name('producto.search');

Route::get('/search-promo', 'PromoController@searchPromo')->name('promo.search');

Route::get('/search-role', 'RoleController@searchRole')->name('role.search');

Route::get('/search-tarifario', 'TarifarioController@searchTarifario')->name('tarifario.search');

Route::get('/search-turno', 'TurnoController@searchTurno')->name('turno.search');

Route::get('/search-user', 'UserController@searchUser')->name('user.search');

Route::get('/reservacion-custom-create/{id}', 'ReservacionController@custom_create')->name('reservacion.custom_create');

Route::post('/cerrar-reservacion/{id}', 'ReservacionController@cerrar')->name('reservacion.cerrar');

//Ruta pagar todos los consumos
Route::post('pagar-consumos', 'ReservacionController@pagar_consumos')->name('reservacion.pagar_consumos');

Route::post('promo-descripcion', 'HabitacionController@promo_descripcion')->name('habitacion.promo_descripcion');

Route::post('promo-precio', 'HabitacionController@promo_precio')->name('reservacion.promo_precio');

Route::group(['middleware' => ['auth']], function() {

    Route::resource('roles','RoleController');

    Route::resource('users','UserController');

    Route::resource('autos','AutoController');

    Route::resource('clientes','ClienteController');

    Route::resource('consumos','ConsumoController');

    Route::resource('empleados','EmpleadoController');

    Route::resource('habitacion','HabitacionController');

    Route::resource('productos','ProductoController');

    Route::resource('tarifarios','TarifarioController');

    Route::resource('turnos','TurnoController');

    Route::resource('reservacion','ReservacionController');

    Route::resource('diex','DiexController');

    Route::resource('promos','PromoController');


});