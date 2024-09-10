<?php

namespace Spd\User\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SendEmailToUserNotification extends Notification
{
    use Queueable;

    
    public function __construct()
    {
        //
    }


    public function via($notifiable)
    {
        return ['database'];
    }


    public function toArray($notifiable)
    {
        return [
            'title' => 'Send email to user',
            'message' => 'toplearn course is best',
            'url' => route('home.index'),
        ];
    }
}
