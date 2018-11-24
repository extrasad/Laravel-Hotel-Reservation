<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Auto;

use App\Diex;

use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Auth;

use DB;


class AutoController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    function __construct()

    {

         $this->middleware('permission:auto-list');

         $this->middleware('permission:auto-create', ['only' => ['create','store']]);

         $this->middleware('permission:auto-edit', ['only' => ['edit','update']]);

         $this->middleware('permission:auto-delete', ['only' => ['destroy']]);

    }


    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)

    {

        $autos = Auto::orderBy('id','DESC')->paginate(5);

        return view('autos.index',compact('autos'))

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

        return view('autos.create',compact('permission'));

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

            'placa' => 'required|unique:autos,placa',

            'modelo' => 'required',

            'color' => 'required'
        ]);

        $estado = Diex::where('placa', $request->input('placa'))->value('estado');

        $observacion = Diex::where('placa', $request->input('placa'))->value('observacion');

        if($estado == null){
            $estado = 'Activo';
        }

        $auto = Auto::create(
            [

            'placa' => $request->input('placa'),

            'modelo' => $request->input('modelo'),

            'color' => $request->input('color'),

            'observacion' => $observacion,

            'estado' => $estado
            
            ]);


            if(Auth::user()->isRecepcionista()){
                return redirect()->back();
            }else{
                return redirect()->route('autos.index')
                            ->with('success','Auto Creado Satisfactoriamente');
            }

    }

    /**

     * Display the specified resource.

     *

     * @param  \App\Auto  $auto

     * @return \Illuminate\Http\Response

     */

    public function show(Auto $auto)

    {

        return view('autos.show',compact('auto'));

    }

    public function searchAuto(Request $request)

    {

    if($request->ajax())

        {

            $autos=DB::table('autos')->where('ci','LIKE','%'.$request->searchAuto."%")
            ->orWhere('nacionalidad','LIKE','%'.$request->searchAuto."%")
            ->orWhere('nombre','LIKE','%'.$request->searchAuto."%")
            ->orWhere('estado','LIKE','%'.$request->searchAuto."%")
            ->orWhere('observacion','LIKE','%'.$request->searchAuto."%")
            ->get();

            if($autos){
                return response()->json($autos);
            }
        }
    }

    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Auto  $auto

     * @return \Illuminate\Http\Response

     */

    public function edit(Auto $auto)

    {

        return view('autos.edit',compact('auto'));

    }


    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Auto  $auto

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, Auto $auto)

    {

         request()->validate([

            'placa' => 'required|unique:autos,placa,'.$auto->id,

            'modelo' => 'required',

            'color' => 'required'

        ]);

        $estado = Diex::where('placa', $request->input('placa'))->value('estado');
        $observacion = Diex::where('placa', $request->input('placa'))->value('observacion');
        
        if($estado == null){
            $estado = 'Activo';
        }

        $auto->update(
            [
            'placa' => $request->input('placa'),

            'modelo' => $request->input('modelo'),

            'color' => $request->input('color'),

            'observacion' => $observacion,

            'estado' => $estado
            ]
        );


        return redirect()->route('autos.index')

                        ->with('success','Auto Actualizado Satisfactoriamente');

    }


    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Auto  $auto

     * @return \Illuminate\Http\Response

     */

    public function destroy(Auto $auto)

    {

        $auto->delete();


        return redirect()->route('autos.index')

                        ->with('success','Auto borrado satisfactoriamente');

    }

}