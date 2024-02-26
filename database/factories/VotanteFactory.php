<?php
// database/factories/VotanteFactory.php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Votante;
use Faker\Generator as Faker;

$factory->define(Votante::class, function (Faker $faker) {
    return [
        'ideleccion' => $faker->numberBetween(1, 10), // Ajusta según tus necesidades
        'nombres' => $faker->firstName,
        'apellidoPaterno' => $faker->lastName,
        'apellidoMaterno' => $faker->lastName,
        'codSis' => $faker->unique()->numberBetween(100000, 999999),
        'CI' => $faker->unique()->numberBetween(1000000, 9999999),
        'tipoVotante' => $faker->randomElement(['Regular', 'Delegado']),
        'carrera' => $faker->word, // Puedes ajustar según tus necesidades
        'profesion' => $faker->word, // Puedes ajustar según tus necesidades
        'cargoAdministrativo' => $faker->word, // Puedes ajustar según tus necesidades
        'facultad' => $faker->word, // Puedes ajustar según tus necesidades
        'celular' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'estado' => 1,
    ];
});
