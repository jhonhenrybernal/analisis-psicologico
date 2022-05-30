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
    public string $nombrePaciente;
    public string $statusAssement;  
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($messagge,$status,$nombrePaciente,$statusAssement)
    {
        $this->messagge = $messagge;
        $this->status = $status;
        $this->nombrePaciente = $nombrePaciente;
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
