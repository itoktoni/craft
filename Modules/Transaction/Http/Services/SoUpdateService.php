<?php

namespace Modules\Transaction\Http\Services;

use Modules\Transaction\Dao\Facades\SoDetailFacades;
use Modules\Transaction\Dao\Facades\StockFacades;
use Modules\Transaction\Dao\Models\SoDetail;
use Modules\Transaction\Dao\Models\Stock;
use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Http\Services\UpdateService;
use Modules\System\Plugins\Alert;

class SoUpdateService extends UpdateService
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
                SoDetailFacades::mask_qty(),
                SoDetailFacades::mask_price(),
                SoDetailFacades::mask_total(),
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
