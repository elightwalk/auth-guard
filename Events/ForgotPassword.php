<?php

namespace Elightwalk\AuthGuard\Events;

use Illuminate\Queue\SerializesModels;

class ForgotPassword
{
    use SerializesModels;

    public $data;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->data = $request;
        return ;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
