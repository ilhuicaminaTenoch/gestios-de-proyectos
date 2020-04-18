<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contratista;
use Faker\Generator as Faker;

$factory->define(Contratista::class, function (Faker $faker) {
    return [
        'id_contratista' => 1,
        'nombre' => $faker->name,
        'id_compania' => 1,
        'id_puesto' => 1,
        'tipo' => $faker->numberBetween(1,10),
        'RFC' => $faker->numerify('MOPM###'),
        'activo' => $faker->boolean,
        'codigo' => $faker->ean13,

    ];
});
