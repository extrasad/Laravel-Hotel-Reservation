<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Consumo;

use App\Producto;

use App\Reservacion;

use Spatie\Permission\Models\Permission;

use DB;


class ConsumoController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    function __construct()

    {

         $this->middleware('permission:consumo-list');

         $this->middleware('permission:consumo-create', ['only' => ['create','store']]);

         $this->middleware('permission:consumo-edit', ['only' => ['edit','update']]);

         $this->middleware('permission:consumo-delete', ['only' => ['destroy']]);

    }


    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)

    {

        $consumos = Consumo::orderBy('id','DESC')->paginate(5);

        return view('consumos.index',compact('consumos'))

            ->with('i', ($request->input('page', 1) - 1) * 5);

    }


    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        $productos = Producto::pluck('descripcion','descripcion')->all();

        $reservaciones = Reservacion::where('estado','Activa')->pluck('id', 'id')->all();

        return view('consumos.create',compact('productos', 'reservaciones'));

    }

    public function searchConsumo(Request $request)

    {

    if($request->ajax())

        {

            $consumos=DB::table('consumos')->where('reservacion_id','LIKE',$request->search."%")
            ->orWhere('costo','LIKE',$request->search."%")
            ->orWhere('estado','LIKE',$request->search."%")
            ->get();

            if($consumos){
                return response()->json($consumos);
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

            'productos' => 'required',

            'reservacion' => 'required'

        ]);

        $productos = $request->input('productos');

        $costo = array();

        $product_list = array();

        foreach($productos as $producto){
            $producto_id = DB::table('productos')->where('descripcion',$producto)->value('id');
            $producto_costo = DB::table('productos')->where('descripcion',$producto)->value('costo');
            array_push($costo, $producto_costo);
            array_push($product_list, $producto_id);
        }
        $total = array_sum($costo);
        $consumo = Consumo::create(
            [
                'costo' => $total,

                'estado' => $request->input('estado')
            ]
        );
        $producto_find = Producto::find($product_list);
        $consumo->producto()->attach($producto_find);
        $consumo->reservacion()->associate($request->input('reservacion'));
        $consumo->save();
        $reservacion = Reservacion::find($request->input('reservacion'));
        $precio = $reservacion->costo_hab + $consumo->costo;
        $reservacion->update(
            ['costo' => $precio]

        );

        return redirect()->route('consumos.index')

                        ->with('success','Consumo creado satisfactoriamente');

    }

    /**

     * Display the specified resource.

     *

     * @param  \App\Consumo  $consumo

     * @return \Illuminate\Http\Response

     */

    public function show(Consumo $consumo)

    {

        return view('consumos.show',compact('consumo'));

    }


    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Consumo  $consumo

     * @return \Illuminate\Http\Response

     */

    public function edit(Consumo $consumo)

    {
        $productos = Producto::pluck('descripcion','descripcion')->all();

        $reservaciones = Reservacion::where('estado','Activa')->pluck('id', 'id')->all();

        $consumoProducto = $consumo->producto->pluck('descripcion','descripcion')->all();

        return view('consumos.edit',compact('consumo', 'consumoProducto', 'productos', 'reservaciones'));

    }


    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Consumo  $consumo

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, Consumo $consumo)

    {

         request()->validate([

            'estado' => 'required',

            'productos' => 'required'

        ]);

        $productos = $request->input('productos');

        $costo = array();

        $product_list = array();

        foreach($productos as $producto){
            $producto_id = DB::table('productos')->where('descripcion',$producto)->value('id');
            $producto_costo = DB::table('productos')->where('descripcion',$producto)->value('costo');
            array_push($costo, $producto_costo);
            array_push($product_list, $producto_id);
        }
        $total = array_sum($costo);
        $consumo->update([
            'costo' => $total,
            'estado' => $request->input('estado')
        ]);

        DB::table('consumo_producto')->where('consumo_id',$consumo->id)->delete();

        $producto_find = Producto::find($product_list);
        $consumo->producto()->attach($producto_find);
        $consumo->save();
        $reservacion = Reservacion::find($consumo->reservacion->id);
        $precio = $reservacion->costo_hab + $consumo->costo;
        $reservacion->update(
            ['costo' => $precio]
        );


        return redirect()->route('consumos.index')

                        ->with('success','Consumo Actualizado Satisfactoriamente');

    }


    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Consumo  $consumo

     * @return \Illuminate\Http\Response

     */

    public function destroy(Consumo $consumo)

    {

        DB::table('consumo_producto')->where('consumo_id',$consumo->id)->delete();
        $consumo->delete();
        


        return redirect()->route('consumos.index')

                        ->with('success','Consumo borrado satisfactoriamente');

    }

}