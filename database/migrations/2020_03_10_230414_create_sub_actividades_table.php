<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_actividades', function (Blueprint $table) {
            $table->increments('id_sub_actividad');
            $table->date('fecha');
            $table->string('nombre',200);
            $table->longText('horario');
            $table->integer('id_actividad')->unsigned();
            $table->integer('id_tipo_actividad')->unsigned();
            $table->integer('id_usuario')->unsigned();
            $table->timestamps();
            $table->tinyInteger('activo')->default('1');
            $table->integer('id_ubicacion_actividad')->unsigned();
            $table->text('descripcion');
            $table->double('costo', 7, 2);
        });

        Schema::table('sub_actividades', function($table) {
            $table->foreign('id_actividad')->references('id_actividad')->on('actividades');
            $table->foreign('id_tipo_actividad')->references('id_tipo_actividad')->on('tipo_actividades');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios');
            $table->foreign('id_ubicacion_actividad')->references('id_ubicacion_actividad')->on('ubicacion_actividades');
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

        Schema::table('sub_actividades', function(Blueprint $table){
            $table->dropForeign(['id_actividad']);
            $table->dropForeign(['id_tipo_actividad']);
            $table->dropForeign(['id_usuario']);
            $table->dropForeign(['id_ubicacion_actividad']);
        });

        Schema::drop('sub_actividades');
    }
}
