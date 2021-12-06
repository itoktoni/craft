<?php

namespace Modules\Transaction\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Master\Dao\Facades\ProductFacades;
use Modules\Master\Dao\Repositories\ProductRepository;
use Modules\System\Plugins\Helper;
use Modules\Transaction\Dao\Enums\ServiceStatus;
use Modules\Transaction\Dao\Enums\TransactionStatus;
use Modules\Transaction\Dao\Facades\JoDetailFacades;
use Modules\Transaction\Dao\Facades\JoFacades;
use Modules\Transaction\Dao\Facades\SalesDetailFacades;
use Modules\Transaction\Dao\Facades\SoDetailFacades;
use Modules\Transaction\Dao\Facades\SoFacades;
use Modules\Transaction\Dao\Facades\WoDetailFacades;
use Modules\Transaction\Dao\Facades\WoFacades;
use Modules\Transaction\Dao\Models\So;
use PhpParser\Node\Stmt\Foreach_;

class SoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    private static $model;

    public function __construct(So $models)
    {
        self::$model = $models;
    }

    public function prepareForValidation()
    {
        $autonumber = Helper::autoNumber(self::$model->getTable(), self::$model->getKeyName(), 'SO' . date('Ym'), env('WEBSITE_AUTONUMBER'));
        if (!empty($this->code)) {
            $autonumber = $this->code;
        }
        
        $map = collect($this->detail)->map(function ($item) use ($autonumber) {
            $data_product = ProductFacades::singleRepository($item['temp_id']);
            $total = $item['temp_qty'] * Helper::filterInput($item['temp_price']) ?? 0;
            $data[SoDetailFacades::mask_so_code()] = $autonumber;
            $data[SoDetailFacades::mask_product_id()] = $item['temp_id'];
            $data[SoDetailFacades::mask_product_price()] = $data_product->mask_price ?? '';
            $data[SoDetailFacades::mask_supplier_id()] = $data_product->mask_supplier_id ?? '';
            $data[SoDetailFacades::mask_qty()] = Helper::filterInput($item['temp_qty']);
            $data[SoDetailFacades::mask_price()] = Helper::filterInput($item['temp_price']) ?? 0;
            $data[SoDetailFacades::mask_total()] = $total;
            return $data;
        }); 
        
        $autoJob = Helper::autoNumber(JoFacades::getTable(), JoFacades::getKeyName(), 'JO' . date('Ym'), env('WEBSITE_AUTONUMBER'));
        $template = JoFacades::dataTemplateRepository($this->so_customer_id);

        $data_wo = $data_wo_detail = $data_jo = $data_jo_detail = [];

        $data_jo = [
            JoFacades::getKeyName() => $autoJob, 
            JoFacades::mask_so_code() => $autonumber, 
            JoFacades::mask_customer_id() => $this->{SoFacades::mask_customer_id()} ?? null,
            JoFacades::mask_status() => ServiceStatus::Create ?? null,
            'jo_discount_name' => $template->jo_discount_name ?? '', 
            'jo_discount_value' => $template->jo_discount_value ?? '', 
            'jo_sum_value' => $template->jo_sum_value ?? '', 
            'jo_sum_discount' => $template->jo_sum_discount ?? '', 
            'jo_sum_total' => $template->jo_sum_total ?? '', 
            'jo_trucking_id' => $template->jo_trucking_id ?? '', 
            'jo_delivery_pickup' => $template->jo_delivery_pickup ?? '', 
        ];

        if($template){

            foreach($template->has_detail as $detail){

                $data_jo_detail[] = [
                    JoDetailFacades::mask_jo_code() => $autoJob,
                    JoDetailFacades::mask_so_code() => $autonumber,
                    JoDetailFacades::mask_product_id() => $detail->mask_product_id,
                    JoDetailFacades::mask_product_price() => $detail->mask_product_price ?? '',
                    JoDetailFacades::mask_qty() => $detail->mask_qty,
                    JoDetailFacades::mask_price() => $detail->mask_price,
                    JoDetailFacades::mask_total() => $detail->mask_total,
                ];
            }
        }

        if (empty($this->code)) {

            $map_wo = $map->mapToGroups(function($item){
                return [$item[SoDetailFacades::mask_supplier_id()] => $item];
            });

            foreach(collect($map_wo) as $key => $wo){

                $id = Helper::autoNumber(WoFacades::getTable(), WoFacades::getKeyName(), 'WO' .$key. date('Ym'), env('WEBSITE_AUTONUMBER'));
                $wo_value = $wo->sum(SoDetailFacades::mask_total());
                
                $data_wo[] = [
                    WoFacades::getKeyName() => $id,
                    WoFacades::mask_so_code() => $autonumber,
                    WoFacades::mask_supplier_id() => $key,
                    WoFacades::mask_customer_id() => $this->{SoFacades::mask_customer_id()} ?? null,
                    WoFacades::mask_status() => TransactionStatus::Create,
                    WoFacades::mask_value() => $wo_value,
                    WoFacades::mask_total() => $wo_value,
                    WoFacades::mask_created_at() => date('Y-m-d H:i:s'),
                    WoFacades::mask_created_by() => auth()->user()->id,
                ];

                foreach($wo as $wo_detail){

                    $data_wo_detail[] = [
                        WoDetailFacades::mask_so_code() => $autonumber,
                        WoDetailFacades::mask_wo_code() => $id,
                        WoDetailFacades::mask_product_id() => $wo_detail[SoDetailFacades::mask_product_id()],
                        WoDetailFacades::mask_product_price() => $wo_detail[SoDetailFacades::mask_product_price()],
                        WoDetailFacades::mask_qty() => $wo_detail[SoDetailFacades::mask_qty()],
                        WoDetailFacades::mask_price() => $wo_detail[SoDetailFacades::mask_price()],
                        WoDetailFacades::mask_total() => $wo_detail[SoDetailFacades::mask_total()],
                    ];
                }
            }
        }

        $total_value = Helper::filterInput($this->{SoFacades::mask_value()}) ?? 0;
        $total_discount = Helper::filterInput($this->{SoFacades::mask_discount()}) ?? 0;
        $total_summary = $total_value - $total_discount;

        $this->merge([
            SoFacades::getKeyName() => $autonumber,
            SoFacades::mask_value() => $total_value,
            SoFacades::mask_discount() => $total_discount,
            SoFacades::mask_total() => $total_summary,
            'detail' => array_values($map->toArray()),
            'wo' => $data_wo,
            'wo_detail' => $data_wo_detail,
            'jo' => $data_jo,
            'so_status' => 1,
            'jo_detail' => $data_jo_detail,
        ]);

    }

    public function rules()
    {
        if (request()->isMethod('POST')) {
            return [
                SoFacades::mask_customer_id() => 'required',
                'detail' => 'required',
            ];
        }
        return [];
    }

    public function attributes()
    {
        return [
            SoFacades::mask_customer_id() => 'Customer',
        ];
    }

    public function messages()
    {
        return [
            'detail.required' => 'Please input detail product !'
        ];
    }
}
