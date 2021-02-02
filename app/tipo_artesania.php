<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class tipo_artesania extends Model
{
   protected $primaryKey = 'id_tipo_artesanias';
   protected $fillable = ['nombre'];


}


