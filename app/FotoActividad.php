<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FotoActividad extends Model
{
    protected $table = 'foto_actividades';

	protected $primaryKey = 'id_foto_actividad';

	protected $fillable = ['foto', 'video','detalle','tipo_foto','extendida'];

	public $timestamps = false;
}
