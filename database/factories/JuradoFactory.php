<?php

// database/factories/JuradoFactory.php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Jurado;
use Faker\Generator as Faker;

$factory->define(Jurado::class, function (Faker $faker) {
    return [
        'iddeeleccion' => $faker->numberBetween(1, 10), // Ajusta según tus necesidades
        'idmesa' => $faker->numberBetween(1, 10), // Ajusta según tus necesidades
        'nombres' => $faker->firstName,
        'apellidoPaterno' => $faker->lastName,
        'apellidoMaterno' => $faker->lastName,
        'codSis' => $faker->word, // Puedes ajustar según tus necesidades
        'CI' => $faker->word, // Puedes ajustar según tus necesidades
        'tipojurado' => $faker->word, // Puedes ajustar según tus necesidades
        'estado' => 1,
    ];
});
