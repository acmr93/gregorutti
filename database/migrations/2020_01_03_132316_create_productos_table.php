<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('productos', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('orden')->nullable();
        //     $table->json('nombre')->nullable();
        //     $table->json('descripcion')->nullable();
        //     $table->json('caracteristicas')->nullable();
        //     $table->json('texto1')->nullable();
        //     $table->json('texto2')->nullable();
        //     $table->json('img')->nullable();
        //     $table->integer('familia_id')->unsigned()->nullable();
        //     $table->foreign('familia_id')->references('id')->on('familias')->onDelete('cascade');
        //     $table->integer('subfamilia_id')->unsigned()->nullable();
        //     $table->foreign('subfamilia_id')->references('id')->on('subfamilias')->onDelete('cascade');
        //     $table->string('slug')->unique()->nullable();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
