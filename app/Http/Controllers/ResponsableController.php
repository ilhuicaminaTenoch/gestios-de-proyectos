<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResponsableFormRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Responsable;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use DB;


class ResponsableController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

     public function index(Request $request)
    {
             if ($request) {
			$query=trim($request->get('searchText'));
			$Responsable=DB::table('responsables')->where('responsable','LIKE','%'.$query.'%')
			->where('activo','=',1)
			->orderBy('id_responsable','asc')
			->paginate(7);
			return view('Catalogos.Cat_Responsables.index',["Responsable"=>$Responsable,"searchText"=>$query]);
    	}
    }

    public function create()
    {
    	return view("Catalogos.Cat_Responsables.create");
    }

    public function store(ResponsableFormRequest $request)
    {
        $Responsable= new Responsable;
        $Responsable->responsable=$request->get('responsable');
        $Responsable->activo='1';
        $Responsable->save();

        return Redirect::to('Catalogos/Cat_Responsables');
    }

	public function edit($id)
    {
        return view("Catalogos.Cat_Responsables.edit",["Responsable"=>Responsable::findOrFail($id)]);
    }

    public function update(ResponsableFormRequest $request, $id)
    {
        $Responsable=Responsable::findOrFail($id);
        $Responsable->responsable=$request->get('responsable');
        
        $Responsable->update();

        return Redirect::to('Catalogos/Cat_Responsables');

    }

    public function destroy($id)
    {
        $Responsable=Responsable::findOrFail($id);
        $Responsable->activo='0';
        $Responsable->update();
    
        return Redirect::to('Catalogos/Cat_Responsables');
    }



}
