<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResenaActividad extends Model
{
    protected $table = 'resena_actividades';

	protected $primaryKey = 'id_resena_actividad';

	protected $fillable = ['id_actividad','nombre', 'detalle','status'];

	public $timestamps = false;
}
