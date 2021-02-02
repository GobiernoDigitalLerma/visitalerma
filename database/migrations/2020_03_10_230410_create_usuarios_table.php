<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id_usuario');
            $table->string('nombre',100);
            $table->string('ap',100);
            $table->string('am',100);
            $table->string('correo',200)->unique();
            $table->string('telefono',30);
            $table->string('password',200);
            $table->string('avatar',100);
            $table->integer('id_tipo_usuario')->unsigned();
            $table->timestamps();
            $table->tinyInteger('activo')->default('1');
        });

        Schema::table('usuarios', function($table) {
            $table->foreign('id_tipo_usuario')->references('id_tipo_usuario')->on('tipo_usuarios');
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

        Schema::table('usuarios', function(Blueprint $table){
            $table->dropForeign(['id_tipo_usuario']);
        });

        Schema::dropIfExists('usuarios');
    }
}
