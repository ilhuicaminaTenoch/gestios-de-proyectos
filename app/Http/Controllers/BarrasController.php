<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarrasController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {

    	if ($request){

            $query=trim($request->get('searchText'));

            $Contratistas=DB::table('contratistas as a')
            ->join('empresas as b','a.id_compania','=','b.id_compania')
            ->join('puestos as c','a.id_puesto','=','c.id_puesto')
            ->select('a.id_contratista','a.nombre','b.compania','b.id_compania','c.puesto','c.id_puesto','a.tipo', 'a.RFC','a.activo')
            ->orderBy('id_contratista','asc')
            ->where('a.nombre','LIKE','%'.$query.'%')
            ->paginate(7);
            // $id=strval($Contratistas->id_contratista);
            // dd($id); //die();
            return view('Codigos.Barras.index',["Contratistas"=>$Contratistas,"searchText"=>$query]);
            
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
