<?php

namespace App\Exports;

use App\ReporteHH;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;



use DB;
class ContratistasExport implements FromCollection,WithHeadings,WithTitle
{
    protected $fechaInicial;
    protected $fechaFinal;
    
    public function __construct($fechaInicialP, $fechaFinalP){
        $this->fechaInicial = $fechaInicialP;
        $this->fechaFinal = $fechaFinalP;
    }
    public function title(): string
    {

        return 'Reporte Contratistas';
    }

    public function headings(): array
    {
        return [
            'Empresa',
            'Tipo',
            'No. Personas',
            'Total_Horas_Hombre'
        ];
    }
    public function collection()
    { 
       $data = collect(DB::select('call sp_reporte_horas_hombre_dos(?,?)' ,[$this->fechaInicial, $this->fechaFinal]));
       if(count($data) > 0) return $data;   
    }
}
