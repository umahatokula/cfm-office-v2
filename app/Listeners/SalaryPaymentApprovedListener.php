<?php

namespace App\Listeners;

use App\Events\SalaryPaymentApproved;
use App\Models\Transaction;
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

        $total = $event->salary->getSalaryTotal();

        // fire event
        Transaction::prepTransactionEvent(name: 'salaries_paid', amount: $total, description: 'Salary approved', date: $event->salary->created_at);

    }
}
