<?php

namespace Modules\Transaction\Http\Services;

use Modules\Transaction\Dao\Facades\WoDetailFacades;
use Modules\Transaction\Dao\Facades\StockFacades;
use Modules\Transaction\Dao\Models\WoDetail;
use Modules\Transaction\Dao\Models\Stock;
use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Http\Services\UpdateService;
use Modules\System\Plugins\Alert;

class WoReceiveService extends UpdateService
{
    public function update(CrudInterface $repository, $data, $code)
    {
        $check = $repository->updateRepository($data->all(), $code);
        WoDetail::upsert(
            $data['detail'],
            [
                WoDetailFacades::mask_wo_code(),
                WoDetailFacades::mask_product_id(),
            ],
            [
                WoDetailFacades::mask_receive(),
            ]
        );

        StockFacades::upsert(
            $data['stock'],
            [
                StockFacades::mask_customer_id(),
                StockFacades::mask_product_id(),
                StockFacades::mask_warehouse_id(),
                StockFacades::mask_location_id(),
            ],
            [
                StockFacades::mask_qty(),
            ]
        );

        if ($check['status']) {
            Alert::update();
        } else {
            Alert::error($check['data']);
        }
        return $check;
    }
}
