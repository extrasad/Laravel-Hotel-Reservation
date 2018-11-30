<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Reservacion;

use App\Habitacion;

use App\Auto;

use App\Cliente;

use App\Consumo;

use App\Producto;

use App\Diex;

use Codedge\Fpdf\Fpdf\Fpdf;

use App\Mypdf;

use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Auth;

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
        $habitacion_find = Habitacion::findOrFail($habitacion);

        $habitaciones = Habitacion::where('estado', 'Disponible')->pluck('habitacion', 'habitacion');

        return view('reservacion.create',compact('habitaciones', 'habitacion_find'));

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

        ]);

        $habitacion = Habitacion::where('habitacion', ($request->input('habitacion')));
        $estado = Habitacion::where('habitacion', ($request->input('habitacion')))->value('estado');
        $cliente1_find = Cliente::where('ci', $request->input('cliente1'))->value('id');
        if($request->input('cliente2')){
            $cliente2_find = Cliente::where('ci', $request->input('cliente2'))->value('id');
            $cliente2_date = Cliente::where('ci', $request->input('cliente2'))->value('fecha_nac');
            $dob2 = new Carbon($cliente2_date);
            $today2 = Carbon::now('America/Caracas');
            $age2 = $today2->diff($dob2)->y;
        }else{
            $cliente2_find = 0;
        }
        $cliente1_date = Cliente::where('ci', $request->input('cliente1'))->value('fecha_nac');
        $dob1 = new Carbon($cliente1_date);
        $today1 = Carbon::now('America/Caracas');
        $age1 = $today1->diff($dob1)->y;
        $cliente1_check = Reservacion::where('estado', 'Activa')
        ->where('cliente2_id', $cliente1_find)->value('id');
        $cliente1_recheck =  Reservacion::where('estado', 'Activa')
        ->where('cliente1_id', $cliente1_find)->value('id');
        $cliente2_check = Reservacion::where('estado', 'Activa')
        ->where('cliente2_id', $cliente2_find)->value('id');
        $cliente2_recheck =  Reservacion::where('estado', 'Activa')
        ->where('cliente1_id', $cliente2_find)->value('id');
        if($age1 < 18){
            return redirect()->route('home')
                        ->with('error','El cliente es menor de edad.');
        }
        if(isset($age2)){
            if($age2 < 18){
                return redirect()->route('home')
                            ->with('error','El acompañante es menor de edad.');
            }
        }
        if($cliente1_check or $cliente2_check or $cliente1_recheck or $cliente2_recheck){
            return redirect()->route('home')
                        ->with('error','Uno de los clientes se encuentra hospedado ya.');
        }
        if($cliente1_find == $cliente2_find){
            return redirect()->route('home')
                        ->with('error','No puedes colocar dos clientes iguales en la misma reservacion');
        }
        if($estado != 'Disponible'){
            return redirect()->route('home')
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
        
                'estado' => 'Activa',

                'costo_hab' => $costo
            
            ]);

        $auto_find = Auto::where('placa', $request->input('auto'))->value('id');
        $habitacion_find = Habitacion::where('habitacion', $request->input('habitacion'))->value('id');
        $reservacion_find = Reservacion::find($reservacion->id);
        $reservacion_find->habitacion()->associate($habitacion_find);
        $reservacion_find->auto()->associate($auto_find);
        $reservacion_find->cliente1()->associate($cliente1_find);
        $reservacion_find->cliente2()->associate($cliente2_find);
        $reservacion_find->save();

        if(Auth::user()->isRecepcionista()){
            return redirect()->route('home')
            ->with('success','Reservacion Creada Satisfactoriamente');
        }else{
            return redirect()->route('reservacion.index')
                        ->with('success','Reservacion Creada Satisfactoriamente');
        }
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
        $consumo_costo = Consumo::where('reservacion_id', $reservacion->id)->sum('costo_total');
        $consumo = $reservacion->consumo;

        $pdf = new FPDF;
        $pdf->AliasNbPages();
        $pdf->AddPage('L','A4',0);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(270, 5, 'Afrodita',0,0,'C');
        $pdf->Ln();
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(270,10,'Factura',0,0,'C');
        $pdf->Ln(20);

        $pdf->SetFont('Times', 'B',12);
        $pdf->Cell(30,10,'Nombre cliente:',0,0,'C');
        $pdf->SetFont('Times', '',12);
        $pdf->Cell(30,10,$reservacion->cliente1->nombre,0,0,'C');
        $pdf->SetFont('Times', 'B',12);
        $pdf->Cell(20,10,'CI cliente:',0,0,'C');
        $pdf->SetFont('Times', '',12);
        $pdf->Cell(20,10,$reservacion->cliente1->ci,0,0,'C');
        $pdf->SetFont('Times', 'B',12);
        $pdf->Cell(40,10,'Nacionalidad cliente:',0,0,'C');
        $pdf->SetFont('Times', '',12);
        $pdf->Cell(20,10,$reservacion->cliente1->nacionalidad,0,0,'C');
        $pdf->Ln();

        if($reservacion->cliente2) {
            $pdf->SetFont('Times', 'B',12);
            $pdf->Cell(42,10,'Nombre acompanante:',0,0,'C');
            $pdf->SetFont('Times', '',12);
            $pdf->Cell(30,10,$reservacion->cliente2->nombre,0,0,'C');
            $pdf->SetFont('Times', 'B',12);
            $pdf->Cell(35,10,'CI acompanante:',0,0,'C');
            $pdf->SetFont('Times', '',12);
            $pdf->Cell(20,10,$reservacion->cliente2->ci,0,0,'C');
            $pdf->SetFont('Times', 'B',12);
            $pdf->Cell(55,10,'Nacionalidad acompanante:',0,0,'C');
            $pdf->SetFont('Times', '',12);
            $pdf->Cell(20,10,$reservacion->cliente2->nacionalidad,0,0,'C');
        }
        $pdf->Ln();

        $pdf->SetFont('Times', 'B',12);
        $pdf->Cell(28,10,'Placa vehiculo:',0,0,'C');
        $pdf->SetFont('Times', '',12);
        $pdf->Cell(22,10,$reservacion->auto->placa,0,0,'C');
        $pdf->SetFont('Times', 'B',12);
        $pdf->Cell(30,10,'Modelo vehiculo:',0,0,'C');
        $pdf->SetFont('Times', '',12);
        $pdf->Cell(22,10,$reservacion->auto->modelo,0,0,'C');
        $pdf->SetFont('Times', 'B',12);
        $pdf->Cell(30,10,'Color vehiculo:',0,0,'C');
        $pdf->SetFont('Times', '',12);
        $pdf->Cell(22,10,$reservacion->auto->color,0,0,'C');
        $pdf->Ln();

        $pdf->SetFont('Times', 'B',12);
        $pdf->Cell(22,10,'Habitacion:',0,0,'C');
        $pdf->SetFont('Times', '',12);
        $pdf->Cell(10,10,$reservacion->habitacion->habitacion,0,0,'C');
        $pdf->Ln(20);

        $pdf->SetFont('Times', 'B',12);
        $pdf->SetX(75);
        $pdf->Cell(30,10,'Producto',1,0,'C');
        $pdf->Cell(40,10,'Costo unitario',1,0,'C');
        $pdf->Cell(40,10,'Cantidad',1,0,'C');
        $pdf->Cell(40,10,'Subtotal',1,0,'C');
        $pdf->Ln();

        $total = 0;
        $pdf->SetFont('Times','',12);
        foreach($consumo as $unidad) {
            $pdf->SetX(75);
            $pdf->Cell(30,10,$unidad->nombre_producto,1,0,'C');
            $pdf->Cell(40,10,$unidad->costo_producto,1,0,'C');
            $pdf->Cell(40,10,$unidad->cantidad,1,0,'C');
            $pdf->Cell(40,10,$unidad->costo_total,1,0,'C');
            $pdf->Ln();
            $total+= $unidad->costo_total;
        }
        $pdf->SetFont('Times','B',12);
        $pdf->SetX(75);
        $pdf->Cell(75,10,'Total',1,0,'C');
        $pdf->SetFont('Times','',12);
        $pdf->Cell(75,10,$total,1,0,'C');

        // $pdf->Cell(30,10,$reservacion->habitacion->habitacion,1,0,'C');
        // $pdf->Cell(40,10,$reservacion->cliente1->nombre,1,0,'C');
        // $pdf->Cell(40,10,$reservacion->cliente2->nombre,1,0,'C');
        // $pdf->Cell(60,10,$reservacion->costo_hab,1,0,'C');
        // $pdf->Cell(60,10,$reservacion->consumo_costo,1,0,'C');
        // $pdf->Cell(60,10,$reservacion->costo,1,0,'C');
        // $pdf->Cell(36,10,$reservacion->observacion,1,0,'C');
        // $pdf->Cell(36,10,$reservacion->estado,1,0,'C');

        $pdf->Output();


        exit;
    }


    public function searchReservacion(Request $request)

    {

    if($request->ajax())

        {

            $reservacions=DB::table('reservacions')->where('habitacion_id','LIKE',$request->search."%")
            ->orWhere('auto_id','LIKE',$request->search."%")
            ->orWhere('cliente1_id','LIKE',$request->search."%")
            ->orWhere('cliente2_id','LIKE',$request->search."%")
            ->orWhere('costo','LIKE',$request->search."%")
            ->orWhere('costo_hab','LIKE',$request->search."%")
            ->orWhere('fecha_salida','LIKE',$request->search."%")
            ->orWhere('observacion','LIKE',$request->search."%")
            ->orWhere('estado','LIKE',$request->search."%")
            ->orWhere('created_at','LIKE',$request->search."%")
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

            $clientes=DB::table('clientes')->where('ci',$request->search)->get();

            if($clientes){
                return response()->json($clientes);
            }
        }
    }

    public function searchAuto(Request $request)

    {

    if($request->ajax())

        {

            $autos=DB::table('autos')->where('placa',$request->search)->get();

            if($autos){
                return response()->json($autos);
            }
        }
    }

    public function searchProducto(Request $request)

    {

    if($request->ajax())

        {

            $productos=DB::table('productos')->where('descripcion','LIKE',$request->search."%")->get();

            if($productos){
                return response()->json($productos);
            }
        }
    }

    public function cerrar(Request $request, $reservacion)
    {        
        $reservacion = Reservacion::findOrFail($reservacion);
        $fecha = Carbon::now('America/Caracas');
        $habitacion = Habitacion::findOrFail($reservacion->habitacion->id);
        if($request->input('observacion')){
            $obs = $request->input('observacion');
            $cl1 = $reservacion->cliente1;
            $cl2 = $reservacion->cliente2;
            $auto = $reservacion->auto;
            $estado = $request->input('estado');
            $reservacion->update([
                'estado' => 'Inactiva',
                'observacion' => $obs,
                'fecha_salida'=> $fecha
            ]);
            $habitacion->update([
                'estado' => 'En limpieza'
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

        }
        if(!isset($reservacion->costo)){
            $reservacion->update([
                'estado' => 'Inactiva',
                'fecha_salida'=> $fecha,
                'costo' => $reservacion->costo_hab
            ]);
        }
        $reservacion->update([
            'estado' => 'Inactiva',
            'fecha_salida'=> $fecha,
        ]);
        $habitacion->update([
            'estado' => 'En limpieza'
        ]);
        
    return redirect()->route('home')

        ->with('success','Reservacion cerrada satisfactoriamente');
    }
    
    public function agregar_consumo(Request $request, $reservacion)
    {        
        $reservacion = Reservacion::findOrFail($reservacion);
        $productos = $request->productos;

        foreach($productos as $producto){
            $producto_id = DB::table('productos')->where('descripcion',$producto['nombre'])->value('id');
            $producto_costo = DB::table('productos')->where('descripcion',$producto['nombre'])->value('costo');
            $cantidad = $producto['cantidad'];
            $costo_total = $producto_costo * $cantidad;
            $consumo = Consumo::create(
                [
                    'costo_total' => $costo_total,

                    'cantidad' => $cantidad,

                    'costo_producto' => $producto_costo,
    
                    'estado' => 'Pendiente por pagar',

                    'nombre_producto' => $producto['nombre'],
                ]
            );
            $consumo->reservacion()->associate($reservacion->id);
            $consumo->update([
                'producto_id' => $producto_id
            ]);
            $consumo->save();
        }
        $consumo_costo = Consumo::where('reservacion_id', $reservacion->id)->sum('costo_total');
        $precio = $reservacion->costo_hab + $consumo_costo;
        $reservacion->update([
            'costo' => $precio
        ]);
        $data = [
            "Success" => "Consumo agregado exitosamente"
        ];
        
    return response()->json($data);
    }

    public function cancelar_reservacion(Request $request, $reservacion){
        $reservacion = Reservacion::findOrFail($reservacion);
        $habitacion = Habitacion::findOrFail($reservacion->habitacion->id);
        $reservacion->update([
            'estado' => 'Cancelada',
            'observacion' => $request->input('observacion')
            ]);
        $habitacion->update([
            'estado' => 'Disponible'
        ]);
        return redirect()->route('home')->with('success','Reservacion cancelada satisfactoriamente');
    }
    public function consumo_cancelado($consumo){
        $consumo = Consumo::findOrFail($consumo);
        $consumo->update([
            'estado' => 'Cancelado'
            ]);
        return redirect()->back()->with('success','Consumo cancelado satisfactoriamente');
        }
    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Reservacion  $reservacion

     * @return \Illuminate\Http\Response

     */

    public function create_cliente(Request $request){

        $this->validate($request, [

            'ci' => 'required|unique:clientes,ci',

            'nombre' => 'required',

            'nacionalidad' => 'required',

            'fecha_nac' => 'required'

        ]);

        $estado = Diex::where('ci', $request->input('ci'))->value('estado');

        $observacion = Diex::where('ci', $request->input('ci'))->value('observacion');

        if($estado == null){
            $estado = 'Activo';
        }

        $cliente = Cliente::create(
            [

            'ci' => $request->input('ci'),

            'nombre' => $request->input('nombre'),

            'nacionalidad' => $request->input('nacionalidad'),

            'observacion' => $observacion,

            'estado' => $estado,

            'fecha_nac' => $request->input('fecha_nac'),
            
            ]);
        
        return response()->json($cliente);
    }

    public function create_auto(Request $request){
        
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

        return response()->json($auto);
        
    }


    public function edit($habitacion)

    {
        $habitaciones = Habitacion::findOrFail($habitacion);
        $get_reservacion = Reservacion::where('habitacion_id', $habitacion)->where('estado', 'Activa')->value('id');
        $reservacion = Reservacion::findOrFail($get_reservacion);
        $productos = Producto::all();
        $consumo = $reservacion->consumo;

        
        return view('reservacion.edit',compact(
            'reservacion',
            'habitaciones',
            'consumo',
            'productos'
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