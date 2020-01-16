<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre')->nullable();
            $table->json('domicilio')->nullable();
            $table->longText('ubicacion_maps')->nullable();
            $table->longText('enlance_maps')->nullable();
            $table->string('email_contacto')->nullable();
            $table->string('email_presupuesto')->nullable();
            $table->json('redes_sociales')->nullable();
            $table->json('telefonos')->nullable();
            $table->json('emails')->nullable();
            $table->json('terminos')->nullable();
            $table->json('texto_secciones')->nullable();
            $table->json('contenido_home')->nullable(); // proyectos destacados, servicios y fondo en presupuesto
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
        Schema::dropIfExists('empresa');
    }
}
