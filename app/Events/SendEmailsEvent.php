<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendEmailsEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $model;
    public $type;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($model,$type)
    {
        $this->type=$type;
        $this->model=$model;
    }

}
