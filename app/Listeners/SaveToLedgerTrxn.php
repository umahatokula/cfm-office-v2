<?php

namespace App\Listeners;

use Carbon\Carbon;
use App\Models\Transaction;
use App\Events\TransactionOccured;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SaveToLedgerTrxn
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
     * @param  \App\Events\TransactionOccured  $event
     * @return void
     */
    public function handle(TransactionOccured $event)
    {
        dd($event);
        Transaction::create([
            'code_cr'     => $event->code_cr,
            'code_dr'     => $event->code_dr,
            'amount'      => $event->amount,
            'description' => $event->description,
            'value_date'  => $event->value_date,
            'created_at'  => Carbon::now(),
        ]);




    }
}
