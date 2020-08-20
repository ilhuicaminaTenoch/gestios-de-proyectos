<?php

namespace App\Http\Controllers;

use DB;
use App\Product;
use App\Graficas;
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

        $queryHead = DB::select('call sp_obtiene_distribucion_contra(?,?)',
        [
            $request->fechaInicial,
            $request->fechaFinal
        ]);

        $pieChart = DB::select('call sp_obtiene_distribucion_tipo(?,?)', [$request->fechaInicial,$request->fechaFinal]);
        $columChart = DB::select('call sp_obtiene_distribucion_compania(?, ?)', [$request->fechaInicial,$request->fechaFinal]);

        $modelGraficas = new Graficas();
        $dataPieChart = $modelGraficas->pieChart(json_decode(json_encode($pieChart), true));
        $data = [
            'head' => $queryHead,
            'params' => [
                'fechaInicial' => $request->fechaInicial,
                'fechaFinal' => $request->fechaFinal
            ],
            'pieChart' => $dataPieChart,
            'columChart' => $modelGraficas->columChart(json_decode(json_encode($columChart), true))
        ];
        return view('Reportes.graficas.preview',  $data);
    }

    public function download($fechaInicial, $fechaFinal)
    {
        $queryHead = DB::select('call sp_obtiene_distribucion_contra(?,?)',
        [
            $fechaInicial,
            $fechaFinal
        ]);

        $pieChart = DB::select('call sp_obtiene_distribucion_tipo(?,?)', [$fechaInicial,$fechaFinal]);
        $columChart = DB::select('call sp_obtiene_distribucion_compania(?, ?)', [$fechaInicial,$fechaFinal]);

        $modelGraficas = new Graficas();
        $data = [
            'head' => $queryHead,
            'params' => [
                'fechaInicial' => $fechaInicial,
                'fechaFinal' => $fechaFinal
            ],
            'pieChart' => $modelGraficas->pieChart(json_decode(json_encode($pieChart), true)),
            'columChart' => $modelGraficas->columChart(json_decode(json_encode($columChart), true))
        ];
        $render = view('pdfs.chart', $data)->render();

        $pdf = new Pdf();
        $pdf->addPage($render);
        $pdf->setOptions(['javascript-delay' => 5000]);
        $pdf->saveAs(public_path('report.pdf'));

        return response()->download(public_path('report.pdf'));
    }

    public function prouductsListing(){
        $products = Product::all();
        return view("pdfs.products", compact("products"));
    }
}
