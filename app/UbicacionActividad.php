<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UbicacionActividad extends Model
{
    protected $table = 'ubicacion_actividades';

	protected $primaryKey = 'id_ubicacion_actividad';

	protected $fillable = ['nombre','fx','fy','region','activo'];

	public $timestamps = false;

	public function SubActividad(){
		return $this->hasMany('App\SubActividad');
	}
}

