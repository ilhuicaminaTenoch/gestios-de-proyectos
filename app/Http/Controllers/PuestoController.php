<?php

namespace App\Http\Controllers;

use App\Http\Requests\PuestoFormRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Puesto;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use DB;

class PuestoController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
             if ($request) {
			$query=trim($request->get('searchText'));
			$Puesto=DB::table('puestos')->where('puesto','LIKE','%'.$query.'%')
            ->where('activo','=',1)
			->orderBy('id_puesto','asc')
			->paginate(7);
			return view('Catalogos.Cat_Puestos.index',["Puesto"=>$Puesto,"searchText"=>$query]);
    	}
    }

     public function create()
    {
    	return view("Catalogos.Cat_Puestos.create");
    }

    public function store(PuestoFormRequest $request)
    {
        $Puesto= new Puesto;
        $Puesto->puesto=$request->get('puesto');
        $Puesto->activo='1';
        $Puesto->save();

        return Redirect::to('Catalogos/Cat_Puestos');
    }
    public function edit($id)
    {
        return view("Catalogos.Cat_Puestos.edit",["Puesto"=>Puesto::findOrFail($id)]);
    }

    public function update(PuestoFormRequest $request, $id)
    {
        $Puesto=Puesto::findOrFail($id);
        $Puesto->puesto=$request->get('puesto');
        
        $Puesto->update();

        return Redirect::to('Catalogos/Cat_Puestos');

    }

     public function destroy($id)
    {
        
        $Puesto=Puesto::findOrFail($id);
        $Puesto->activo='0';
        $Puesto->update();
        return Redirect::to('Catalogos/Cat_Puestos');
    }
}
