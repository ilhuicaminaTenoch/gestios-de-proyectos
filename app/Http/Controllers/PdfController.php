<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use PDF;
class PdfController extends Controller
{
    public function pdfForm()
    {
        return view('pdfForm');
    }

    public function pdfDownload(Request $request){

        request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $data =
            [
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message
            ];
        $pdf = PDF::loadView('pdf_download', $data);

        return $pdf->download('tutsmake.pdf');
    }
}
