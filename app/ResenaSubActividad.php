<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResenaSubActividad extends Model
{
    protected $table = 'resena_sub_actividades';

	protected $primaryKey = 'id_resena_sub_actividad';

	protected $fillable = ['id_sub_actividad','nombre', 'detalle','status'];

	public $timestamps = false;
}
