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
        if ($data[SoFacades::mask_status()] == TransactionStatus::Delivery) {

            $data[SoFacades::mask_status()] = TransactionStatus::Finish;
            foreach ($data['detail'] as $detail) {

                $stock = StockFacades::where(StockFacades::mask_so_code(), $detail[SoDetailFacades::mask_so_code()])
                ->Where(StockFacades::mask_product_id(), $detail[SoDetailFacades::mask_product_id()])->first();
                $qty = $stock->mask_qty - $detail['so_detail_sent'];
                
                $stock = StockFacades::where(StockFacades::mask_so_code(), $detail[SoDetailFacades::mask_so_code()])
                ->Where(StockFacades::mask_product_id(), $detail[SoDetailFacades::mask_product_id()])->update([
                    'stock_qty' => $qty
                ]);
            }
        }

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

        $check = $repository->updateRepository($data->all(), $code);

        if ($check['status']) {
            Alert::update();
        } else {
            Alert::error($check['data']);
        }
        return $check;
    }
}
