<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Promo;

use App\Tarifario;

use App\Habitacion;

use Spatie\Permission\Models\Permission;

use DB;


class PromoController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    function __construct()

    {

         $this->middleware('permission:promo-list');

         $this->middleware('permission:promo-create', ['only' => ['create','store']]);

         $this->middleware('permission:promo-edit', ['only' => ['edit','update']]);

         $this->middleware('permission:promo-delete', ['only' => ['destroy']]);

    }


    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)

    {

        $promos = Promo::orderBy('id','DESC')->paginate(5);

        return view('promos.index',compact('promos'))

            ->with('i', ($request->input('page', 1) - 1) * 5);

    }


    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        $tipo = Tarifario::pluck('tipo', 'tipo')->all();

        return view('promos.create',compact('permission', 'tipo'));

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

            'descripcion' => 'required',

            'costo' => 'required',

            'tipo' => 'required',

            'horas' => 'required'

        ]);


        $promo = Promo::create(
            [

            'descripcion' => $request->input('descripcion'),

            'costo' => $request->input('costo'),

            'tipo' => $request->input('tipo'),

            'horas' => $request->input('horas')
            
            ]);


        return redirect()->route('promos.index')

                        ->with('success','Promocion creada satisfactoriamente');

    }

    /**

     * Display the specified resource.

     *

     * @param  \App\Promo  $promo

     * @return \Illuminate\Http\Response

     */

    public function show(Promo $promo)

    {

        return view('promos.show',compact('promo'));

    }

    public function searchPromo(Request $request)

    {

    if($request->ajax())

        {

            $promos=DB::table('promos')->where('descripcion','LIKE',$request->search."%")
            ->orWhere('costo','LIKE',$request->search."%")
            ->orWhere('tipo','LIKE',$request->search."%")
            ->orWhere('cantidad','LIKE',$request->search."%")
            ->get();

            if($promos){
                return response()->json($promos);
            }
        }
    }


    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Promo  $promo

     * @return \Illuminate\Http\Response

     */

    public function edit(Promo $promo)

    {
        $tipo = Tarifario::pluck('tipo', 'tipo')->all();

        return view('promos.edit',compact('promo', 'tipo'));

    }


    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Promo  $promo

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, Promo $promo)

    {

         request()->validate([

            'descripcion' => 'required',

            'costo' => 'required',

            'tipo' => 'required',

            'horas' => 'required'

        ]);


        $promo->update($request->all());

        $habitaciones = Habitacion::where('tipo', $request->input('tipo'));

        $habitaciones->update(['costo' => $request->input('costo')]);


        return redirect()->route('promos.index')

                        ->with('success','Promocion Actualizada Satisfactoriamente');

    }


    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Promo  $promo

     * @return \Illuminate\Http\Response

     */

    public function destroy(Promo $promo)

    {

        $promo->delete();


        return redirect()->route('promos.index')

                        ->with('success','Promocion borrada satisfactoriamente');

    }

}