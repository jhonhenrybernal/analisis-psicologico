<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class patientProcess implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public string $messagge;
    public bool $status;
    public array $params;
    public string $statusAssement;  
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($messagge,$status,$params,$statusAssement)
    {
        $this->messagge = $messagge;
        $this->status = $status;
        $this->params = $params;
        $this->statusAssement = $statusAssement;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        //return new PrivateChannel('channel-name');
        return new Channel('patient');
    }
}
