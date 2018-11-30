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
        $clientes1 = Reservacion::where('estado', 'Activa')->count('cliente1_id');
        $clientes2 = Reservacion::where('estado', 'Activa')->count('cliente2_id');
        $clientes = $clientes1 + $clientes2;
        $habOcupadas = Habitacion::where('estado', 'Ocupada')->count();
        $habActivas = Habitacion::where('estado', 'Disponible')->count();
        $clientesMeta = Cliente::all()->count();
        return view('home', compact('habitaciones', 'clientes', 'habOcupadas', 'habActivas', 'clientesMeta'));
    }
    public function reporte_pdf(Request $request)
    {
        $fecha_inicio = date($request->input('fecha_inicio').' '.$request->input('hora_inicio'));
        $fecha_fin = date($request->input('fecha_fin').' '.$request->input('hora_fin'));    
        $reservaciones = Reservacion::whereBetween('created_at', array($fecha_inicio, $fecha_fin))
        ->get();

        $pdf = new FPDF;
        $pdf->AliasNbPages();
        $pdf->AddPage('L','A4',0);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(270, 5, 'Generador de Reporte - Afrodita',0,0,'C');
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(270,10,'Reporte rapido',0,0,'C');
        $pdf->Ln(20);

        $pdf->SetFont('Times', 'B',12);
        $pdf->SetX(32);
        $pdf->Cell(30,10,'Habitacion',1,0,'C');
        $pdf->Cell(40,10,'Cliente',1,0,'C');
        $pdf->Cell(40,10,'Cliente 2',1,0,'C');
        $pdf->Cell(30,10,'Costo',1,0,'C');
        $pdf->Cell(40,10,'Costo consumo',1,0,'C');
        $pdf->Cell(40,10,'Costo total',1,0,'C');
        $pdf->Ln();

        foreach($reservaciones as $reservacion){
            $costo_total = isset($reservacion->consumo->costo) ? $reservacion->consumo->costo : ''; 
            $pdf->SetFont('Times','',12);
            $pdf->SetX(32);
            $pdf->Cell(30,10,$reservacion->habitacion->habitacion,1,0,'C');
            $pdf->Cell(40,10,$reservacion->cliente1->ci,1,0,'C');
            $pdf->Cell(40,10,$reservacion->cliente2->ci,1,0,'C');
            $pdf->Cell(30,10,$reservacion->costo_hab,1,0,'C');
            $pdf->Cell(40,10,$costo_total ,1,0,'C');
            $pdf->Cell(40,10,$reservacion->costo,1,0,'C');
            $pdf->Ln();
        }


        $pdf->Output();
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
