<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Eleccion;
use Faker\Generator as Faker;

$factory->define(Eleccion::class, function (Faker $faker) {
    return [
        'nombre' => $faker->word,
        'motivo' => $faker->sentence,
        'cargodeautoridad' => $faker->word,
        'gestioninicio' => $faker->year,
        'gestionfin' => $faker->year,
        'tipodevotantes' => $faker->word,
        'facultad' => $faker->word,
        'carrera' => $faker->word,
        'convocatoria' => $faker->word,
        'fecha' => $faker->date,
        'fechainscripcion' => $faker->date,
        'tipodeeleccion' => $faker->word,
        'descripcion' => $faker->paragraph,
        'nombrefrente1' => $faker->word,
        'votosfrente1' => $faker->numberBetween(0, 100),
        'nombrefrente2' => $faker->word,
        'votosfrente2' => $faker->numberBetween(0, 100),
        'nombrefrente3' => $faker->word,
        'votosfrente3' => $faker->numberBetween(0, 100),
        'nombrefrente4' => $faker->word,
        'votosfrente4' => $faker->numberBetween(0, 100),
        'estadoRegistro' => 0,
        'estado' => 1,
    ];
});
