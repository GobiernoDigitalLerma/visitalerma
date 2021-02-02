<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtesanosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artesanos', function (Blueprint $table) {
            $table->increments('id_art');
            $table->string('nombre',200);
            $table->string('direccion',200);
            $table->string('telefono',60);
            $table->string('contacto',200);
            $table->string('correo',200);
            $table->longText('logros');
            $table->longText('premios');
            $table->longText('historias');
            $table->integer('id_tipo_artesanias')->unsigned();
        });

        Schema::table('artesanos', function($table) {
            $table->foreign('id_tipo_artesanias')->references('id_tipo_artesanias')->on('tipo_artesanias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artesanos');
    }
}
