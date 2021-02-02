<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalSActTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calificacion_sub_actitivades', function (Blueprint $table) {
            $table->increments('idcsa');
            $table->integer('idsa')->unsigned();
            $table->integer('calificacion')->unsigned();
            $table->timestamp('fecha');
            $table->timestamps();
        });

        Schema::table('calificacion_sub_actitivades', function($table) {
            $table->foreign('idsa')->references('id_sub_actividad')->on('sub_actividades');
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

        Schema::table('calificacion_sub_actitivades', function(Blueprint $table){
            $table->dropForeign(['idsa']);
        });

        Schema::dropIfExists('calificacion_sub_actitivades');
    }
}
