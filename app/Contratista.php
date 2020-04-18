<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contratista extends Model
{
     protected $table='contratistas';

    protected $primaryKey="id_contratista";

    public $timestamps=false;

    protected $fillable=[
        'nombre',
    	'id_compania',
    	'id_puesto',
        'tipo',
        'RFC',
        'activo',
        'codigo'
    ];

    protected $guarded=[
    ];
}
