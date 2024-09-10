<?php

namespace Spd\User\Listeners;

use Illuminate\Support\Facades\Mail;
use Spd\User\Mail\SendEmailToUserMail;

class SendEmailToUserListener
{

    public function __construct()
    {
        //
    }


    public function handle($event)
    {
        $email = new SendEmailToUserMail();
        Mail::to($event->email)->send($email);
    }
}
