<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class artesano extends Model
{
     protected $table = 'artesanos';

	protected $primaryKey = 'id_art';

	protected $fillable = ['id_art','nombre', 'direccion',
	'telefono','contacto','correo','logros','premios','historia','id_tipo_artesanias'];

}
