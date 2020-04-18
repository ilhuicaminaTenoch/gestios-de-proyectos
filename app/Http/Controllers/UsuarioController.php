<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioFormRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use DB;


class UsuarioController extends Controller
{
    public function index(Request $request)
    {
            if ($request) {
			$query=trim($request->get('searchText'));
			$usuarios=DB::table('users')->where('name','LIKE','%'.$query.'%')
			->orderBy('id','asc')
			->paginate(7);
			return view('Catalogos.Cat_Usuarios.index',["usuarios"=>$usuarios,"searchText"=>$query]);
		}
    }
    public function create()
    {
    	$perfiles=DB::table('perfiles')->where('activo','=','1')->get();
    	return view("Catalogos.Cat_Usuarios.create",["perfiles"=>$perfiles]);
    }

     public function store(UsuarioFormRequest $request)
    {
    	$usuarios= new User;
    	$usuarios->name=$request->get('name');
    	$usuarios->email=$request->get('email');
    	$usuarios->id_perfil=$request->get('id_perfil');
    	$usuarios->password=bcrypt($request->get('password'));
    	$usuarios->save();

    	return Redirect::to('Catalogos/Cat_Usuarios');
    }

    public function edit($id)
    {
    	$usuarios=User::findOrFail($id);
    	$perfiles=DB::table('perfiles')->where('activo','=','1')->get();
    	return view("Catalogos.Cat_Usuarios.edit",["usuarios"=>$usuarios, "perfiles"=>$perfiles]);
    	
    }

    public function update(UsuarioFormRequest $request, $id)
    {
    	$usuarios=User::findOrFail($id);
    	$usuarios->name=$request->get('name');
    	$usuarios->email=$request->get('email');
    	$usuarios->id_perfil=$request->get('id_perfil');
    	$usuarios->password=bcrypt($request->get('password'));
    	$usuarios->update();
    	

    	return Redirect::to('Catalogos/Cat_Usuarios');

    }

     public function destroy($id)
    {
    	$usuarios=DB::table('users')->where('id','=',$id)->delete();
    	return Redirect::to('Catalogos/Cat_Usuarios');
    }
}
