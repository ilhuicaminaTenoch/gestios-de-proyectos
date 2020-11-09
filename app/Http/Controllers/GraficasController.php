<?php

namespace App\Http\Controllers;

use DB;
use App\Product;
use App\Graficas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDF;

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
            'fechaFinal' => 'required|date',
        ]);

        $queryHead = DB::select('call sp_obtiene_distribucion_contra(?,?)',
        [
            $request->fechaInicial,
            $request->fechaFinal
        ]);

        $pieChart = DB::select('call sp_obtiene_distribucion_tipo(?,?)', [$request->fechaInicial,$request->fechaFinal]);
        $columChart = DB::select('call sp_obtiene_distribucion_compania(?, ?)', [$request->fechaInicial,$request->fechaFinal]);
        $columChartAreaVsContratistas = DB::select('call sp_obtiene_distribucion_area(?,?)', [$request->fechaInicial,$request->fechaFinal]);

        $modelGraficas = new Graficas();
        $dataPieChart = $modelGraficas->pieChart(json_decode(json_encode($pieChart), true));
        $dataColumAreaVsContratistas = $modelGraficas->columChartContratistas(json_decode(json_encode($columChartAreaVsContratistas), true));
        $dataColumChart = $modelGraficas->columChart(json_decode(json_encode($columChart), true));
        $data = [
            'head' => $queryHead,
            'params' => [
                'fechaInicial' => $request->fechaInicial,
                'fechaFinal' => $request->fechaFinal
            ],
            'pieChart' => $dataPieChart,
            'columChart' => $dataColumChart,
            'columArea' => $dataColumAreaVsContratistas
        ];
        return view('Reportes.graficas.preview',  $data);
    }

    public function download($fechaInicial, $fechaFinal)
    {
        $queryHead = DB::select('call sp_obtiene_distribucion_contra(?,?)',
        [
            $fechaInicial,
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
        $pdf = PDF::loadView('pdfs.chart', $data);
        return $pdf->download("report.pdf");
        /*$render = view('pdfs.chart', $data)->render();

        $pdf = new Pdf();
        $pdf->addPage($render);
        $pdf->setOptions(['javascript-delay' => 5000]);
        $pdf->saveAs(public_path('report.pdf'));

        return response()->download(public_path('report.pdf'));*/

    }

    public function prouductsListing(){
        $products = Product::all();
        return view("pdfs.products", compact("products"));
    }

    public function tiempoReal(){
        return view('Reportes.graficas.tiempo-real');
    }

    public function previewTiempoReal(Request $request){
        $validator = Validator::make($request->all(), [
            'fechaInicial' => [
                'required',
                function ($attribute, $value, $fail) use ($request){
                    $isExist = DB::select('call sp_obtiene_distribucion_contra_real(?)', [$request->fechaInicial]);
                    if ($isExist[0]->EMPRESA == 0){
                        $fail('No se encontraron datos');
                    }
                }
            ]

        ]);
        if ($validator->fails()) {
            return redirect('graficas/tiempo-real')
                ->withErrors($validator)
                ->withInput();
        }

        $queryHead = DB::select('call sp_obtiene_distribucion_contra_real(?)', [$request->fechaInicial]);
        $pieChart = DB::select('call sp_obtiene_distribucion_tipo_real(?)', [$request->fechaInicial]);
        $columChart = DB::select('call sp_obtiene_distribucion_compania_real(?)', [$request->fechaInicial]);
        $columChartAreaVsContratistas = DB::select('call sp_obtiene_distribucion_area_real(?)', [$request->fechaInicial]);
        $modelGraficas = new Graficas();
        $dataPieChart = $modelGraficas->pieChart(json_decode(json_encode($pieChart), true));
        $dataColumAreaVsContratistas = $modelGraficas->columChartContratistas(json_decode(json_encode($columChartAreaVsContratistas), true));

        $data = [
            'head' => $queryHead,
            'params' => [
                'fechaInicial' => $request->fechaInicial,
                'fechaFinal' => $request->fechaFinal
            ],
            'pieChart' => $dataPieChart,
            'columChart' => $modelGraficas->columChart(json_decode(json_encode($columChart), true)),
            'columArea' => $dataColumAreaVsContratistas
        ];
        //dd($data);
        return view('Reportes.graficas.preview-tiempo-real',  $data);
    }
}
