<?php

namespace App\Listeners;

use App\Events\SalaryPaymentApproved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SalaryPaymentApprovedListener
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
     * @param  \App\Events\SalaryPaymentApproved  $event
     * @return void
     */
    public function handle(SalaryPaymentApproved $event)
    {
        // dd($event->salary);
    }
}
