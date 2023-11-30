<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('mesas', function (Blueprint $table) {
        
        $table->id();
        $table->integer('id_de_eleccion');
        $table->string('numeromesa')->nullable();
        $table->string('votantemesa')->nullable();
        $table->string('facultadmesa')->nullable();
        $table->string('carreramesa')->nullable();
        $table->string('ubicacionmesa')->nullable();
        $table->string('numerodevotantes')->nullable();
        $table->string('votantesenmesa')->nullable();
        $table->string('acta')->nullable();
        $table->string('nombrefrente1')->nullable();
        $table->integer('votosfrente1')->nullable();
        $table->string('nombrefrente2')->nullable();
        $table->integer('votosfrente2')->nullable();
        $table->string('nombrefrente3')->nullable();
        $table->integer('votosfrente3')->nullable();
        $table->string('nombrefrente4')->nullable();
        $table->integer('votosfrente4')->nullable();
        $table->integer('votosblancos')->nullable();
        $table->integer('votosnulos')->nullable();
        $table->boolean('estadoR')->default(1);
        $table->boolean('estadoMesa')->default(1);
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
        Schema::dropIfExists('mesas');
    }
}
