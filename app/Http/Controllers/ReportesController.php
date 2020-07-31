<?php

namespace App\Http\Controllers;

use DB;
use App\Utilities;
use Illuminate\Http\Request;
use App\Exports\ContratistasExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ContratistasAltasBajas;

class ReportesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request) {

            return view('Reportes.HorasHombre.index');
        }
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'fechaInicial' => 'required|date',
            'fechaFinal' => 'required|date|after:fechaInicial',
        ]);

       
        return Excel::download(new ContratistasExport($input['fechaInicial'],$input['fechaFinal']), 'HorasHombre.xlsx');

    }

    public function principal(Request $request)
    {
        return view('Default.principal');
    }

    public function altasBajas(Request $request)
    {
        return view('Reportes.altas-bajas');
    }

    public function consultaAltasBajas(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'fechaInicial' => 'required|date',
            'fechaFinal' => 'required|date|after:fechaInicial',
        ]);
        return Excel::download(new ContratistasAltasBajas($input['fechaInicial'],$input['fechaFinal']), 'contratistasAltasBajas.xlsx');
        
    }

}
