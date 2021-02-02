<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Baner extends Model
{
    protected $table = 'baners';

	protected $primaryKey = 'id_banner';

	protected $fillable = ['nombre','fecha_inicio','fecha_fin','descripcion','ruta','id_actividad'];

	public $timestamps = false;
}
