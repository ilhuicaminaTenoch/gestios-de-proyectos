<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Gestion::class, function (Faker $faker) {
    return [
        'id_contratista' => 1,
        'induccion' => $faker->dateTimeBetween('-1 years', '+ 1 days', 'UTC'),
        'examen_medico' => $faker->dateTimeBetween('-1 years', '+ 2 days', 'UTC'),
        'febrero' => $faker->boolean,
        'abril' => $faker->boolean(50),
        'junio' => $faker->boolean,
        'agosto' => $faker->boolean,
        'octubre' => $faker->boolean,
        'alturas' => $faker->dateTime(),
        'armado_a' => $faker->dateTimeBetween('-1 years', '+ 2 days', 'UTC'),
        'plataforma_e' => $faker->dateTimeBetween('-1 years', '+ 3 days', 'UTC'),
        'gruas_i' => $faker->dateTimeBetween('0 years', '+ 4 days', 'UTC'),
        'montacargas' => $faker->dateTimeBetween('-1 years', '+ 5 days', 'UTC'),
        'equipo_aux' => $faker->dateTimeBetween('-1 years', '+ 6 days', 'UTC'),
        'maquinaria_p' => $faker->dateTimeBetween('-1 years', '+ 2 days', 'UTC'),
        'e_confinados' => $faker->dateTimeBetween('-1 years', '+ 3 days', 'UTC'),
        't_caliente' => $faker->dateTimeBetween('-1 years', '+ 4 days', 'UTC'),
        't_electricos' => $faker->dateTimeBetween('-1 years', '+ 5 days', 'UTC'),
        'loto' => $faker->dateTimeBetween('-1 years', '+ 6 days', 'UTC'),
        'apertura_l' => $faker->dateTimeBetween('-1 years', '+ 7 days', 'UTC'),
        'amoniaco' => $faker->dateTimeBetween('-1 years', '+ 8 days', 'UTC'),
        'quimicos' => $faker->dateTimeBetween('-1 years', '+ 9 days', 'UTC'),
        'temperatura_e' => $faker->dateTimeBetween('-1 years', '+ 10 days', 'UTC'),
        'temperatura_a' => $faker->dateTimeBetween('-1 years', '+ 5 days', 'UTC'),
    ];
});
