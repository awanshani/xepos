<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $model;
    public $type;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($model,$type)
    {
        $this->type=$type;
        $this->model=$model;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject=$this->type;
        return $this->markdown('emails.registration')
            ->subject("Notification of $subject Registration");
    }
}
