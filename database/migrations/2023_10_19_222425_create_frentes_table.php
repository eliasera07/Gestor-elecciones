<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frentes', function (Blueprint $table) {
            $table->id();
            $table->integer('ideleccionfrente');
            $table->string('nombrefrente');
            $table->string('cargopostulacion');
            $table->string('fotofrente');
            $table->string('nombrecandidato1');
            $table->string('nombrecandidato2')->nullable();
            $table->string('nombrecandidato3')->nullable();
            $table->string('nombrecandidato4')->nullable();
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
        Schema::dropIfExists('frentes');
    }
}