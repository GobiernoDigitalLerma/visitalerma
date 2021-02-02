<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductosArtesanias extends Model
{
    protected $table = "productos_artesanias";
    protected $primaryKey = 'idpa';
    protected $guarded = [];
    public $timestamps = false;
}
