<?php

namespace App\Providers;

use App\Events\RequisitionCreated;
use App\Events\RequisitionApproved;
use App\Events\SalaryCreated;
use App\Events\SalaryPaymentApproved;
use App\Events\TransactionOccured;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\RequisitionCreatedListener;
use App\Listeners\RequisitionApprovedListener;
use App\Listeners\SalaryCreatedListener;
use App\Listeners\SalaryPaymentApprovedListener;
use App\Listeners\SaveToLedgerTrxn;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        RequisitionCreated::class => [
            RequisitionCreatedListener::class
        ],
        RequisitionApproved::class => [
            RequisitionApprovedListener::class
        ],
        SalaryCreated::class => [
            SalaryCreatedListener::class
        ],
        SalaryPaymentApproved::class => [
            SalaryPaymentApprovedListener::class
        ],
        TransactionOccured::class => [
            SaveToLedgerTrxn::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
