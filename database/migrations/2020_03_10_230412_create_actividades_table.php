<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades', function (Blueprint $table) {
            $table->increments('id_actividad');
            $table->date('fecha_inicio');
            $table->string('nombre',200);
            $table->text('descripcion');
            $table->text('artista');
            $table->longText('horario_detalle');
            $table->date('fecha_fin_actividad');
            $table->integer('id_tipo_actividad')->unsigned();
            $table->integer('id_usuario')->unsigned();
            $table->timestamps();
            $table->tinyInteger('activo')->default('1');
            $table->integer('idu');
            $table->integer('secciones');
        });

        Schema::table('actividades', function($table) {
            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios');
            $table->foreign('id_tipo_actividad')->references('id_tipo_actividad')->on('tipo_actividades');
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

        Schema::table('actividades', function (Blueprint $table) {
            $table->dropForeign(['id_usuario']);
            $table->dropForeign(['id_tipo_actividad']);
        });
        Schema::dropIfExists('actividades');
    }
}
