<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Diex;

use Spatie\Permission\Models\Permission;

use DB;


class DiexController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    function __construct()

    {

         $this->middleware('permission:diex-list');

         $this->middleware('permission:diex-create', ['only' => ['create','store']]);

         $this->middleware('permission:diex-edit', ['only' => ['edit','update']]);

         $this->middleware('permission:diex-delete', ['only' => ['destroy']]);

    }


    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)

    {

        $diex = Diex::orderBy('id','DESC')->paginate(5);

        return view('diex.index',compact('diex'))

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

        return view('diex.create',compact('permission'));

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

            'ci',

            'nombre',

            'placa',

            'observacion',

            'estado'
        ]);


        $diex = Diex::create(
            [

            'observacion' => $request->input('observacion'),

            'ci' => $request->input('ci'),

            'nombre' => $request->input('nombre'),

            'placa' => $request->input('placa'),

            'estado' => $request->input('estado')
            
            ]);


        return redirect()->route('diex.index')

                        ->with('success','Diex creado satisfactoriamente');

    }

    /**

     * Display the specified resource.

     *

     * @param  \App\Diex  $diex

     * @return \Illuminate\Http\Response

     */

    public function show(Diex $diex)

    {

        return view('diex.show',compact('diex'));

    }

    public function searchDiex(Request $request)

    {

    if($request->ajax())

        {

            $diex=DB::table('diexes')->where('ci','LIKE',$request->search."%")
            ->orWhere('placa','LIKE',$request->search."%")
            ->orWhere('nombre','LIKE',$request->search."%")
            ->orWhere('estado','LIKE',$request->search."%")
            ->orWhere('observacion','LIKE',$request->search."%")
            ->get();

            if($diex){
                return response()->json($diex);
            }
        }
    }

    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Diex  $diex

     * @return \Illuminate\Http\Response

     */

    public function edit(Diex $diex)

    {

        return view('diex.edit',compact('diex'));

    }


    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Diex  $diex

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, Diex $diex)

    {

         request()->validate([

            'ci',

            'nombre',

            'placa',

            'observacion',

            'estado'

        ]);


        $diex->update($request->all());


        return redirect()->route('diex.index')

                        ->with('success','Diex Actualizado Satisfactoriamente');

    }


    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Diex  $diex

     * @return \Illuminate\Http\Response

     */

    public function destroy(Diex $diex)

    {

        $diex->delete();


        return redirect()->route('diex.index')

                        ->with('success','Diex borrado satisfactoriamente');

    }

}