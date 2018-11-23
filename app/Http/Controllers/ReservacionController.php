<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Reservacion;

use App\Habitacion;

use App\Auto;

use App\Cliente;

use App\Consumo;

use App\Diex;

use Codedge\Fpdf\Fpdf\Fpdf;

use Spatie\Permission\Models\Permission;

use DB;

use Input;

use Carbon\Carbon;


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

    public function custom_create($habitacion)

    {
        $habitaciones = Habitacion::where('habitacion', $habitacion)->pluck('habitacion','habitacion')->all();

        return view('reservacion.create',compact('habitaciones'));

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
        $habitacion->update(
            ['estado' => 'Ocupada']

        );
        $costo = Habitacion::where('habitacion', ($request->input('habitacion')))->value('costo');
        $reservacion = Reservacion::create(
            [

                'hora_salida' => $request->input('hora_salida'),
    
                'fecha_salida' => $request->input('fecha_salida'),
    
                'observacion' => $request->input('observacion'),
    
                'estado' => 'Activa',
<<<<<<< HEAD
=======

                'costo_hab' => $costo,
>>>>>>> master

                'costo' => $costo,

                'costo_hab' => $costo
            
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
    //ARREGLAR ESTILOS PDF
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


    public function searchReservacion(Request $request)

    {

    if($request->ajax())

        {

            $reservacions=DB::table('reservacions')->where('habitacion_id','LIKE','%'.$request->searchReservacion."%")
            ->orWhere('auto_id','LIKE','%'.$request->searchReservacion."%")
            ->orWhere('cliente1_id','LIKE','%'.$request->searchReservacion."%")
            ->orWhere('cliente2_id','LIKE','%'.$request->searchReservacion."%")
            ->orWhere('costo','LIKE','%'.$request->searchReservacion."%")
            ->orWhere('costo_hab','LIKE','%'.$request->searchReservacion."%")
            ->orWhere('fecha_salida','LIKE','%'.$request->searchReservacion."%")
            ->orWhere('observacion','LIKE','%'.$request->searchReservacion."%")
            ->orWhere('estado','LIKE','%'.$request->searchReservacion."%")
            ->orWhere('created_at','LIKE','%'.$request->searchReservacion."%")
            ->get();

            if($reservacions){
                return response()->json($reservacions);
            }
        }
    }

    public function searchCliente(Request $request)

    {

    if($request->ajax())

        {

            $clientes=DB::table('clientes')->where('ci','LIKE','%'.$request->searchCliente."%")->get();

            if($clientes){
                return response()->json($clientes);
            }
        }
    }

    public function searchAuto(Request $request)

    {

    if($request->ajax())

        {

            $autos=DB::table('autos')->where('placa','LIKE','%'.$request->searchAuto."%")->get();

            if($autos){
                return response()->json($autos);
            }
        }
    }

    public function searchProducto(Request $request)

    {

    if($request->ajax())

        {

            $productos=DB::table('productos')->where('descripcion','LIKE','%'.$request->searchProductos."%")->get();

            if($productos){
                return response()->json($productos);
            }
        }
    }

    public function cerrar(Request $request, $reservacion)
    {        
        $reservacion = Reservacion::findOrFail($reservacion);
        if($request->input('observacion')){
            $obs = $request->input('observacion');
            $cl1 = $reservacion->cliente1;
            $cl2 = $reservacion->cliente2;
            $auto = $reservacion->auto;
            $fecha = Carbon::now();
            $estado = $request->input('estado');
            $reservacion->update([
                'estado' => 'Inactiva',
                'observacion' => $obs,
                'fecha_salida'=> $fecha
            ]);
            Diex::create(
                [
    
                    'observacion' => $obs,

                    'ci' => $cl1->ci,
        
                    'nombre' => $cl1->nombre,
        
                    'placa' => $auto->placa,
        
                    'estado' => $estado
                
                ]);
                Diex::create(
                    [
        
                        'observacion' => $obs,
    
                        'ci' => $cl2->ci,
            
                        'nombre' => $cl2->nombre,
            
                        'placa' => $auto->placa,
            
                        'estado' => $estado
                    
                    ]);

        }else{
            $reservacion->update([
                'estado' => 'Inactiva',
            ]);
        }
    }
    

    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Reservacion  $reservacion

     * @return \Illuminate\Http\Response

     */

    public function edit(Habitacion $habitacion)

    {
        $habitaciones = Habitacion::where('estado', 'Disponible')->pluck('habitacion','habitacion')->all();
        $reservacion = Reservacion::where('habitacion_id', $habitacion->id);
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

            'estado',

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