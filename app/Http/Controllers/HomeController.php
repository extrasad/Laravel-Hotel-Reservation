<?php

namespace App\Http\Controllers;

use App\Habitacion;

use App\Reservacion;

use App\Cliente;

use Illuminate\Http\Request;

use Codedge\Fpdf\Fpdf\Fpdf;

use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $habitaciones = Habitacion::all();
        $clientes = Cliente::with('reservacion')->where('estado', 'Activa')->count();
        $habOcupadas = Habitacion::where('estado', 'Ocupada')->count();
        $habActivas = Habitacion::where('estado', 'Disponible')->count();
        $clientesMeta = Cliente::all()->count();
        return view('home', compact('habitaciones', 'clientes', 'habOcupadas', 'habActivas', 'clientesMeta'));
    }
    public function reporte_pdf(Request $request)
    {
        $fecha_inicio = $request->input('fecha_inicio');
        $fecha_fin = $request->input('fecha_fin');           
        $reservaciones = Reservacion::whereBetween('created_at', [$fecha_inicio, $fecha_fin]);
        $fpdf = new Fpdf;
        $fpdf->AddPage();
        $fpdf->SetFont('Courier', 'B', 18);
        foreach($reservaciones as $reservacion){
            $fpdf->Cell(50, 25, $reservacion->id);
            $fpdf->Cell(50, 25, $reservacion->cliente1->ci);
        }
        $fpdf->Output();
        exit;
    }
    public function habitacion_cambio(Request $request, $habitacion)
    {        
        $habitacion = Habitacion::findOrFail($habitacion);
        $habitacion->update([
            'estado' => $request->input('estado')
        ]);
        return redirect()->route('home')
        ->with('success','Habitacion cambiado satisfactoriamente');
    }
}
