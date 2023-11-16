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
        $table->string('votantemesa')->nullable();;
        $table->string('facultadmesa')->nullable();;
        $table->string('carreramesa')->nullable();;
        $table->string('ubicacionmesa')->nullable();;
        $table->string('numerodevotantes')->nullable();;
        $table->string('votantesenmesa')->nullable();;
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
