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
        return view('Gestion.BarCode.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function searchBarCode(Request $request){
        if (!$request->ajax()) return redirect('/');

        $idContratista = $request->id;
        $persons = Gestion::join('contratistas', 'contratistas.id_contratista', '=', 'gestion.id_contratista')
            ->select('contratistas.nombre', 'gestion.induccion', 'gestion.examen_medico', 'gestion.diciembre', 'gestion.febrero',
                'gestion.abril', 'gestion.junio', 'gestion.agosto', 'gestion.id_contratista', 'gestion.id_gestion')
            ->where('gestion.id_contratista', $idContratista)->get();

        return [ 'persons' => $persons];
    }

    public function register(Request $request){
        if (!$request->ajax()) return redirect('/');
        $contratistas = new Registro();
        $contratistas->id_contratista = $request->id_contratista;
        $contratistas->fecha = $request->fecha;
        $contratistas->save();
    }
}
