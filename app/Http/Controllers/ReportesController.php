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
        $fechaInicio=$request->post('FechaInicial');
        
        $fechaFin=$request->post('FechaFinal');
        $Tipo=$request->post('tipo');
        //dd($Tipo);
        $data=DB::select('call sp_reporte_horashombre(?,?,?)' ,array($fechaInicio,$fechaFin,$Tipo));

        return Excel::download(new ContratistasExport, 'HorasHombre.xlsx');
    }

}
