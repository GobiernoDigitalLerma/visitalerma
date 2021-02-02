<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResenaSubActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resena_sub_actividades', function (Blueprint $table) {
            $table->increments('id_resena_sub_actividad');
            $table->integer('id_sub_actividad')->unsigned();
            $table->string('nombre',100);
            $table->longText('detalle');
            $table->timestamps();
            $table->tinyInteger('activo')->default('1');
        });
        
        Schema::table('resena_sub_actividades', function($table) {
            $table->foreign('id_sub_actividad')->references('id_sub_actividad')->on('sub_actividades');
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

        Schema::table('resena_sub_actividades', function(Blueprint $table){
            $table->dropForeign(['id_sub_actividad']);
        });

        Schema::dropIfExists('resena_sub_actividades');
    }
}
