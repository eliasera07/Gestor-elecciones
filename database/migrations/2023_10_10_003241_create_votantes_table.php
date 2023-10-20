<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votantes', function (Blueprint $table) {
            $table->id();
            $table->integer('ideleccion');
            $table->string('nombres');
            $table->string('apellidoPaterno');
            $table->string('apellidoMaterno');
            $table->string('codSis');
            $table->string('CI');
            $table->string('tipoVotante');
            $table->string('carrera')->nullable();
            $table->string('profesion')->nullable();
            $table->string('cargoAdministrativo')->nullable();
            $table->string('facultad')->nullable();
            $table->string('celular');
            $table->string('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votantes');
    }
}