<?php

namespace App\Exports;

use App\Contratista;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Milon\Barcode\DNS1D;
use DB;
class ContratistasExport implements FromCollection,WithHeadings
{
    public function headings(): array
    {
        return [
            
            'Nombre',
            'codigo',
        ];
    }
    public function collection()
    {
    	 $barra = new DNS1D();
         
         $Contratistas = DB::table('contratistas')->select('nombre','codigo')->get();
         return $Contratistas;
        
    }
}
