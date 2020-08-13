<?php

namespace App\Http\Controllers;

use DB;
//use PDF;
use App\Contratista;
use Illuminate\Http\Request;
use mikehaertl\wkhtmlto\Pdf;

class GraficasController extends Controller
{

    public function index(){
        return view('Reportes.graficas.index');
    }

    public function general() {
        $data = DB::table('tbl_employee')
        ->select(
            DB::raw('gender as gender'),
            DB::raw('count(*) as number'))
        ->groupBy('gender')
        ->get();
        $array[] = ['Gender', 'Number'];
        foreach($data as $key => $value){
            $array[++$key] = [$value->gender, $value->number];
        }
        return view('pdfs.general', ['gender' => json_encode($array)]);

  
    }

    public function preview(Request $request){
        $request->validate([
            'fechaInicial' => 'required|date',
            'fechaFinal' => 'required|date|after:fechaInicial',
        ]);

        $model = new Contratista();
        $consulta = DB::select('call sp_obtiene_distribucion_contra(?,?)', 
        [
            $request->fechaInicial,
            $request->fechaFinal
        ]);
        
        $data = ['datum' => $consulta, 'params' => ['fechaInicial' => $request->fechaInicial, 'fechaFinal' => $request->fechaFinal]];
        return view('pdfs.chart',  $data);
    }

    public function download($fechaInicial, $fechaFinal)
    {
        $model = new Contratista();
        $consulta = DB::select('call sp_obtiene_distribucion_contra(?,?)', 
        [
            $fechaInicial,
            $fechaFinal
        ]);
        
        $data = [
            'datum' => $consulta, 
            'params' => [
                'fechaInicial' => $fechaInicial, 
                'fechaFinal' => $fechaFinal
            ]
        ];
        
        $render = view('pdfs.chart', $data)->render();
    
        $pdf = new Pdf();
        $pdf->addPage($render);
        $pdf->setOptions(['javascript-delay' => 5000]);
        $pdf->saveAs(public_path('report.pdf'));
   
        return response()->download(public_path('report.pdf'));
    }
}
