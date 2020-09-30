<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    protected $table='responsables';

    protected $primaryKey="id_responsable";

    public $timestamps=false;

    protected $fillable=[
    	
    	'responsable',
    	'activo'
    ];
}
