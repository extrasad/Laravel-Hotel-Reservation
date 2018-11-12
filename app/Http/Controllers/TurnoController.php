<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Turno;

use Spatie\Permission\Models\Permission;

use DB;


class TurnoController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    function __construct()

    {

         $this->middleware('permission:turno-list');

         $this->middleware('permission:turno-create', ['only' => ['create','store']]);

         $this->middleware('permission:turno-edit', ['only' => ['edit','update']]);

         $this->middleware('permission:turno-delete', ['only' => ['destroy']]);

    }


    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)

    {

        $turnos = Turno::orderBy('id','DESC')->paginate(5);

        return view('turnos.index',compact('turnos'))

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

        return view('turnos.create',compact('permission'));

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

            'fecha' => 'required',

            'hora_entrada' => 'required',

            'hora_salida' => 'required',

        ]);


        $turno = Turno::create(
            [

            'fecha' => $request->input('fecha'),

            'hora_entrada' => $request->input('hora_entrada'),

            'hora_salida' => $request->input('hora_salida')
            
            ]);


        return redirect()->route('turnos.index')

                        ->with('success','Turno creado satisfactoriamente');

    }

    /**

     * Display the specified resource.

     *

     * @param  \App\Turno  $turno

     * @return \Illuminate\Http\Response

     */

    public function show(Turno $turno)

    {

        return view('turnos.show',compact('turno'));

    }


    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Turno  $turno

     * @return \Illuminate\Http\Response

     */

    public function edit(Turno $turno)

    {

        return view('turnos.edit',compact('turno'));

    }


    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Turno  $turno

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, Turno $turno)

    {

         request()->validate([

            'fecha' => 'required',

            'hora_entrada' => 'required',

            'hora_salida' => 'required',

        ]);


        $turno->update($request->all());


        return redirect()->route('turnos.index')

                        ->with('success','Turno Actualizado Satisfactoriamente');

    }


    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Turno  $turno

     * @return \Illuminate\Http\Response

     */

    public function destroy(Turno $turno)

    {

        $turno->delete();


        return redirect()->route('turnos.index')

                        ->with('success','Turno borrado satisfactoriamente');

    }

}