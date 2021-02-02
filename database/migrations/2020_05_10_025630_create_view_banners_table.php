<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("create view banners as select b.id_banner as id_banner, b.nombre as nombre, b.fecha_inicio as fecha_inicio, b.fecha_fin as fecha_fin, b.descripcion as descripcion, b.ruta as ruta, b.id_actividad as id_actividad, b.activo as activo, a.nombre as act FROM (actividades as a JOIN baners as b ON ((b.id_actividad = a.id_actividad)))");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("drop view banners");
    }
}
