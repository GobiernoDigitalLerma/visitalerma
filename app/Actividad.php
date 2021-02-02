<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = 'actividades';

	protected $primaryKey = 'id_actividad';

	protected $fillable = ['fecha_inicio','nombre','descripcion','artista','horario_detalle','fecha_fin_actividad','id_tipo_actividad','id_usuario','secciones','region','imagenes'];

	public $timestamps = false;


	public function tipo_actividad(){
		return $this->belongsTo(TipoActividad::class,'id_tipo_actividad');
	}

	public function usuario(){
		return $this->belongsTo(Usuario::class, 'id_usuario');
	}

}
