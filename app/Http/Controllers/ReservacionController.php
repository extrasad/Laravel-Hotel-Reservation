<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Reservacion;

use Spatie\Permission\Models\Permission;

use DB;


class ReservacionController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    function __construct()

    {

         $this->middleware('permission:reservacion-list');

         $this->middleware('permission:reservacion-create', ['only' => ['create','store']]);

         $this->middleware('permission:reservacion-edit', ['only' => ['edit','update']]);

         $this->middleware('permission:reservacion-delete', ['only' => ['destroy']]);

    }


    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)

    {

        $reservaciones = Reservacion::orderBy('id','DESC')->paginate(5);

        return view('reservaciones.index',compact('reservaciones'))

            ->with('i', ($request->input('page', 1) - 1) * 5);

    }


    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        $permission = Permission::get();

        return view('reservaciones.create',compact('permission'));

    }


    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

        $this->validate($request, [
            
            'hora_entrada' => 'required',

            'hora_salida' => 'required',

            'fecha_entrada' => 'required',

            'fecha_salida' => 'required',

            'observacion' => 'required',

            'estado' => 'required',

            'costo' => 'required'

        ]);


        $reservacion = Reservacion::create(
            [

            'descripcion' => $request->input('descripcion'),

            'costo' => $request->input('costo')
            
            ]);


        return redirect()->route('reservaciones.index')

                        ->with('success','Reservacion creada satisfactoriamente');

    }

    /**

     * Display the specified resource.

     *

     * @param  \App\Reservacion  $reservacion

     * @return \Illuminate\Http\Response

     */

    public function show(Reservacion $reservacion)

    {

        return view('reservaciones.show',compact('reservacion'));

    }


    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Reservacion  $reservacion

     * @return \Illuminate\Http\Response

     */

    public function edit(Reservacion $reservacion)

    {

        return view('reservaciones.edit',compact('reservacion'));

    }


    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Reservacion  $reservacion

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, Reservacion $reservacion)

    {

         request()->validate([

            'descripcion' => 'required',

            'costo' => 'required'

        ]);


        $reservacion->update($request->all());


        return redirect()->route('reservaciones.index')

                        ->with('success','Reservacion Actualizado Satisfactoriamente');

    }


    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Reservacion  $reservacion

     * @return \Illuminate\Http\Response

     */

    public function destroy(Reservacion $reservacion)

    {

        $reservacion->delete();


        return redirect()->route('reservaciones.index')

                        ->with('success','Reservacion borrada satisfactoriamente');

    }

}