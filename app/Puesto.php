<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    protected $table='puestos';

    protected $primaryKey="id_puesto";

    public $timestamps=false;

    protected $fillable=[
    	
    	'puesto',
    	'activo'
    ];
}
