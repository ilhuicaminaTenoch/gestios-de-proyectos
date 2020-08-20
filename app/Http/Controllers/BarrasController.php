<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Empresa;
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
            $Compania=DB::table('empresas')->where('compania','LIKE','%'.$query.'%')
            ->where('activo','=',1)            
            ->orderBy('id_compania','asc')
            ->paginate(7);
             //die();
            return view('Codigos.Barras.index',["Compania"=>$Compania,"searchText"=>$query]);
            
    	}
    }

public function Buscar($id){

    $Empresa = Empresa::findOrFail($id);

            //dd($Empresa);
    $Contratistas=DB::select('call sp_obtiene_codigos_accesos(?)', [$id]);
    
		$pdf = \PDF::loadView('pdf_download', ['contratistas'=>$Contratistas])
    ->setPaper('a4', 'landscape');

    return $pdf->download('contratistas.pdf');
    

            
}

    public function pdfDownload($id){
            // $Contratistas=DB::table('contratistas as a')
            // ->join('empresas as b','a.id_compania','=','b.id_compania')
            // ->join('puestos as c','a.id_puesto','=','c.id_puesto')
            // ->select('a.id_contratista','a.nombre','b.compania','b.id_compania','c.puesto','c.id_puesto','a.tipo', 'a.RFC','a.activo')
            // ->where('a.nombre','LIKE','%'.$query.'%')
            // ->orderBy('id_contratista','asc')
            // ->get();

            // dd($query);
            // dd($Contratistas);
        
        
        // $pdf = \PDF::loadView('pdf_download', ['contratistas'=>$Contratistas])
        //     ->setPaper('a4', 'landscape');

        // return $pdf->download('contratistas.pdf');
    }
}
