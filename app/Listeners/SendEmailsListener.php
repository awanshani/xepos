<?php

namespace App\Listeners;

use App\Events\SendEmailsEvent;
use App\Mail\SendEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailsListener
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SendEmailsEvent  $event
     * @return void
     */
    public function handle(SendEmailsEvent $event)
    {
        Mail::to($event->model->email)->send(
            new SendEmail($event->model,$event->type)
        );
    }
}
