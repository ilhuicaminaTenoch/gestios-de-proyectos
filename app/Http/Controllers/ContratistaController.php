<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContratistaFormRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Contratista;


use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Milon\Barcode\DNS1D;

use App\Exports\ContratistasExport;
use Maatwebsite\Excel\Facades\Excel;

use DB;
use Milon\Barcode\DNS2D;

class ContratistaController extends Controller
{
    public function index(Request $request)
    {
        if ($request) {

            $query = trim($request->get('searchText'));

            $Contratistas = DB::table('contratistas as a')
                ->join('empresas as b', 'a.id_compania', '=', 'b.id_compania')
                ->join('puestos as c', 'a.id_puesto', '=', 'c.id_puesto')
                ->select('a.id_contratista', 'a.nombre', 'b.compania', 'b.id_compania', 'c.puesto', 'c.id_puesto', 'a.tipo', 'a.RFC', 'a.codigo', 'a.activo')
                ->where('a.nombre', 'LIKE', '%' . $query . '%')
                ->orderBy('id_contratista', 'asc')
                ->paginate(7);

            return view('Catalogos.Cat_Contratistas.index', ["Contratistas" => $Contratistas, "searchText" => $query]);

        }
    }

    public function create()
    {
        $Compania = DB::table('empresas')->where('activo', '=', '1')->get();
        $Puesto = DB::table('puestos')->where('activo', '=', '1')->get();

        return view("Catalogos.Cat_Contratistas.create", ["Compania" => $Compania, "Puesto" => $Puesto]);
    }

    public function store(Request $request)
    {
        $barra = new DNS2D();

        $Contratistas = new Contratista();
        //$Contratistas = $barra->getBarcodeSVG("prueba", "C128");
        //dd($Contratistas);
        //validando existencia
        $valida = DB::table('contratistas')->where([
            ['id_compania', '=', $request->post('id_compania')],
            ['id_puesto', '=', $request->post('id_puesto')],
            ['nombre', '=', $request->post('nombre')],
        ])->count();

        if ($valida == '0') {
            $idContratista = DB::getPdo()->lastInsertId();
            $Contratistas->nombre = $request->post('nombre');
            $Contratistas->id_compania = $request->post('id_compania');
            $Contratistas->id_puesto = $request->post('id_puesto');
            $Contratistas->tipo = $request->post('tipo');
            if ($request->get('RFC') == null)
                $Contratistas->RFC = 'Sin RFC';
            else
                $Contratistas->RFC = $request->get('RFC');

            $Contratistas->activo = '1';
            $Contratistas->codigo = $request->post('nombre');
            $Contratistas->save();

            return Redirect::to('Catalogos/Cat_Contratistas');
        } else {
            return view("Catalogos.Cat_Contratistas.error", ["errores" => "El proyecto ya tiene registrado el contratista"]);

        }


    }

    public function edit($id)
    {
        $Contratistas = Contratista::findOrFail($id);
        //dd($Contratistas);
        $Compania = DB::table('empresas')->where('activo', '=', '1')->get();
        $Puesto = DB::table('puestos')->where('activo', '=', '1')->get();
        return view("Catalogos.Cat_Contratistas.edit", ["Contratistas" => $Contratistas, "Compania" => $Compania, "Puesto" => $Puesto]);

    }

    public function update(Request $request, $id)
    {
        $Contratistas = Contratista::findOrFail($id);

        $Contratistas->nombre = $request->get('nombre');
        $Contratistas->id_compania = $request->get('id_compania');
        $Contratistas->id_puesto = $request->get('id_puesto');
        $Contratistas->tipo = $request->get('tipo');
        $Contratistas->RFC = $request->get('RFC');
        $Contratistas->activo = '1';
        $Contratistas->update();

        return Redirect::to('Catalogos/Cat_Contratistas');

    }

    // public function show($id)
    // {
    //     $Contratistas=Contratista::findOrFail($id);
    //     return view("Catalogos.Cat_Contratistas.show",["Contratistas"=>Contratista::findOrFail($id)]);
    // }
    public function destroy($id)
    {
        $Contratistas = Contratista::findOrFail($id);
        $Contratistas->Activo = '0';
        $Contratistas->update();

        return Redirect::to('Catalogos/Cat_Contratistas');
    }

    public function agregarH($id)
    {
        $Contratistas = Contratista::findOrFail($id);
        $HamilidaDES = DB::table('gestion as a')
            ->join('contratistas as b', 'a.id_contratista', '=', 'b.id_contratista')
            ->select('a.id_contratista', 'a.id_gestion', 'a.induccion', 'a.examen_medico', 'a.diciembre', 'a.febrero', 'a.abril', 'a.junio', 'a.agosto', 'a.octubre', 'a.alturas', 'a.armado_a', 'a.plataforma_e', 'a.gruas_i', 'a.montacargas', 'a.equipo_aux', 'a.maquinaria_p', 'a.e_confinados', 'a.t_caliente', 'a.t_electricos', 'a.loto', 'a.apertura_I', 'a.amoniaco', 'a.quimicos', 'a.temperatura_e', 'a.temperatura_a')
            ->where('a.id_contratista', '=', 'b.id_contratista')
            ->orderBy('id_contratista', 'asc');

        return view("Catalogos.Cat_Contratistas.agregarH", ["Contratistas" => $Contratistas]);

    }

    public function updateHabilidad(Request $request, $id)
    {
        $Contratistas = Contratista::findOrFail($id);

        $Contratistas->nombre = $request->get('nombre');
        $Contratistas->id_compania = $request->get('id_compania');
        $Contratistas->id_puesto = $request->get('id_puesto');
        $Contratistas->tipo = $request->get('tipo');
        $Contratistas->RFC = $request->get('RFC');
        $Contratistas->activo = '1';
        $Contratistas->update();

        return Redirect::to('Catalogos/Cat_Contratistas');

    }
}
