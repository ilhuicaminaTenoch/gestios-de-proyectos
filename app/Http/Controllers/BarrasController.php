<?php

namespace App\Http\Controllers;






use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarrasController extends Controller
{
    public function index(Request $request)
    {
    	if ($request){



            $Contratistas=DB::table('contratistas as a')
            ->join('empresas as b','a.id_compania','=','b.id_compania')
            ->join('puestos as c','a.id_puesto','=','c.id_puesto')
            ->select('a.id_contratista','a.nombre','b.compania','b.id_compania','c.puesto','c.id_puesto','a.tipo', 'a.RFC','a.activo')
            ->orderBy('id_contratista','asc')
            ->paginate(7);
            return view('Codigos.Barras.index',["Contratistas"=>$Contratistas]);

    	}
    }

    public function pdfDownload(){
        $Contratistas=DB::table('contratistas as a')
            ->join('empresas as b','a.id_compania','=','b.id_compania')
            ->join('puestos as c','a.id_puesto','=','c.id_puesto')
            ->select('a.id_contratista','a.nombre','b.compania','b.id_compania','c.puesto','c.id_puesto','a.tipo', 'a.RFC','a.activo')
            ->orderBy('id_contratista','asc')
            ->get();
        $pdf = \PDF::loadView('pdf_download', ['contratistas'=>$Contratistas])
            ->setPaper('a4', 'landscape');

        return $pdf->download('contratistas.pdf');
    }
}
