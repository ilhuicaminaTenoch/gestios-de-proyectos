<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ContratistasExport;
use Illuminate\Http\Request;
use DB;

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
            'fechaFinal' => 'required|date',
        ]);

       
        return Excel::download(new ContratistasExport($input['fechaInicial'],$input['fechaFinal']), 'HorasHombre.xlsx');
        /*$data=DB::select('call sp_reporte_horas_hombre_dos(?,?)' ,array($input['fechaInicial'],$input['fechaFinal']));
        
        if ($cout > 1) {
            return Excel::download(new ContratistasExport, 'HorasHombre.xlsx');
        } else {
            return view("Reportes.HorasHombre.mensaje", ["errores" => "La consulta no arrojo ningún resultado"]);

        }*/

    }

    public function principal(Request $request)
    {
        return view('Default.principal');
    }

}
