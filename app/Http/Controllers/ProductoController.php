<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Producto;

use Spatie\Permission\Models\Permission;

use DB;


class ProductoController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    function __construct()

    {

         $this->middleware('permission:producto-list');

         $this->middleware('permission:producto-create', ['only' => ['create','store']]);

         $this->middleware('permission:producto-edit', ['only' => ['edit','update']]);

         $this->middleware('permission:producto-delete', ['only' => ['destroy']]);

    }


    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)

    {

        $productos = Producto::orderBy('id','DESC')->paginate(5);

        return view('productos.index',compact('productos'))

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

        return view('productos.create',compact('permission'));

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

            'costo' => 'required'

        ]);


        $producto = Producto::create(
            [

            'descripcion' => $request->input('descripcion'),

            'costo' => $request->input('costo')
            
            ]);


        return redirect()->route('productos.index')

                        ->with('success','Producto creado satisfactoriamente');

    }

    /**

     * Display the specified resource.

     *

     * @param  \App\Producto  $producto

     * @return \Illuminate\Http\Response

     */

    public function show(Producto $producto)

    {

        return view('productos.show',compact('producto'));

    }

    public function searchProducto(Request $request)

    {

    if($request->ajax())

        {

            $productos=DB::table('productos')->where('descripcion','LIKE',$request->search."%")
            ->orWhere('costo','LIKE',$request->search."%")
            ->get();

            if($productos){
                return response()->json($productos);
            }
        }
    }

    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Producto  $producto

     * @return \Illuminate\Http\Response

     */

    public function edit(Producto $producto)

    {

        return view('productos.edit',compact('producto'));

    }


    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Producto  $producto

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, Producto $producto)

    {

         request()->validate([

            'descripcion' => 'required',

            'costo' => 'required'

        ]);


        $producto->update($request->all());


        return redirect()->route('productos.index')

                        ->with('success','Producto Actualizado Satisfactoriamente');

    }


    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Producto  $producto

     * @return \Illuminate\Http\Response

     */

    public function destroy(Producto $producto)

    {

        $producto->delete();


        return redirect()->route('productos.index')

                        ->with('success','Producto borrado satisfactoriamente');

    }

}