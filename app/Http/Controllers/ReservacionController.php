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

        $habitaciones = Habitacion::all()->pluck('habitacion', 'habitacion');

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
        
                'estado' => 'Activa',

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

        if(Auth::user()->isRecepcionista()){
            return redirect()->route('home');
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
        $pdf = new FPDF;
        $pdf->AliasNbPages();
        $pdf->AddPage('L','A4',0);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(270, 5, 'TITULO',0,0,'C');
        $pdf->Ln();
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(270,10,'STREET ADRESS OFF',0,0,'C');
        $pdf->Ln(20);

        $pdf->SetFont('Times', 'B',12);
        $pdf->SetX(26.5);
        $pdf->Cell(30,10,'Habitacion',1,0,'C');
        $pdf->Cell(40,10,'Cliente',1,0,'C');
        $pdf->Cell(40,10,'Cliente 2',1,0,'C');
        $pdf->Cell(60,10,'Costo',1,0,'C');
        $pdf->Cell(36,10,'Observacion',1,0,'C');
        $pdf->Cell(36,10,'Estado',1,0,'C');
        $pdf->Ln();

        $pdf->SetFont('Times','',12);
        $pdf->SetX(26.5);
        $pdf->Cell(30,10,$reservacion->habitacion->habitacion,1,0,'C');
        $pdf->Cell(40,10,$reservacion->cliente1->nombre,1,0,'C');
        $pdf->Cell(40,10,$reservacion->cliente2->nombre,1,0,'C');
        $pdf->Cell(60,10,$reservacion->costo_hab,1,0,'C');
        $pdf->Cell(36,10,$reservacion->observacion,1,0,'C');
        $pdf->Cell(36,10,$reservacion->estado,1,0,'C');

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

            $clientes=DB::table('clientes')->where('ci','LIKE',$request->search."%")->get();

            if($clientes){
                return response()->json($clientes);
            }
        }
    }

    public function searchAuto(Request $request)

    {

    if($request->ajax())

        {

            $autos=DB::table('autos')->where('placa','LIKE',$request->search."%")->get();

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
        $fecha = Carbon::now();
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
        $costo = array();
        $product_list = array();
        foreach($productos as $producto){
            $producto_id = DB::table('productos')->where('descripcion',$producto['nombre'])->value('id');
            $producto_costo = DB::table('productos')->where('descripcion',$producto['nombre'])->value('costo');
            $cantidad = $producto['cantidad'];
            $costo_total = $producto_costo * $cantidad;
            array_push($costo, $costo_total);
            array_push($product_list, $producto_id);
        }
        $total = array_sum($costo);
        $consumo = Consumo::create(
            [
                'costo' => $total,

                'estado' => 'Pendiente por pagar'
            ]
        );
        $producto_find = Producto::find($product_list);
        $consumo->producto()->attach($producto_find);
        foreach($productos as $producto){
            $producto_id_find = DB::table('productos')->where('descripcion',$producto['nombre'])->value('id');
            DB::table('consumo_producto')->where('consumo_id',$consumo->id)
            ->where('producto_id', $producto_id_find)
            ->update([
                'cantidad' => $producto['cantidad']
            ]);
        }
        $consumo->reservacion()->associate($reservacion->id);
        $consumo->save();
        $precio = $reservacion->costo_hab + $consumo->costo;
        $reservacion->update([
            'costo' => $precio
        ]);
        $data = [
            "Success" => "Consumo agregado exitosamente"
        ];
        
    return response()->json($data);
    }

    public function editar_consumo(Request $request, $reservacion)
    {        
        $reservacion = Reservacion::findOrFail($reservacion);
        $productos = $request->input('productos');
        $costo = array();
        $product_list = array();
        foreach($productos as $producto){
            $producto_id = DB::table('productos')->where('descripcion',$producto['nombre'])->value('id');
            $producto_costo = DB::table('productos')->where('descripcion',$producto['nombre'])->value('costo');
            $cantidad = $producto['cantidad'];
            $costo_total = $producto_costo * $cantidad;
            array_push($costo, $costo_total);
            array_push($product_list, $producto_id);
        }
        $total = array_sum($costo);
        $consumo = Consumo::findOrFail($reservacion->consumo->id);
        $consumo->update(
            [
                'costo' => $total
            ]
        );
        $producto_find = Producto::find($product_list);
        $consumo->producto()->detach();
        $consumo->reservacion()->dissociate();
        $consumo->save();
        $consumo->reservacion()->associate($reservacion->id);
        $consumo->producto()->attach($producto_find);
        foreach($productos as $producto){
            $producto_id_find = DB::table('productos')->where('descripcion',$producto['nombre'])->value('id');
            DB::table('consumo_producto')->where('consumo_id',$consumo->id)
            ->where('producto_id', $producto_id_find)
            ->update([
                'cantidad' => $producto['cantidad']
            ]);
        }
        $consumo->save();
        $precio = $reservacion->costo_hab + $consumo->costo;
        $reservacion->update([
            'costo' => $precio
        ]);
        $data = [
            "Success" => "Consumo editado exitosamente"
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
    public function consumo_cancelado(Request $request, $reservacion){
        $reservacion = Reservacion::findOrFail($reservacion);
        $consumo = Consumo::findOrFail($reservacion->consumo->id);
        $consumo->update([
            'estado' => 'Cancelado'
            ]);
    }
    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Reservacion  $reservacion

     * @return \Illuminate\Http\Response

     */

    public function edit($habitacion)

    {
        $habitaciones = Habitacion::findOrFail($habitacion);
        $get_reservacion = Reservacion::where('habitacion_id', $habitacion)->where('estado', 'Activa')->value('id');
        $reservacion = Reservacion::findOrFail($get_reservacion);
        $productos = Producto::all();
        $productos_consumo = array();
        if($reservacion->consumo){
            $consumo = Consumo::findOrFail($reservacion->consumo->id);
            foreach($consumo->producto as $producto){
                    array_push($productos_consumo, $producto);
            }
            
        }

        
        return view('reservacion.edit',compact(
            'reservacion',
            'habitaciones',
            'consumo',
            'productos',
            'productos_consumo'
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