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
        $table->string('votantemesa');
        $table->string('facultadmesa');
        $table->string('carreramesa');
        $table->string('ubicacionmesa');
        $table->string('numerodevotantes');
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
