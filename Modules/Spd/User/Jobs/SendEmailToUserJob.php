<?php

namespace Spd\User\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Spd\User\Mail\SendEmailToUserMail;

class SendEmailToUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $email;


    public function __construct($email)
    {
        $this->email = $email;
    }

    
    public function handle()
    {
        $email = new SendEmailToUserMail();
        Mail::to($this->email)->send($email);
    }
}
