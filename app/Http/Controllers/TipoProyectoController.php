<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoProyectoFormRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\TipoProyecto;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use DB;

class TipoProyectoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
             if ($request) {
			$query=trim($request->get('searchText'));
			$Proyecto=DB::table('proyectos')->where('proyecto','LIKE','%'.$query.'%')
            ->where('activo','=',1)
			->orderBy('id_proyecto','asc')
			->paginate(7);
			return view('Catalogos.Cat_Tipo_Proyecto.index',["Proyecto"=>$Proyecto,"searchText"=>$query]);
    	}
    }

     public function create()
    {
    	return view("Catalogos.Cat_Tipo_Proyecto.create");
    }

    public function store(TipoProyectoFormRequest $request)
    {
        $Proyecto= new TipoProyecto;
        $Proyecto->proyecto=$request->get('proyecto');
        $Proyecto->activo='1';
        $Proyecto->save();

        return Redirect::to('Catalogos/Cat_Tipo_Proyecto');
    }
    public function edit($id)
    {
        return view("Catalogos.Cat_Tipo_Proyecto.edit",["Proyecto"=>TipoProyecto::findOrFail($id)]);
    }

    public function update(TipoProyectoFormRequest $request, $id)
    {
        $Proyecto=TipoProyecto::findOrFail($id);
        $Proyecto->proyecto=$request->get('proyecto');
        
        $Proyecto->update();

        return Redirect::to('Catalogos/Cat_Tipo_Proyecto');

    }

     public function destroy($id)
    {
        
        $Proyecto=TipoProyecto::findOrFail($id);
        $Proyecto->activo='0';
        $Proyecto->update();
        return Redirect::to('Catalogos/Cat_Tipo_Proyecto');
    }
}
