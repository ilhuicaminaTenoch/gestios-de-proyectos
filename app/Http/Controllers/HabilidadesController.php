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
            $Compania = DB::table('empresas')->where('compania', 'LIKE', '%' . $query . '%')
                ->where('activo', '=', 1)
                ->orderBy('id_compania', 'asc')
                ->paginate(7);
            // die();
            return view('Codigos.QR.index', [
                "Compania" => $Compania,
                "searchText" => $query
            ]);
        }
    }

    public function Buscar($id)
    {
        $Empresa = Empresa::findOrFail($id);

        // dd($Empresa);
        // $Habilidades =DB::table('vw_habilidades')
        // ->select('id_contratista','nombre','QR','compania')
        // ->orderBy('id_contratista','asc')
        // ->where('id_compania','=',$id)
        // ->get();
        $data = DB::statement('call obtiene_QR_Habilidades(?)', array(
            $id
        ));
        // $data = DB::select('exec obtiene_QR_Habilidades(?)', array($id));
        $Habilidades = DB::table('vistahabilidades')->select('id_contratista', 'nombre', 'QR', 'compania')
            ->orderBy('id_contratista', 'asc')
            ->where('id_compania', '=', $id)
            ->get();

        $resultados = DB::table('vistahabilidades')->count();

        if ($resultados > 1) {
            $pdf = \PDF::loadView('pdf_downloadH', [
                'Habilidades' => $Habilidades
            ])->setPaper('a4', 'landscape');

            return $pdf->download('Habilidades.pdf');
        } else {
            return view("Codigos.QR.mensaje", [
                "errores" => "No hay registros que exportar"
            ]);
        }
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
