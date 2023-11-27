<?php

// database/factories/FrenteFactory.php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Frente;
use Faker\Generator as Faker;

$factory->define(Frente::class, function (Faker $faker) {
    return [
        'ideleccionfrente' => $faker->numberBetween(1, 10), // Ajusta según tus necesidades
        'nombrefrente' => $faker->word,
        'cargopostulacion' => $faker->word, // Puedes ajustar según tus necesidades
        'fotofrente' => $faker->imageUrl(), // Puedes ajustar según tus necesidades
        'nombrecandidato1' => $faker->name,
        'nombrecandidato2' => $faker->name, // Puedes ajustar según tus necesidades
        'nombrecandidato3' => $faker->name, // Puedes ajustar según tus necesidades
        'nombrecandidato4' => $faker->name, // Puedes ajustar según tus necesidades
        'estado' => 1,
    ];
});
