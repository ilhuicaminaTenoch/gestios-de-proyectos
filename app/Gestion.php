<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gestion extends Model
{
    public $table = 'gestion';
    public $fillable = [
        'id_contratista',
        'induccion',
        'examen_medico',
        'febrero',
        'abril',
        'junio',
        'agosto',
        'octubre',
        'alturas',
        'armado_a',
        'plataforma_e',
        'gruas_i',
        'montacargas',
        'equipo_aux',
        'maquinaria_p',
        'e_confinados',
        't_caliente',
        't_electricos',
        'loto',
        'apertura_l',
        'amoniaco',
        'quimicos',
        'temperatura_e',
        'temperatura_a',

    ];
}
