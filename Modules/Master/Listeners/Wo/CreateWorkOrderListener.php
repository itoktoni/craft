<?php

namespace Modules\Master\Listeners\Wo;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Master\Dao\Facades\LinenDetailFacades;
use Modules\Master\Events\RegisterLinenEvent;
use Modules\Linen\Dao\Enums\LinenStatus;
use Modules\Master\Events\PaymentApproveEvent;

class CreateWorkOrderListener
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
     * @param  object  $event
     * @return void
     */
    public function handle(PaymentApproveEvent $event)
    {
        if($event->detail){
            $grouping = $event->detail->mapToGroups(function($item){
                return [$item->mask_supplier_id => $item];
            });

            dd($grouping);
        }
    }
}
