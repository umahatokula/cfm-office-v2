<?php

namespace App\Listeners;

use App\Helpers\Sms;
use App\Events\RequisitionCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RequisitionCreatedListener
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
     * @param  RequisitionCreated  $event
     * @return void
     */
    public function handle(RequisitionCreated $event)
    {
        // dd($event->requisition);
        $to = '09099596262';
        $message = 'Requisition #'.$event->requisition->requisition_number.' created. Awaiting approval.';
        Sms::sendSMSMessage($to, $message);
    }
}
