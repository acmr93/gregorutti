<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContenidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contenido', function (Blueprint $table) {
            $table->increments('id');
            $table->string('seccion')->nullable();
            $table->string('orden')->nullable();
            $table->json('titulo')->nullable();
            $table->json('subtitulo')->nullable();
            $table->json('texto1')->nullable();
            $table->json('texto2')->nullable();
            $table->json('img')->nullable();
            $table->string('slug')->unique()->nullable();
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
        Schema::dropIfExists('contenido');
    }
}
