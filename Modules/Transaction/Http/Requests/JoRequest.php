<?php

namespace Modules\Transaction\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Master\Dao\Facades\ProductFacades;
use Modules\Master\Dao\Facades\ServiceFacades;
use Modules\Master\Dao\Repositories\ProductRepository;
use Modules\System\Plugins\Helper;
use Modules\Transaction\Dao\Enums\TransactionStatus;
use Modules\Transaction\Dao\Facades\SalesDetailFacades;
use Modules\Transaction\Dao\Facades\JoDetailFacades;
use Modules\Transaction\Dao\Facades\JoFacades;
use Modules\Transaction\Dao\Models\Jo;

class JoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    private static $model;

    public function __construct(Jo $models)
    {
        self::$model = $models;
    }

    public function prepareForValidation()
    {
        $autonumber = Helper::autoNumber(self::$model->getTable(), self::$model->getKeyName(), 'JO' . date('Ym'), env('WEBSITE_AUTONUMBER'));
        if (!empty($this->code)) {
            $autonumber = $this->code;
        }

        $map = collect($this->detail)->map(function ($item) use ($autonumber) {
            $data_product = ServiceFacades::singleRepository($item['temp_id']);
            $total = $item['temp_qty'] * Helper::filterInput($item['temp_price']) ?? 0;
            $data[JoDetailFacades::mask_jo_code()] = $autonumber;
            $data[JoDetailFacades::mask_so_code()] = $this->{JoFacades::mask_so_code()};
            $data[JoDetailFacades::mask_product_id()] = $item['temp_id'];
            $data[JoDetailFacades::mask_product_price()] = $data_product->mask_price ?? '';
            $data[JoDetailFacades::mask_qty()] = Helper::filterInput($item['temp_qty']);
            $data[JoDetailFacades::mask_price()] = Helper::filterInput($item['temp_price']) ?? 0;
            $data[JoDetailFacades::mask_total()] = $total;
            return $data;
        }); 
        
        $total_value = Helper::filterInput($this->{JoFacades::mask_value()}) ?? 0;
        $total_discount = Helper::filterInput($this->{JoFacades::mask_discount()}) ?? 0;
        $total_summary = $total_value - $total_discount;

        $this->merge([
            JoFacades::getKeyName() => $autonumber,
            JoFacades::mask_value() => $total_value,
            JoFacades::mask_discount() => $total_discount,
            JoFacades::mask_total() => $total_summary,
            'detail' => array_values($map->toArray()),
        ]);
    }

    public function rules()
    {
        if (request()->isMethod('POST')) {
            return [
                JoFacades::mask_customer_id() => 'required',
                'detail' => 'required',
            ];
        }
        return [];
    }

    public function attributes()
    {
        return [
            JoFacades::mask_customer_id() => 'Customer',
        ];
    }

    public function messages()
    {
        return [
            'detail.required' => 'Please input detail product !'
        ];
    }
}
