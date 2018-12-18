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

    public function getPromoDescription(Request $request)

    {

    if($request->ajax())

        {

            $promo_tipo=DB::table('promo')->where('tipo',$request->tipo)->get();

            if($promo_tipo){
                return response()->json($promo_tipo);
            }
        }
    }

    public function getPromoPrecio(Request $request)

    {

    if($request->ajax())

        {

            $promo_precio=DB::table('promo')->where('descripcion',$request->descripcion)->get();

            if($promo_precio){
                return response()->json($promo_precio);
            }
        }
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

        $costo_hab = Promo::where('tipo', $request->input('tipo'))
        ->where('descripcion', $request->input('descripcion'))
        ->value('costo');

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

            $habitacions=DB::table('habitacions')->where('caracteristicas','LIKE',$request->search."%")
            ->orWhere('tipo','LIKE',$request->search."%")
            ->orWhere('costo','LIKE',$request->search."%")
            ->orWhere('estado','LIKE',$request->search."%")
            ->orWhere('observacion','LIKE',$request->search."%")
            ->orWhere('habitacion','LIKE',$request->search."%")
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

    public function search_promo(Request $request)
    {

        if($request->ajax())
    
            {
    
                $promo=DB::table('promo')->where('tipo',$request->search)->get();
    
                if($promo){
                    return response()->json($promo);
                }
            }
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