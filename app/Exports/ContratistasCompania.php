<?php

namespace App\Exports;

use App\ReporteHH;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;



use DB;
class ContratistasCompania implements FromCollection,WithHeadings,WithTitle
{
    protected $fechaInicial;
    protected $fechaFinal;
    protected $compania;
    protected $tipo;

    public function __construct($fechaInicial, $fechaFinal, $compania, $tipo){
        $this->fechaInicial = $fechaInicial;
        $this->fechaFinal = $fechaFinal;
        $this->compania = $compania;
        $this->tipo = $tipo;
    }
    public function title(): string
    {

        return 'Reporte Contratistas Compania';
    }

    public function headings(): array
    {
        return [
            'Compania',
            'Tipo',
            'Contratista',
            'Fecha inicial',
            'Fecha final',
        ];
    }
    public function collection()
    {
       $data = collect(DB::select('call sp_reporte_horariosC(?,?,?,?)' ,[$this->fechaInicial, $this->fechaFinal, $this->compania, $this->tipo]));
       if(count($data) > 0) return $data;
    }
}
