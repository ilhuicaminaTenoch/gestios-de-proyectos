<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contratista extends Model
{
     protected $table='contratistas';

    protected $primaryKey="id_contratista";

    protected $fillable=[
        'nombre',
    	'id_compania',
    	'id_puesto',
        'tipo',
        'RFC',
        'activo',
        'codigo',
        'motivos',
        'suspendido',
        'fechaISuspencion',
        'fechaFSuspencion'
    ];

    protected $guarded=[
    ];
}
