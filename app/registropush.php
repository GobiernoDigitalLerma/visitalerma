<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use NotificationChannels\WebPush\HasPushSubscriptions;

class registropush extends Model
{
    use Notifiable, HasPushSubscriptions;

    protected $table = 'registropushes';


	protected $fillable = ['id','ip'];

	public $timestamps = true;
}
