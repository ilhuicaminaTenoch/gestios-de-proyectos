<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $table='registros';

    protected $primaryKey="id_registro";

    public $timestamps=false;

    protected $fillable=[
        'id_contratista',
        'fecha'
    ];
}
