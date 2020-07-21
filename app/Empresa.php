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
    	'activo'
    ];
}
