<?php
// database/factories/ComiteFactory.php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comite;
use Faker\Generator as Faker;

$factory->define(Comite::class, function (Faker $faker) {
    return [
        'id_eleccion' => $faker->numberBetween(1, 10), // Ajusta según tus necesidades
        'nombreMiembro' => $faker->firstName,
        'apellidoPaterno' => $faker->lastName,
        'apellidoMaterno' => $faker->lastName,
        'CI' => $faker->unique()->numberBetween(1000000, 9999999),
        'cargoComite' => $faker->word, // Puedes ajustar según tus necesidades
        'profesion' => $faker->word, // Puedes ajustar según tus necesidades
        'cargoUMSS' => $faker->word, // Puedes ajustar según tus necesidades
        'estado' => 1,
    ];
});
