<?php

namespace App\Listeners;

use App\Events\TransactionOccured;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
        //
    }
}
