<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Empresa;

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

            $Contratistas = DB::table('contratistas as a')
                ->join('empresas as b', 'a.id_compania', '=', 'b.id_compania')
                ->join('puestos as c', 'a.id_puesto', '=', 'c.id_puesto')
                ->select('a.id_contratista', 'a.nombre', 'b.compania', 'b.id_compania', 'c.puesto', 'c.id_puesto', 'a.tipo', 'a.nss', 'a.codigo', 'a.activo')
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
        $Contratistas=Contratistas::findOrFail($id);

        //$Empresa = Empresa::findOrFail($id);

        $consulta = DB::select('call obtiene_QR_Habilidades(?)', array(
            $id
        ));

        $data = ['datum' => $consulta];
        $pdf = PDF::loadView('pdfs.myPDF', $data);
        return $pdf->download($nombrePdf); 
        // $data = DB::select('exec obtiene_QR_Habilidades(?)', array($id));
        // $Habilidades = DB::table('vistahabilidades')->select('id_contratista', 'nombre', 'QR', 'compania')
        //     ->orderBy('id_contratista', 'asc')
        //     ->where('id_compania', '=', $id)
        //     ->get();

        // $resultados = DB::table('vistahabilidades')->count();

        // if ($resultados > 1) {
        //     $pdf = \PDF::loadView('pdf_downloadH', [
        //         'Habilidades' => $Habilidades
        //     ])->setPaper('a4', 'landscape');

        //     return $pdf->download('Habilidades.pdf');
        // } else {
        //     return view("Codigos.QR.mensaje", [
        //         "errores" => "No hay registros que exportar"
        //     ]);
        // }
    }

    public function pdfDownloadH()
    {
        $Habilidades = DB::table('vw_habilidades')->select('id_contratista', 'nombre', 'QR')
            ->orderBy('id_contratista', 'asc')
            ->where('id_compania', '=', 3)
            ->get();
        $pdf = \PDF::loadView('pdf_downloadH', [
            'Habilidades' => $Habilidades
        ])->setPaper('a4', 'landscape');

        return $pdf->download('Habilidades.pdf');
    }
}
