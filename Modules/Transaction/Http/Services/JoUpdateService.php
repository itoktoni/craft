<?php

namespace Modules\Transaction\Http\Services;

use Modules\Transaction\Dao\Facades\SoDetailFacades;
use Modules\Transaction\Dao\Facades\StockFacades;
use Modules\Transaction\Dao\Models\SoDetail;
use Modules\Transaction\Dao\Models\Stock;
use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Http\Services\UpdateService;
use Modules\System\Plugins\Alert;
use Modules\Transaction\Dao\Facades\JoDetailFacades;

class JoUpdateService extends UpdateService
{
    public function update(CrudInterface $repository, $data, $code)
    {
        $check = $repository->updateRepository($data->all(), $code);
        JoDetailFacades::upsert(
            $data['detail'],
            [
                JoDetailFacades::mask_so_code(),
                JoDetailFacades::mask_product_id(),
            ],
            [
                JoDetailFacades::mask_qty(),
                JoDetailFacades::mask_price(),
                JoDetailFacades::mask_total(),
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
