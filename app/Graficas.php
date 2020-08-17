<?php 
namespace App;

class Graficas
{

    public function pieChart(array $dataCharts){
        $newArray = [];
        foreach($dataCharts as $datumChart){
            $key = "Tipo {$datumChart['tipo']}";
            $newArray[$key] = $datumChart['nocontratistas'];
        }
        return $newArray;
    }
   
}