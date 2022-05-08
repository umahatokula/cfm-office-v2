<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TransactionOccured
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $code_cr, $code_dr, $amount, $description, $value_date;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($code_cr, $code_dr, $amount, $description, $value_date)
    {
        $this->code_cr = $code_cr;
        $this->code_dr = $code_dr;
        $this->amount = $amount;
        $this->description = $description;
        $this->value_date = $value_date;
    }

}
