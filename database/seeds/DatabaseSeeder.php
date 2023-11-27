<?php

use Illuminate\Database\Seeder;
use App\Models\Comite;
use App\Models\Eleccion;
use App\Models\Frente;
use App\Models\Jurado;
use App\Models\Mesa;
use App\Models\Votante;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(Eleccion::class, 5)->create();
        factory(Votante::class, 1000)->create();
        factory(Comite::class, 50)->create();
        factory(Frente::class, 50)->create();
        //factory(Mesa::class, 100)->create();
        //factory(Jurado::class, 50)->create();
    }
}