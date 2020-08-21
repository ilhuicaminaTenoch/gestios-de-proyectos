<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Contratista;

class HabilidadesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        if ($request) {

            $query = trim($request->get('searchText'));

            //$Contratistas = DB::select('call obtiene_busqueda_QR_Habilidades(?)', array($query));
            
            $Contratistas = DB::table('contratistas as a')
                ->join('empresas as b', 'a.id_compania', '=', 'b.id_compania')
                ->join('puestos as c', 'a.id_puesto', '=', 'c.id_puesto')
                ->select('a.id_contratista', 'a.nombre', 'b.compania', 'b.id_compania', 'c.puesto', 'c.id_puesto', 'a.tipo', 'a.nss', 'a.activo')
                ->where('a.nombre', 'LIKE', '%' . $query . '%')
                ->where('a.activo','=',1)
                ->orderBy('id_contratista', 'asc')
                ->paginate(7);

             return view('Codigos.QR.index', [
                "Contratistas" => $Contratistas,
                "searchText" => $query
            ]);


        }
    }

    public function Buscar($id)
    {

        $Contratistas = Contratista::findOrFail($id);
        $Habilidades = DB::select('call obtiene_QR_Habilidades(?)', array($id));
            
        
         $pdf = \PDF::loadView('pdf_downloadH', [
                'Habilidades' => $Habilidades
            ])->setPaper('a4', 'landscape');

            return $pdf->download('Habilidades.pdf');
    }

    public function pdfDownloadH(Request $request)
    {
        $Contratistas=Contratista::findOrFail($id);
        $Habilidades = DB::select('call obtiene_QR_Habilidades(?)', array($id));

                 $pdf = \PDF::loadView('pdf_downloadH', [
                'Habilidades' => $Habilidades
            ])->setPaper('a4', 'landscape');

            return $pdf->download('Habilidades.pdf');
    }
}
