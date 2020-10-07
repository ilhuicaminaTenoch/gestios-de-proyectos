<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpresaFormRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Empresa;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use DB;

class EmpresaController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
     public function index(Request $request)
    {
             if ($request) {
			$query=trim($request->get('searchText'));
			$Compania=DB::table('empresas as a')
			->leftjoin('giros as b', 'a.id_giro', '=', 'b.id_giro')
			->leftjoin('responsables as c', 'a.id_responsable', '=', 'c.id_responsable')
			->leftjoin('proyectos as d', 'a.id_proyecto', '=', 'd.id_proyecto')
			->leftjoin('areas as e', 'a.id_area', '=', 'e.id_area')
			->select('a.id_compania',  'a.compania', 'b.id_giro', 'b.giro', 'c.id_responsable', 'c.responsable', 'd.id_proyecto', 'd.proyecto','e.id_area','e.area','a.activo')
			->where('a.compania','LIKE','%'.$query.'%')
			->where('a.activo','=',1)
			->orderBy('a.id_compania','asc')
			->paginate(7);
			return view('Catalogos.Cat_Empresas.index',["Compania"=>$Compania,"searchText"=>$query]);
    	}
    }

 public function create()
    {
    	$Giro = DB::table('giros')->where('activo', '=', '1')->get();
        $Responsable = DB::table('responsables')->where('activo', '=', '1')->get();
        $Proyecto = DB::table('proyectos')->where('activo', '=', '1')->get();
        $Area = DB::table('areas')->where('activo', '=', '1')->get();


    	return view("Catalogos.Cat_Empresas.create",["Giro" => $Giro, "Responsable" => $Responsable,"Proyecto" => $Proyecto,"Area" => $Area]);
    }

    public function store(EmpresaFormRequest $request)
    {
        $Compania= new Empresa;
        $Compania->compania=$request->get('compania');
        $Compania->id_giro = $request->id_giro;
        $Compania->id_responsable = $request->id_responsable;
        $Compania->id_proyecto = $request->id_proyecto;
        $Compania->id_area = $request->id_area;
        $Compania->activo='1';
        $Compania->save();

        return Redirect::to('Catalogos/Cat_Empresas');
    }

        public function edit($id)
    {
    	$Compania = DB::table('empresas')
                        ->select(
                            'id_compania',
                            'compania',
                            'id_giro',
                            'id_responsable',
                            'id_proyecto',
                            'id_area',
                            'activo'
                            
                        )
                        ->where('id_compania', '=', $id)
                        ->get();
        $Giro = DB::table('giros')->where('activo', '=', '1')->get();
        $Responsable = DB::table('responsables')->where('activo', '=', '1')->get();
        $Proyecto = DB::table('proyectos')->where('activo', '=', '1')->get();
        $Area = DB::table('areas')->where('activo', '=', '1')->get();
        
        return view("Catalogos.Cat_Empresas.edit",["Compania" => $Compania, "Giro" => $Giro, "Responsable" => $Responsable,"Proyecto" => $Proyecto,"Area" => $Area]);
    }

    public function update(EmpresaFormRequest $request, $id)
    {
        $Compania=Empresa::findOrFail($id);
        $Compania->compania=$request->get('compania');
        $Compania->id_giro=$request->get('id_giro');
        $Compania->id_responsable=$request->get('id_responsable');
        $Compania->id_proyecto=$request->get('id_proyecto');
        $Compania->id_area=$request->get('id_area');
        
        $Compania->update();

        return Redirect::to('Catalogos/Cat_Empresas');

    }

     public function destroy($id)
    {
        $Compania=Empresa::findOrFail($id);
        $Compania->activo='0';
        $Compania->update();
    
        return Redirect::to('Catalogos/Cat_Empresas');
    }
}
