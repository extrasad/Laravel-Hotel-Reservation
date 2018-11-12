<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Reservacion;

use App\Habitacion;

use App\Auto;

use App\Cliente;

use App\Consumo;

use Barryvdh\DomPDF\Facade as PDF;

use Spatie\Permission\Models\Permission;

use DB;


class ReservacionController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    function __construct()

    {

         $this->middleware('permission:reservacion-list');

         $this->middleware('permission:reservacion-create', ['only' => ['create','store']]);

         $this->middleware('permission:reservacion-edit', ['only' => ['edit','update']]);

         $this->middleware('permission:reservacion-delete', ['only' => ['destroy']]);

    }


    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)

    {

        $reservaciones = Reservacion::orderBy('id','DESC')->paginate(5);

        return view('reservaciones.index',compact('reservaciones'))

            ->with('i', ($request->input('page', 1) - 1) * 5);

    }


    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        $habitaciones = Habitacion::pluck('habitacion','habitacion')->all();

        return view('reservaciones.create',compact('habitaciones', 'autos', 'clientes'));

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
            
            'hora_entrada' => 'required',

            'hora_salida' => 'required',

            'fecha_entrada' => 'required',

            'fecha_salida' => 'required',

            'observacion',

            'estado' => 'required',

            'habitacion' => 'required',

            'auto' => 'required',

            'cliente1' => 'required',

            'cliente2' => 'required'

        ]);

        $habitacion = Habitacion::where('habitacion', ($request->input('habitacion')));
        $estado = Habitacion::where('habitacion', ($request->input('habitacion')))->value('estado');

        if($estado != 'Disponible'){
            return redirect()->route('reservaciones.index')
                        ->with('success','Habitacion no disponible');
        }

        $costo = Habitacion::where('habitacion', ($request->input('habitacion')))->value('costo');
        $reservacion = Reservacion::create(
            [
                'hora_entrada' => $request->input('hora_entrada'),

                'hora_salida' => $request->input('hora_salida'),
    
                'fecha_entrada' => $request->input('fecha_entrada'),
    
                'fecha_salida' => $request->input('fecha_salida'),
    
                'observacion' => $request->input('observacion'),
    
                'estado' => $request->input('estado'),

                'costo' => $costo
            
            ]);

        $auto_find = Auto::where('placa', $request->input('auto'))->value('id');
        $cliente1_find = Cliente::where('ci', $request->input('cliente1'))->value('id');
        $cliente2_find = Cliente::where('ci', $request->input('cliente2'))->value('id');
        $habitacion_find = Habitacion::where('habitacion', $request->input('habitacion'))->value('id');
        $reservacion_find = Reservacion::find($reservacion->id);
        $reservacion_find->habitacion()->associate($habitacion_find);
        $reservacion_find->auto()->associate($auto_find);
        $reservacion_find->cliente1()->associate($cliente1_find);
        $reservacion_find->cliente2()->associate($cliente2_find);
        $reservacion_find->save();

        return redirect()->route('reservaciones.index')

                        ->with('success','Reservacion creada satisfactoriamente');

    }

    /**

     * Display the specified resource.

     *

     * @param  \App\Reservacion  $reservacion

     * @return \Illuminate\Http\Response

     */

    public function show(Reservacion $reservacion)

    {

        return view('reservaciones.show',compact('reservacion'));

    }

    public function pdf(Reservacion $reservacion)
    {        
        $reservacion = Reservacion::findOrFail($reservacion);

        $pdf = PDF::loadView('pdf.factura', compact('reservacion'));

        return $pdf->download('factura.pdf');
    }


    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Reservacion  $reservacion

     * @return \Illuminate\Http\Response

     */

    public function edit(Reservacion $reservacion)

    {
        $habitaciones = Habitacion::pluck('habitacion','habitacion')->all();
        $reservacionesClientes = $reservacion->cliente;

        return view('reservaciones.edit',compact(
            'reservacion',
            'habitaciones',
            'reservacionesClientes'

        ));

    }


    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Reservacion  $reservacion

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, Reservacion $reservacion)

    {

         request()->validate([

            'hora_entrada' => 'required',

            'hora_salida' => 'required',

            'fecha_entrada' => 'required',

            'fecha_salida' => 'required',

            'observacion' => 'required',

            'estado' => 'required',

            'habitacion' => 'required',

            'auto' => 'required',

            'clientes' => 'required'

        ]);

        $consumo = Consumo::where('id', $reservacion->consumo)->where('estado', 'Pendiente por pagar');
        $habitacion = Habitacion::find($request->input('habitacion'));
        $costo = $consumo->costo + $habitacion->costo;

        $reservacion->update([
            'hora_entrada' => $request->input('hora_entrada'),

            'hora_salida' => $request->input('hora_salida'),
    
            'fecha_entrada' => $request->input('fecha_entrada'),
    
            'fecha_salida' => $request->input('fecha_salida'),
    
            'observacion' => $request->input('observacion'),
    
            'estado' => $request->input('estado'),

            'costo' => $costo
        ]);

        DB::table('reservaciones_clientes')->where('reservacion_id',$reservacion->id)->delete();
        $reservacion->habitacion()->dissociate();
        $reservacion->auto()->dissociate();
        $reservacion->save();


        return redirect()->route('reservaciones.index')

                        ->with('success','Reservacion Actualizado Satisfactoriamente');

    }


    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Reservacion  $reservacion

     * @return \Illuminate\Http\Response

     */

    public function destroy(Reservacion $reservacion)

    {
        DB::table('reservaciones_clientes')->where('reservacion_id',$reservacion->id)->delete();
        $reservacion->habitacion()->dissociate();
        $reservacion->auto()->dissociate();
        $reservacion->delete();
        

        return redirect()->route('reservaciones.index')

                        ->with('success','Reservacion borrada satisfactoriamente');

    }

}