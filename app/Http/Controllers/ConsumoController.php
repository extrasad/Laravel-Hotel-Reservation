<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Consumo;

use App\Producto;

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

        return view('consumos.create',compact('productos'));

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

            'productos' => 'required'

        ]);

        $productos = $request->input('productos');

        $costo = array();

        $consumo = new Consumo();

        foreach($productos as $producto){
            $producto_id = DB::table('productos')->where('descripcion',$producto)->value('id');
            $consumo->producto = $producto_id;
            $producto_costo = DB::table('productos')->where('descripcion',$producto)->value('costo');
            array_push($costo, $producto_costo);
        }
        $total = array_sum($costo);
        $consumo->costo= $total;
        $consumo->estado = $request->input('estado');
        $consumo->save();


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

        $consumoProducto = $consumo->productos->pluck('descripcion','descripcion')->all();

        return view('consumos.edit',compact('consumo'));

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

            'producto' => 'required'

        ]);


        $consumo->update($request->all());


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

        $consumo->delete();


        return redirect()->route('consumos.index')

                        ->with('success','Consumo borrado satisfactoriamente');

    }

}