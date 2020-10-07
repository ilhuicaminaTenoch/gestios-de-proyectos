<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
     protected $table='empresas';

    protected $primaryKey="id_compania";

    public $timestamps=false;

    protected $fillable=[
    	
    	'compania',
    	'activo',
    	'id_giro',
    	'id_responsable',
    	'id_proyecto',
    	'id_area'

    ];
}
