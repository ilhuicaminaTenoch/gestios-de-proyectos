<?php

namespace App\Exports;

use App\ReporteHH;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


use DB;
class ContratistasExport implements FromCollection,WithHeadings
{
    public function headings(): array
    {
        return [
            
            'Compañias',
            'HorasHombre',
            'No. Personas',
        ];
    }
    public function collection()
    {
    	 
         $ReporteHH = DB::table('reportehh')->select('empresa','horashombre','personas')->get();
         return $ReporteHH;
        
    }
}
