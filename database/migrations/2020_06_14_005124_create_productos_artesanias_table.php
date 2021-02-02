<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosArtesaniasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos_artesanias', function (Blueprint $table) {
            $table->bigIncrements('idpa');
            $table->string('nombre', 200);
            $table->string('caracteristicas', 200);
            $table->string('medidas', 200);
            $table->integer('id_tipo_artesanias')->unsigned();
            $table->string('foto1', 200);
            $table->string('foto2', 200);
            $table->string('foto3', 200);
            $table->string('foto4', 200);
            $table->longText('descripcion');
            $table->timestamps();
            $table->tinyInteger('activo')->default('1');
        });
        Schema::table('productos_artesanias', function ($table) {
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
        Schema::dropIfExists('productos_artesanias');
    }
}
