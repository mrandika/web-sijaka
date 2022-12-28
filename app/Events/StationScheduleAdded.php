<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StationScheduleAdded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $station_id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($station_id)
    {
        $this->station_id = $station_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('station-schedule-added.'.$this->station_id);
    }
}
