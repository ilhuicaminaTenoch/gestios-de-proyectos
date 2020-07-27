<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utilities extends Model
{
    public function decodeVars(string $variables)
    {
        $data = base64_decode($variables);
        $parametros = explode('&', $data);
        foreach($parametros as $llave => $parametro){
           $separaVariables = explode('=', $parametro);
           $nuevoArray[$separaVariables[0]] =  $separaVariables[1];
        }
        return $nuevoArray;
    }

}
