<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Reservacion;

use App\Habitacion;

use App\Auto;

use App\Cliente;

use App\Consumo;

use Codedge\Fpdf\Fpdf\Fpdf;

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

        return view('reservacion.index',compact('reservaciones'))

            ->with('i', ($request->input('page', 1) - 1) * 5);

    }


    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        $habitaciones = Habitacion::where('estado', 'Disponible')->pluck('habitacion','habitacion')->all();

        return view('reservacion.create',compact('habitaciones', 'autos', 'clientes'));

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

            'observacion',

            'habitacion' => 'required',

            'cliente1' => 'required',

            'cliente2' => 'required'

        ]);

        $habitacion = Habitacion::where('habitacion', ($request->input('habitacion')));
        $estado = Habitacion::where('habitacion', ($request->input('habitacion')))->value('estado');

        if($estado != 'Disponible'){
            return redirect()->route('reservacion.index')
                        ->with('success','Habitacion no disponible');
        }

        $costo = Habitacion::where('habitacion', ($request->input('habitacion')))->value('costo');
        $reservacion = Reservacion::create(
            [

                'hora_salida' => $request->input('hora_salida'),
    
                'fecha_salida' => $request->input('fecha_salida'),
    
                'observacion' => $request->input('observacion'),
    
                'estado' => 'Activa',

                'costo_hab' => $costo,

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

        return redirect()->route('reservacion.index')

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

        return view('reservacion.show',compact('reservacion'));

    }

    /**

     * PDF of the resource.

     *

     * @param $reservacion

     */

    public function pdf($reservacion)
    {        
        $reservacion = Reservacion::findOrFail($reservacion);
        $fpdf = new Fpdf;
        $fpdf->AddPage();
        $fpdf->SetFont('Courier', 'B', 18);
        $fpdf->Cell(50, 25, $reservacion->id);
        $fpdf->Cell(50, 25, $reservacion->cliente1->ci);
        $fpdf->Cell(50, 25, 'hola');
        $fpdf->Output();
        exit;
    }


    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Reservacion  $reservacion

     * @return \Illuminate\Http\Response

     */

    public function edit(Reservacion $reservacion)

    {
        $habitaciones = Habitacion::where('estado', 'Disponible')->pluck('habitacion','habitacion')->all();

        return view('reservacion.edit',compact(
            'reservacion',
            'habitaciones'
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

            'hora_salida',

            'fecha_salida',

            'observacion',

            'habitacion' => 'required',

            'auto',

            'cliente1' => 'required',

            'cliente2' => 'required'

        ]);
        
        $reservacion->update([
    
            'observacion' => $request->input('observacion'),
    
            'estado' => 'Activa'
        ]);

        DB::table('reservaciones_clientes')->where('reservacion_id',$reservacion->id)->delete();
        $reservacion->habitacion()->dissociate();
        $reservacion->auto()->dissociate();
        $reservacion->save();
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


        return redirect()->route('reservacion.index')

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
        

        return redirect()->route('reservacion.index')

                        ->with('success','Reservacion borrada satisfactoriamente');

    }

}