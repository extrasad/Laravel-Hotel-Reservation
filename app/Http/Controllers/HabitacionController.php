<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Habitacion;

use App\Promo;

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

        return view('habitacion.index',compact('habitaciones'))

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

        $tipo = Promo::pluck('tipo','tipo')->all();

        return view('habitacion.create',compact('permission', 'tipo'));

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

            'estado' => 'required',

            'observacion',

            'tipo' => 'required',

            'caracteristicas' => 'required',

            'habitacion' => 'required|unique:habitacions,habitacion'

        ]);

        $costo_hab = Promo::where('tipo', $request->input('tipo'))->value('costo');

        $habitacion = Habitacion::create(
            [

            'costo' => $costo_hab,

            'habitacion' => $request->input('habitacion'),

            'observacion' => $request->input('observacion'),

            'caracteristicas' => $request->input('caracteristicas'),

            'tipo' => $request->input('tipo'),

            'estado' => $request->input('estado')
            
            ]);


        return redirect()->route('habitacion.index')

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

        return view('habitacion.show',compact('habitacion'));

    }

    public function searchHabitacion(Request $request)

    {

    if($request->ajax())

        {

            $habitacions=DB::table('habitacions')->where('caracteristicas','LIKE','%'.$request->searchHabitacion."%")
            ->orWhere('tipo','LIKE','%'.$request->searchHabitacion."%")
            ->orWhere('costo','LIKE','%'.$request->searchHabitacion."%")
            ->orWhere('estado','LIKE','%'.$request->searchHabitacion."%")
            ->orWhere('observacion','LIKE','%'.$request->searchHabitacion."%")
            ->orWhere('habitacion','LIKE','%'.$request->searchHabitacion."%")
            ->get();

            if($habitacions){
                return response()->json($habitacions);
            }
        }
    }

    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Habitacion  $habitacion

     * @return \Illuminate\Http\Response

     */

    public function edit(Habitacion $habitacion)

    {
        $tipo = Promo::pluck('tipo','tipo')->all();

        return view('habitacion.edit',compact('habitacion', 'tipo'));

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

            'estado' => 'required',

            'observacion',

            'tipo' => 'required',

            'caracteristicas' => 'required',

            'habitacion' => 'required|unique:habitacions,habitacion,'.$habitacion->id,

        ]);

        $habitacion->update([

            'habitacion' => $request->input('habitacion'),

            'observacion' => $request->input('observacion'),

            'caracteristicas' => $request->input('caracteristicas'),

            'tipo' => $request->input('tipo'),

            'habitacion' => $request->input('habitacion'),

            'estado' => $request->input('estado')
            
            ]);


        return redirect()->route('habitacion.index')

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


        return redirect()->route('habitacion.index')

                        ->with('success','Habitacion borrada satisfactoriamente');

    }

}