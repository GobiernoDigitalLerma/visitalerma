<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baners', function (Blueprint $table) {
            $table->increments('id_banner');
            $table->string('nombre',200);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->longText('descripcion');
            $table->string('ruta',100);
            $table->integer('id_actividad')->unsigned();
            $table->timestamps();
            $table->tinyInteger('activo')->default('1');
        });

        Schema::table('baners', function($table) {
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

        Schema::table('baners', function(Blueprint $table){
            $table->dropForeign(['id_actividad']);
        });

        Schema::dropIfExists('baners');
    }
}
