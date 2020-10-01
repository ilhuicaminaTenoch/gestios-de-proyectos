<?php

namespace App\Http\Controllers;

use App\Gestion;
use App\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GestionController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Gestion.BarCode.index', ['type' => 'register']);
    }

    public function test()
    {
        return view('Gestion.BarCode.index', ['type' => 'test']);
    }

    public function searchBarCode(Request $request){
        if (!$request->ajax()) return redirect('/');

        $name = $request->name;
        $persons = Gestion::join('contratistas', 'contratistas.id_contratista', '=', 'gestion.id_contratista')
            ->select('contratistas.nombre', 'gestion.induccion', 'gestion.examen_medico', 'gestion.diciembre', 'gestion.febrero',
                'gestion.abril', 'gestion.junio', 'gestion.agosto','gestion.octubre', 'gestion.id_contratista', 'gestion.id_gestion',
                'contratistas.suspendido', 'contratistas.fechaISuspencion', 'contratistas.fechaFSuspencion')
            ->where([
                ['contratistas.nombre', '=', $name],
                ['contratistas.activo', '=', 1]
            ])->get();

        return [ 'persons' => $persons];
    }

    public function register(Request $request){
        if (!$request->ajax()) {
            return redirect('/');
        }
        $resultado = 'resultado';
        $method = $request->controllerMethod;
        if ($method == 'register'){
            DB::statement('CALL sp_ingresa_registros(?, ?, @resultado)',[$request->id_contratista, $request->bandera, $resultado] );
        }else{
            DB::statement('CALL sp_ingresa_registros_prueba(?, ?, @resultado)',[$request->id_contratista, $request->bandera, $resultado] );
        }
        return DB::select('select @resultado as resultado');
    }
}
