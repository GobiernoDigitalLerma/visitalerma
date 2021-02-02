<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalActTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calificacion_actividades', function (Blueprint $table) {
            $table->increments('idca');
            $table->integer('ida')->unsigned();
            $table->integer('calificacion')->unsigned();
            $table->timestamp('fecha');
            $table->timestamps();
        });

        Schema::table('calificacion_actividades', function($table) {
            $table->foreign('ida')->references('id_actividad')->on('actividades');
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

        Schema::table('calificacion_actividades', function(Blueprint $table){
            $table->dropForeign(['ida']);
        });

        Schema::dropIfExists('calificacion_actividades');
    }
}
