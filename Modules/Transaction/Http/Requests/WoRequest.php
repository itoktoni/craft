<?php

namespace Modules\Transaction\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Master\Dao\Facades\ProductFacades;
use Modules\Master\Dao\Repositories\ProductRepository;
use Modules\System\Plugins\Helper;
use Modules\Transaction\Dao\Enums\TransactionStatus;
use Modules\Transaction\Dao\Facades\SalesDetailFacades;
use Modules\Transaction\Dao\Facades\WoDetailFacades;
use Modules\Transaction\Dao\Facades\WoFacades;
use Modules\Transaction\Dao\Models\So;
use PhpParser\Node\Stmt\Foreach_;

class WoRequest extends FormRequest
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
        $autonumber = Helper::autoNumber(self::$model->getTable(), self::$model->getKeyName(), 'WO' . date('Ym'), env('WEBSITE_AUTONUMBER'));
        if (!empty($this->code)) {
            $autonumber = $this->code;
        }

        $map = collect($this->detail)->map(function ($item) use ($autonumber) {
            $data_product = ProductFacades::singleRepository($item['temp_id']);
            $total = $item['temp_qty'] * Helper::filterInput($item['temp_price']) ?? 0;
            $data[WoDetailFacades::mask_wo_code()] = $autonumber;
            $data[WoDetailFacades::mask_product_id()] = $item['temp_id'];
            $data[WoDetailFacades::mask_product_price()] = $data_product->mask_price ?? '';
            $data[WoDetailFacades::mask_qty()] = Helper::filterInput($item['temp_qty']);
            $data[WoDetailFacades::mask_price()] = Helper::filterInput($item['temp_price']) ?? 0;
            $data[WoDetailFacades::mask_total()] = $total;
            return $data;
        }); 

        $total_value = Helper::filterInput($this->{WoFacades::mask_value()}) ?? 0;
        $total_discount = Helper::filterInput($this->{WoFacades::mask_discount()}) ?? 0;
        $total_summary = $total_value - $total_discount;

        $this->merge([
            WoFacades::getKeyName() => $autonumber,
            WoFacades::mask_value() => $total_value,
            WoFacades::mask_discount() => $total_discount,
            WoFacades::mask_total() => $total_summary,
            'detail' => array_values($map->toArray()),
        ]);

    }

    public function rules()
    {
        if (request()->isMethod('POST')) {
            return [
                WoFacades::mask_customer_id() => 'required',
                'detail' => 'required',
            ];
        }
        return [];
    }

    public function attributes()
    {
        return [
            WoFacades::mask_customer_id() => 'Customer',
        ];
    }

    public function messages()
    {
        return [
            'detail.required' => 'Please input detail product !'
        ];
    }
}
