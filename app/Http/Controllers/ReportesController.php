<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportesController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

     public function index(Request $request)
    {
             if ($request) {
			
			return view('Reportes.HorasHombre.index');
    	}
    }

}
