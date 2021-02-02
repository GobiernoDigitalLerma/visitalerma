<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalSubActividad extends Model
{
    protected $table = 'calificacion_sub_actividades';

	protected $primaryKey = 'idcsa';

	protected $fillable = ['idsa','calificacion','fecha'];

	public $timestamps = false;

	public function sub_actividad(){
		return $this->belongsTo('App\SubActividad', 'idsa');
	}
}
