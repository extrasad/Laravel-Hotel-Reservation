<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Tarifario;

use Spatie\Permission\Models\Permission;

use DB;


class TarifarioController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    function __construct()

    {

         $this->middleware('permission:tarifario-list');

         $this->middleware('permission:tarifario-create', ['only' => ['create','store']]);

         $this->middleware('permission:tarifario-edit', ['only' => ['edit','update']]);

         $this->middleware('permission:tarifario-delete', ['only' => ['destroy']]);

    }


    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)

    {

        $tarifarios = Tarifario::orderBy('id','DESC')->paginate(5);

        return view('tarifarios.index',compact('tarifarios'))

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

        return view('tarifarios.create',compact('permission'));

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

            'tipo' => 'required'
        ]);


        $tarifario = Tarifario::create(
            [

            'tipo' => $request->input('tipo')
            
            ]);

        return redirect()->route('tarifarios.index')

                        ->with('success','Tarifario creado satisfactoriamente');

    }

    /**

     * Display the specified resource.

     *

     * @param  \App\Tarifario  $tarifario

     * @return \Illuminate\Http\Response

     */

    public function show(Tarifario $tarifario)

    {

        return view('tarifarios.show',compact('tarifario'));

    }

    public function searchTarifario(Request $request)

    {

    if($request->ajax())

        {

            $tarifarios=DB::table('tarifarios')->where('tipo','LIKE','%'.$request->searchTarifario."%")
            ->get();

            if($tarifarios){
                return response()->json($tarifarios);
            }
        }
    }

    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Tarifario  $tarifario

     * @return \Illuminate\Http\Response

     */

    public function edit(Tarifario $tarifario)

    {

        return view('tarifarios.edit',compact('tarifario'));

    }


    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Tarifario  $tarifario

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, Tarifario $tarifario)

    {

         request()->validate([

            'tipo' => 'required'

        ]);


        $tarifario->update($request->all());

        $habitacion = DB::table('habitacions')->where('tipo', $tarifario->tipo);

        $habitacion->update([
            'costo' => $tarifario->precio
        ]);


        return redirect()->route('tarifarios.index')

                        ->with('success','Tarifario Actualizado Satisfactoriamente');

    }


    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Tarifario  $tarifario

     * @return \Illuminate\Http\Response

     */

    public function destroy(Tarifario $tarifario)

    {

        $tarifario->delete();


        return redirect()->route('tarifarios.index')

                        ->with('success','Tarifario borrado satisfactoriamente');

    }

}