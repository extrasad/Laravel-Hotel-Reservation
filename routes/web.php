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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::auth();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

Route::get('descargar-factura/{id}', 'ReservacionController@pdf')->name('reservacion.pdf');

Route::get('/','SearchController@index')->name('search.index');
 
Route::get('/search','SearchController@search')->name('search.search');

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