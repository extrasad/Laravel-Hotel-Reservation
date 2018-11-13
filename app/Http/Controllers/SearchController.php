<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use DB;




class SearchController extends Controller

{

   public function index()

{

return view('search.search');

}



public function search(Request $request)

{

if($request->ajax())

{

$output="";

$habitaciones=DB::table('habitacions')->where('caracteristicas','LIKE','%'.$request->search."%")
->orWhere('tipo','LIKE','%'.$request->search."%")
->orWhere('costo','LIKE','%'.$request->search."%")
->orWhere('estado','LIKE','%'.$request->search."%")
->orWhere('habitacion','LIKE','%'.$request->search."%")
->orWhere('observacion','LIKE','%'.$request->search."%")
->get();

if($habitaciones)

{

foreach ($habitaciones as $key => $habitacion) {

$output.='<tr>'.

'<td>'.$habitacion->id.'</td>'.

'<td>'.$habitacion->caracteristicas.'</td>'.

'<td>'.$habitacion->habitacion.'</td>'.

'<td>'.$habitacion->costo.'</td>'.

'<td>'.$habitacion->tipo.'</td>'.

'<td>'.$habitacion->estado.'</td>'.

'</tr>';

}



return Response($output);



   }



   }



}

}