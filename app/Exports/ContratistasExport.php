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
    protected $agrupacion;
    
    public function __construct($fechaInicialP, $fechaFinalP, $agrupacion){
        $this->fechaInicial = $this->separateDate($fechaInicialP);
        $this->fechaFinal = $this->separateDate($fechaFinalP);
        $this->agrupacion = $agrupacion;
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
       $fe = $this->fechaInicial;
       $fs = $this->fechaFinal;
       $data = collect(DB::select('call sp_reporte_horas_hombre_dos(?,?,?,?,?)' ,[$fe['date'], $fs['date'], $fe['time'], $fs['time'], $this->agrupacion]));
       if(count($data) > 0) return $data;   
    }

    private function separateDate(string $fecha){
        $separate = explode('T', $fecha);
        $date = $separate[0];
        $time = $separate[1].':00';
        return ['date' => $date, 'time' => $time];
    }
}
