<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PWAdownload extends Model
{

    protected $table = 'PWAdownload';
	  protected $guarded = ['id'];
	  protected $primaryKey = 'id';
	  protected $fillable = [
		'id','ipublic'];
	public $timestamps = true;

}
