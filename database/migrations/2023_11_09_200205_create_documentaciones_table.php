<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentaciones', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->integer('idEleccionD');
            $table->string('tipodedocumento');
            $table->string('pdf');
            $table->date('inicio')->nullable();
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
        Schema::dropIfExists('documentaciones');
    }
}