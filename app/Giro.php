<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Giro extends Model
{
    //protected $table='puestos';

    protected $primaryKey="id_giro";

    public $timestamps=false;

    protected $fillable=[
    	
    	'giro',
    	'activo'
    ];
}
