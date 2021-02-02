<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewTipoUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("create view tipo_user as select u.id_usuario as id_usuario, u.nombre as nombre, u.ap as ap, u.am as am, u.correo as correo, u.telefono as telefono, u.password as password, u.avatar as avatar, u.id_tipo_usuario as id_tipo_usuario, u.activo as activo, t.nombre as tipouser FROM (tipo_usuarios as t JOIN usuarios as u ON ((u.id_tipo_usuario = t.id_tipo_usuario)))");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("drop view tipo_user");
    }
}
