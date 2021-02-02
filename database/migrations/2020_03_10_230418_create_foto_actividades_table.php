<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFotoActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foto_actividades', function (Blueprint $table) {
            $table->increments('id_foto_actividad');
            $table->integer('id_actividad')->unsigned();
            $table->string('foto',200);
            $table->string('video',200);
            $table->longText('detalle');
            $table->timestamps();
            $table->tinyInteger('activo')->default('1');
            $table->integer('tipo_foto');
            $table->integer('extendida');
        });

        
        Schema::table('foto_actividades', function($table) {
            $table->foreign('id_actividad')->references('id_actividad')->on('actividades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::table('foto_actividades', function(Blueprint $table){
            $table->dropForeign(['id_actividad']);
        });

        Schema::dropIfExists('foto_actividades');
    }
}
