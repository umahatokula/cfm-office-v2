<?php

namespace App\Listeners;

use App\Events\SalaryCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SalaryCreatedListener
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
     * @param  \App\Events\SalaryCreated  $event
     * @return void
     */
    public function handle(SalaryCreated $event)
    {
        // dd($event->salary);
    }
}
