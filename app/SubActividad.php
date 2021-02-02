<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubActividad extends Model
{
    protected $table = 'sub_actividades';

	protected $primaryKey = 'id_sub_actividad';

	protected $fillable = ['fecha','nombre','horario','id_actividad','id_tipo_actividad','id_usuario','id_ubicacion_actividad','descripcion','costo','link'];

	public $timestamps = false;

	function actividades(){
    	return $this->belongsTo('App\Actividad','id_actividad');
    }

    function tipoActividad(){
    	return $this->belongsTo('App\TipoActividad','id_tipo_actividad');
    }

    function FotoSubActividad(){
        return $this->hasMany('App\FotoSubActividad');
    }

    function ubicacionesSubActividades(){
        return $this->hasMany('App\UbicacionSubActividades');
    }

    function ubicaciones(){
        return $this->belongsTo('App\UbicacionActividad','id_ubicacion_actividad');
    }
}
