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
			$Compania=DB::table('empresas')->where('compania','LIKE','%'.$query.'%')
			->where('activo','=',1)
			->orderBy('id_compania','asc')
			->paginate(7);
			return view('Catalogos.Cat_Empresas.index',["Compania"=>$Compania,"searchText"=>$query]);
    	}
    }

 public function create()
    {
    	return view("Catalogos.Cat_Empresas.create");
    }

    public function store(EmpresaFormRequest $request)
    {
        $Compania= new Empresa;
        $Compania->compania=$request->get('compania');
        $Compania->activo='1';
        $Compania->save();

        return Redirect::to('Catalogos/Cat_Empresas');
    }

        public function edit($id)
    {
        return view("Catalogos.Cat_Empresas.edit",["Compania"=>Empresa::findOrFail($id)]);
    }

    public function update(EmpresaFormRequest $request, $id)
    {
        $Compania=Empresa::findOrFail($id);
        $Compania->compania=$request->get('compania');
        
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
