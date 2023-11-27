<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEleccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eleccions', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('motivo');
            $table->string('cargodeautoridad');
            $table->string('gestioninicio');
            $table->string('gestionfin');
            $table->string('tipodevotantes');
            $table->string('facultad')->nullable();
            $table->string('carrera')->nullable();
            $table->string('convocatoria')->nullable();
            $table->date('fecha');
            $table->date('fechainscripcion');
            $table->string('tipodeeleccion');
            $table->text('descripcion');
            $table->string('nombrefrente1')->nullable();
            $table->string('votosfrente1')->nullable();
            $table->string('nombrefrente2')->nullable();
            $table->string('votosfrente2')->nullable();
            $table->string('nombrefrente3')->nullable();
            $table->string('votosfrente3')->nullable();
            $table->string('nombrefrente4')->nullable();
            $table->string('votosfrente4')->nullable();
            $table->string('votosblancoselec')->nullable();
            $table->string('votosnuloselec')->nullable();
            $table->boolean('estadoRegistro');
            $table->boolean('estado')->default(1);
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
        Schema::dropIfExists('eleccions');
    }
}