<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalActividad extends Model
{
    protected $table = 'calificacion_actividades';

	protected $primaryKey = 'idca';

	protected $fillable = ['ida','calificacion','fecha'];

	public $timestamps = false;

	public function actividad(){
		return $this->belongsTo(Actividad::class, 'ida');
	}
}
