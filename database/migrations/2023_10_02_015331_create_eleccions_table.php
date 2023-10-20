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
            $table->binary('convocatoria')->nullable();
            $table->date('fecha');
            $table->date('fechainscripcion');
            $table->string('tipodeeleccion');
            $table->text('descripcion');
            $table->boolean('estado');
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