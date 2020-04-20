<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HabilidadesController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

    	if ($request){

            $query=trim($request->get('searchText'));

            $Habilidades =DB::table('vw_habilidades')
            ->select('id_contratista','nombre','QR')
            ->where('nombre','LIKE','%'.$query.'%')
            ->paginate(7);

             // dd($Habilidades); //die();
            return view('Codigos.QR.index',["Habilidades"=>$Habilidades,"searchText"=>$query]);
            
    	}
    }

    public function pdfDownloadH(){

        $Habilidades =DB::table('vw_habilidades')
            ->select('id_contratista','nombre','QR')
            ->orderBy('id_contratista','asc')
            ->get();
        $pdf = \PDF::loadView('pdf_downloadH', ['Habilidades'=>$Habilidades])
            ->setPaper('a4', 'landscape');

        return $pdf->download('Habilidades.pdf');
    }

}
