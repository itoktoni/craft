<?php

namespace Modules\Master\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Master\Events\PaymentApproveEvent;
use Modules\Master\Listeners\Wo\CreateWorkOrderListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        PaymentApproveEvent::class => [
            CreateWorkOrderListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
