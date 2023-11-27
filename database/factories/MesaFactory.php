<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

// database/factories/MesaFactory.php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Mesa;
use Faker\Generator as Faker;

$factory->define(Mesa::class, function (Faker $faker) {
    return [
        'id_de_eleccion' => $faker->numberBetween(1, 10), // Ajusta según tus necesidades
        'numeromesa' => $faker->randomNumber(), // Puedes ajustar según tus necesidades
        'votantemesa' => $faker->word, // Puedes ajustar según tus necesidades
        'facultadmesa' => $faker->word, // Puedes ajustar según tus necesidades
        'carreramesa' => $faker->word, // Puedes ajustar según tus necesidades
        'ubicacionmesa' => $faker->sentence, // Puedes ajustar según tus necesidades
        'numerodevotantes' => $faker->randomNumber(), // Puedes ajustar según tus necesidades
        'votantesenmesa' => $faker->randomNumber(), // Puedes ajustar según tus necesidades
        'estadoR' => 1,
    ];
});
