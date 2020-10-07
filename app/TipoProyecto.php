<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoProyecto extends Model
{
    protected $table='proyectos';

    protected $primaryKey="id_proyecto";

    public $timestamps=false;

    protected $fillable=[
    	
    	'proyecto',
    	'activo'
    ];
}
