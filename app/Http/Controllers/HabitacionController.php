<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Habitacion;

use Spatie\Permission\Models\Permission;

use DB;


class HabitacionController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    function __construct()

    {

         $this->middleware('permission:habitacion-list');

         $this->middleware('permission:habitacion-create', ['only' => ['create','store']]);

         $this->middleware('permission:habitacion-edit', ['only' => ['edit','update']]);

         $this->middleware('permission:habitacion-delete', ['only' => ['destroy']]);

    }


    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)

    {

        $habitaciones = Habitacion::orderBy('id','DESC')->paginate(5);

        return view('habitaciones.index',compact('habitaciones'))

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

        return view('habitaciones.create',compact('permission'));

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

            'costo' => 'required',

            'estado' => 'required',

            'observacion',

            'habitacion' => 'required'

        ]);


        $habitacion = Habitacion::create(
            [

            'costo' => $request->input('costo'),

            'habitacion' => $request->input('habitacion'),

            'observacion' => $request->input('observacion'),

            'estado' => $request->input('estado')
            
            ]);


        return redirect()->route('habitaciones.index')

                        ->with('success','Habitacion creado satisfactoriamente');

    }

    /**

     * Display the specified resource.

     *

     * @param  \App\Habitacion  $habitacion

     * @return \Illuminate\Http\Response

     */

    public function show(Habitacion $habitacion)

    {

        return view('habitaciones.show',compact('habitacion'));

    }


    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Habitacion  $habitacion

     * @return \Illuminate\Http\Response

     */

    public function edit(Habitacion $habitacion)

    {

        return view('habitaciones.edit',compact('habitacion'));

    }


    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Habitacion  $habitacion

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, Habitacion $habitacion)

    {

         request()->validate([

            'costo' => 'required',

            'habitacion' => 'required',

            'observacion',

            'estado' => 'required'

        ]);


        $habitacion->update($request->all());


        return redirect()->route('habitaciones.index')

                        ->with('success','Habitacion Actualizada Satisfactoriamente');

    }


    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Habitacion  $habitacion

     * @return \Illuminate\Http\Response

     */

    public function destroy(Habitacion $habitacion)

    {

        $habitacion->delete();


        return redirect()->route('habitaciones.index')

                        ->with('success','Habitacion borrada satisfactoriamente');

    }

}