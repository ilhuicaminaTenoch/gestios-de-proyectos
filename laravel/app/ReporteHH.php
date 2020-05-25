<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReporteHH extends Model
{
    protected $table='reportehh';

    protected $primaryKey="id";

    public $timestamps=false;

    protected $fillable=[
        'empresa',
    	'horashombre',
    	'minhombre',
        'personas'    
    ];

    protected $guarded=[
    ];
}
