<?php

namespace App\Http\Controllers;

use App\Http\Requests\GiroFormRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Giro;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use DB;

class GiroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
             if ($request) {
			$query=trim($request->get('searchText'));
			$Giro=DB::table('giros')->where('giro','LIKE','%'.$query.'%')
            ->where('activo','=',1)
			->orderBy('id_giro','asc')
			->paginate(7);
			return view('Catalogos.Cat_Giros.index',["Giro"=>$Giro,"searchText"=>$query]);
    	}
    }

     public function create()
    {
    	return view("Catalogos.Cat_Giros.create");
    }

    public function store(GiroFormRequest $request)
    {
        $Giro= new Giro;
        $Giro->giro=$request->get('giro');
        $Giro->activo='1';
        $Giro->save();

        return Redirect::to('Catalogos/Cat_Giros');
    }
    public function edit($id)
    {
        return view("Catalogos.Cat_Giros.edit",["Giro"=>Giro::findOrFail($id)]);
    }

    public function update(GiroFormRequest $request, $id)
    {
        $Giro=Giro::findOrFail($id);
        $Giro->giro=$request->get('giro');
        
        $Giro->update();

        return Redirect::to('Catalogos/Cat_Giros');

    }

     public function destroy($id)
    {
        
        $Giro=Giro::findOrFail($id);
        $Giro->activo='0';
        $Giro->update();
        return Redirect::to('Catalogos/Cat_Giros');
    }
}
