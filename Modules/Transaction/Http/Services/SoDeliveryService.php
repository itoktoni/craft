<?php

namespace Modules\Transaction\Http\Services;

use Modules\Transaction\Dao\Facades\SoDetailFacades;
use Modules\Transaction\Dao\Facades\StockFacades;
use Modules\Transaction\Dao\Models\SoDetail;
use Modules\Transaction\Dao\Models\Stock;
use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Http\Services\UpdateService;
use Modules\System\Plugins\Alert;
use Modules\Transaction\Dao\Enums\TransactionStatus;
use Modules\Transaction\Dao\Facades\SoFacades;

class SoDeliveryService extends UpdateService
{
    public function update(CrudInterface $repository, $data, $code)
    {
        $check = $repository->updateRepository($data->all(), $code);
        SoDetail::upsert(
            $data['detail'],
            [
                SoDetailFacades::mask_so_code(),
                SoDetailFacades::mask_product_id(),
            ],
            [
                SoDetailFacades::mask_sent(),
            ]
        );

        if($data[SoFacades::mask_status()] == TransactionStatus::Delivery){

            foreach($data['detail'] as $detail){

                StockFacades::where(StockFacades::mask_so_code(), $detail[ SoDetailFacades::mask_so_code()])->delete();
            }
        }

        if ($check['status']) {
            Alert::update();
        } else {
            Alert::error($check['data']);
        }
        return $check;
    }
}
