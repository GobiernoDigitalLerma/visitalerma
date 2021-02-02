<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUbicacionActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ubicacion_actividades', function (Blueprint $table) {
            $table->increments('id_ubicacion_actividad');
            $table->string('nombre',200);
            $table->string('fx',255);
            $table->string('fy',255);
            $table->integer('region')->unsigned();
            $table->tinyInteger('activo')->default('1');
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
        Schema::disableForeignKeyConstraints();

        Schema::table('ubicacion_actividades', function(Blueprint $table){
            $table->dropForeign(['id_actividad']);
        });

        Schema::dropIfExists('ubicacion_actividades');
    }
}
