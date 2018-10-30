<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Cliente;

use Spatie\Permission\Models\Permission;

use DB;


class ClienteController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    function __construct()

    {

         $this->middleware('permission:cliente-list');

         $this->middleware('permission:cliente-create', ['only' => ['create','store']]);

         $this->middleware('permission:cliente-edit', ['only' => ['edit','update']]);

         $this->middleware('permission:cliente-delete', ['only' => ['destroy']]);

    }


    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)

    {

        $clientes = Cliente::orderBy('id','DESC')->paginate(5);

        return view('clientes.index',compact('clientes'))

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

        return view('clientes.create',compact('permission'));

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

            'ci' => 'required|unique:clientes,ci',

            'nombre' => 'required',

            'observacion',

            'estado' => 'required'

        ]);


        $cliente = Cliente::create(
            [

            'ci' => $request->input('ci'),

            'nombre' => $request->input('nombre'),

            'observacion' => $request->input('observacion'),

            'estado' => $request->input('estado')
            
            ]);


        return redirect()->route('clientes.index')

                        ->with('success','Cliente creado satisfactoriamente');

    }

    /**

     * Display the specified resource.

     *

     * @param  \App\Cliente  $cliente

     * @return \Illuminate\Http\Response

     */

    public function show(Cliente $cliente)

    {

        return view('clientes.show',compact('cliente'));

    }


    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Cliente  $cliente

     * @return \Illuminate\Http\Response

     */

    public function edit(Cliente $cliente)

    {

        return view('clientes.edit',compact('cliente'));

    }


    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Cliente  $cliente

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, Cliente $cliente)

    {

         request()->validate([

            'ci' => 'required|unique:clientes,ci,'.$cliente->id,

            'nombre' => 'required',

            'observacion',

            'estado' => 'required'

        ]);


        $cliente->update($request->all());


        return redirect()->route('clientes.index')

                        ->with('success','Cliente Actualizado Satisfactoriamente');

    }


    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Cliente  $cliente

     * @return \Illuminate\Http\Response

     */

    public function destroy(Cliente $cliente)

    {

        $cliente->delete();


        return redirect()->route('clientes.index')

                        ->with('success','Cliente borrado satisfactoriamente');

    }

}