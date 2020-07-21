<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habilidades extends Model
{
    protected $table='vw_habilidades';

    protected $primaryKey="id_contratista";

    public $timestamps=false;

    protected $fillable=[
        'nombre',
    	'QR'
    ];

    protected $guarded=[
    ];
}
