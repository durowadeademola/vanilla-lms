<?php

namespace App\Events;

use App\Models\Enrollment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EnrollmentDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $enrollment;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Enrollment $enrollment)
    {
        $this->enrollment = $enrollment;
    }

}
