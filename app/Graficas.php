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

    public function columChart(array $data){
        $newArray = [];
        foreach($data as $datum){
            $key = ucwords(strtolower($datum['compania']));
            $newArray[$key] = $datum['nocontratistas'];
        }
        return $newArray;
    }
   
}