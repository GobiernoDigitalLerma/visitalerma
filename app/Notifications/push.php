<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;

class push extends Notification
{
    use Queueable;

    public $title, $body;


    public function __construct($title, $body)
    {

        $this->title = $title;
        $this->body = $body;
    }

    public function via($notifiable)
    {
        return [WebPushChannel::class];
    }

    public function toWebPush($notifiable, $notification)
    {
      $time = \Carbon\Carbon::now();
      return (new WebPushMessage)
            // ->id($notification->id)
            ->title($this->title)
            ->icon(url('/push.png'))
            ->body($this->body);
            //->action('View account', 'view_account');
    }
}
