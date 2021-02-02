<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResenaActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resena_actividades', function (Blueprint $table) {
            $table->increments('id_resena_actividad');
            $table->integer('id_actividad')->unsigned();
            $table->string('nombre',100);
            $table->longText('detalle');
            $table->timestamps();
            $table->tinyInteger('activo')->default('1');
        });
        
        Schema::table('resena_actividades', function($table) {
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

        Schema::table('resena_actividades', function(Blueprint $table){
            $table->dropForeign(['id_actividad']);
        });

        Schema::dropIfExists('resena_actividades');
    }
}
