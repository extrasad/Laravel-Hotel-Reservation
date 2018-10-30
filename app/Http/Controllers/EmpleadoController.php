<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Empleado;

use Spatie\Permission\Models\Permission;

use DB;


class EmpleadoController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    function __construct()

    {

         $this->middleware('permission:empleado-list');

         $this->middleware('permission:empleado-create', ['only' => ['create','store']]);

         $this->middleware('permission:empleado-edit', ['only' => ['edit','update']]);

         $this->middleware('permission:empleado-delete', ['only' => ['destroy']]);

    }


    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)

    {

        $empleados = Empleado::orderBy('id','DESC')->paginate(5);

        return view('empleados.index',compact('empleados'))

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

        return view('empleados.create',compact('permission'));

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

            'ci' => 'required|unique:empleados,ci',

            'nombre' => 'required'

        ]);


        $empleado = Empleado::create(
            [

            'ci' => $request->input('ci'),

            'nombre' => $request->input('nombre')
            
            ]);


        return redirect()->route('empleados.index')

                        ->with('success','Empleado creado satisfactoriamente');

    }

    /**

     * Display the specified resource.

     *

     * @param  \App\Empleado  $empleado

     * @return \Illuminate\Http\Response

     */

    public function show(Empleado $empleado)

    {

        return view('empleados.show',compact('empleado'));

    }


    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Empleado  $empleado

     * @return \Illuminate\Http\Response

     */

    public function edit(Empleado $empleado)

    {

        return view('empleados.edit',compact('empleado'));

    }


    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Empleado  $empleado

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, Empleado $empleado)

    {

         request()->validate([

            'ci' => 'required|unique:empleados,ci,'.$empleado->id,

            'nombre' => 'required'

        ]);


        $empleado->update($request->all());


        return redirect()->route('empleados.index')

                        ->with('success','Empleado Actualizado Satisfactoriamente');

    }


    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Empleado  $empleado

     * @return \Illuminate\Http\Response

     */

    public function destroy(Empleado $empleado)

    {

        $empleado->delete();


        return redirect()->route('empleados.index')

                        ->with('success','Empleado borrado satisfactoriamente');

    }

}