<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Empleado;

use App\Turno;

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

        $turnos = Turno::pluck('id','id')->all();

        return view('empleados.create',compact('turnos'));

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

            'nombre' => 'required',

            'turnos' => 'required'

        ]);


        $empleado = Empleado::create(
            [

            'ci' => $request->input('ci'),

            'nombre' => $request->input('nombre')
            
            ]);
        
        
        $empleado_find = Empleado::find($empleado->id);
        $empleado_find->turnos()->attach($request->input('turnos'));
        $empleado_find->save();

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


    public function searchEmpleado(Request $request)

    {

    if($request->ajax())

        {

            $empleados=DB::table('empleados')->where('ci','LIKE',$request->search."%")
            ->orWhere('nombre','LIKE',$request->search."%")
            ->get();

            if($empleados){
                return response()->json($empleados);
            }
        }
    }


    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Empleado  $empleado

     * @return \Illuminate\Http\Response

     */

    public function edit(Empleado $empleado)

    {
        $turnos = Turno::pluck('id','id')->all();

        $turnosEmpleados = $empleado->turnos->pluck('id','id')->all();

        return view('empleados.edit',compact('empleado', 'turnos', 'turnosEmpleados'));

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

            'nombre' => 'required',

            'turnos' => 'required'

        ]);


        $empleado->update([
            'ci' => $request->input('ci'),
            'nombre' => $request->input('nombre')
        ]);

        DB::table('empleados_turnos')->where('empleado_id',$empleado->id)->delete();
        $empleado->turnos()->attach($request->input('turnos'));
        $empleado->save();

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
        DB::table('empleados_turnos')->where('empleados_id',$empleado->id)->delete();


        return redirect()->route('empleados.index')

                        ->with('success','Empleado borrado satisfactoriamente');

    }

}