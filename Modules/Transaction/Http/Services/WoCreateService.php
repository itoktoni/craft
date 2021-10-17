<?php

namespace Modules\Transaction\Http\Services;

use Illuminate\Support\Facades\DB;
use Modules\Linen\Dao\Facades\StockFacades;
use Modules\Linen\Dao\Models\RewashDetail;
use Modules\Transaction\Dao\Models\SalesDetail;
use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Http\Services\CreateService;
use Modules\System\Plugins\Alert;
use Modules\Transaction\Dao\Facades\SoDetailFacades;
use Modules\Transaction\Dao\Facades\WoDetailFacades;
use Modules\Transaction\Dao\Facades\WoFacades;

class WoCreateService extends CreateService
{
    public function save(CrudInterface $repository, $data)
    {
        $check = false;
        try {
            $check = $repository->saveRepository($data->all());
            WoDetailFacades::insert($data['wo_detail']);

            if(isset($check['status']) && $check['status']){

                Alert::create();
            }
            else{
                $message = env('APP_DEBUG') ? $check['data'] : $check['message'];
                Alert::error($message);
            }
        } catch (\Throwable $th) {
            Alert::error($th->getMessage());
            return $th->getMessage();
        }

        return $check;
    } 
}
