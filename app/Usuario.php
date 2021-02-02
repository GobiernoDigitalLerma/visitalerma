<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';

	protected $primaryKey = 'id_usuario';

	protected $fillable = ['nombre','ap','am','correo','telefono','password','avatar','id_tipo_usuario'];

	public $timestamps = false;
}
