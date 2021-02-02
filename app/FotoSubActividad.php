<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FotoSubActividad extends Model
{
    protected $table = 'foto_sub_actividades';

	protected $primaryKey = 'id_foto_sub_actividad';

	protected $fillable = ['foto', 'video','detalle','tipo_foto','extendida'];

	public $timestamps = false;
}
