<?php

namespace App\Listeners;

use App\Helpers\Sms;
use App\Models\User;
use App\Models\Transaction;
use App\Events\RequisitionApproved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RequisitionApprovedListener
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
     * @param  RequisitionApproved  $event
     * @return void
     */
    public function handle(RequisitionApproved $event)
    {
        // \Log::info($event->requisition);

        // fire event
        Transaction::prepTransactionEvent(name: 'requisition', amount: $event->requisition->approved_amount, description: 'Requistion', date: $event->requisition->created_at);

        $users = User::role('generaloverseer')->get();


        foreach ($users as $user) {
            if ($user->phone) {
                $to = $user->phone;
                $message = 'Requisition #'.$event->requisition->requisition_number.' created. Awaiting approval.';
                Sms::sendSMSMessage($to, $message);
            }
        }


    }
}
