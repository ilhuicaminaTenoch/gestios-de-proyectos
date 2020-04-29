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
        $mes=$request->post('mes');
        
        
        $Tipo=$request->post('tipo');
       // dd($Tipo);
        
        $data=DB::select('call sp_reporte_horashombre(?,?)' ,array($mes,$Tipo));
        
        $resultados=DB::table('reportehh')->count();
        //dd($resultados);
        if ($resultados>1) {
            return Excel::download(new ContratistasExport, 'HorasHombre.xlsx');
        }
        else
        {
            return view("Reportes.HorasHombre.mensaje", ["errores" => "La consulta no arrojo ningún resultado"]);

        }
        
    }

    public function principal(Request $request)
    {
        return view('Default.principal');
    }

}
