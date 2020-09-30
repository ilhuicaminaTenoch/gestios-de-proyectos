<?php

namespace App\Http\Controllers;

use App\Http\Requests\AreaFormRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Area;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use DB;

class AreaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

     public function index(Request $request)
    {
             if ($request) {
			$query=trim($request->get('searchText'));
			$Area=DB::table('areas')->where('area','LIKE','%'.$query.'%')
			->where('activo','=',1)
			->orderBy('id_area','asc')
			->paginate(7);
			return view('Catalogos.Cat_Areas.index',["Area"=>$Area,"searchText"=>$query]);
    	}
    }

    public function create()
    {
    	return view("Catalogos.Cat_Areas.create");
    }

    public function store(AreaFormRequest $request)
    {
        $Area= new Area;
        $Area->area=$request->get('area');
        $Area->activo='1';
        $Area->save();

        return Redirect::to('Catalogos/Cat_Areas');
    }

	public function edit($id)
    {
        return view("Catalogos.Cat_Areas.edit",["Area"=>Area::findOrFail($id)]);
    }

	public function update(AreaFormRequest $request, $id)
    {
        $Area=Area::findOrFail($id);
        $Area->area=$request->get('area');
        
        $Area->update();

        return Redirect::to('Catalogos/Cat_Areas');

    }

    public function destroy($id)
    {
        $Area=Area::findOrFail($id);
        $Area->activo='0';
        $Area->update();
    
        return Redirect::to('Catalogos/Cat_Areas');
    }

}
