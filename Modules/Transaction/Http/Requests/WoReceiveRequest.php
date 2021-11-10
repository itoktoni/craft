<?php

namespace Modules\Transaction\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Master\Dao\Facades\LocationFacades;
use Modules\Master\Dao\Facades\ProductFacades;
use Modules\Master\Dao\Repositories\ProductRepository;
use Modules\System\Plugins\Helper;
use Modules\Transaction\Dao\Enums\TransactionStatus;
use Modules\Transaction\Dao\Facades\SalesDetailFacades;
use Modules\Transaction\Dao\Facades\SoDetailFacades;
use Modules\Transaction\Dao\Facades\StockFacades;
use Modules\Transaction\Dao\Facades\WoDetailFacades;
use Modules\Transaction\Dao\Facades\WoFacades;
use Modules\Transaction\Dao\Models\So;
use PhpParser\Node\Stmt\Foreach_;

class WoReceiveRequest extends FormRequest
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

    public function withValidator($validator)
    {
        // $validator->after(function ($validator) {
        //     $validator->errors()->add('system_action_code', 'The title cannot contain bad words!');
        // });
    }

    public function prepareForValidation()
    {
        $map = collect($this->detail)->map(function ($item){
            $data[WoDetailFacades::mask_wo_code()] = $this->code;
            $data[WoDetailFacades::mask_product_id()] = $item['temp_id'];
            $data[WoDetailFacades::mask_receive()] = Helper::filterInput($item['temp_receive']);
            return $data;
        }); 

        $order = collect($this->detail)->map(function ($item){
            $data[SoDetailFacades::mask_so_code()] = $this->{WoFacades::mask_so_code()};
            $data[SoDetailFacades::mask_product_id()] = $item['temp_id'];
            $data[SoDetailFacades::mask_sent()] = Helper::filterInput($item['temp_receive']);
            return $data;
        }); 

        $stock = collect($this->detail)->map(function ($item){

            $warehouse = LocationFacades::find($this->wo_location_id);
            $data[StockFacades::mask_customer_id()] = $this->wo_customer_id;
            $data[StockFacades::mask_warehouse_id()] = $warehouse->location_warehouse_id;
            $data[StockFacades::mask_location_id()] = $this->wo_location_id;
            $data[StockFacades::mask_so_code()] = $this->wo_so_code;
            $data[StockFacades::mask_wo_code()] = $this->code;
            $data[StockFacades::mask_product_id()] = $item['temp_id'];
            $data[StockFacades::mask_qty()] = Helper::filterInput($item['temp_receive']);
            return $data;
        }); 

        $this->merge([
            'detail' => array_values($map->toArray()),
            'stock' => array_values($stock->toArray()),
            'order' => array_values($order->toArray()),
        ]);

    }

    public function rules()
    {
        if (request()->isMethod('POST')) {
            return [
                WoFacades::mask_customer_id() => 'required',
                WoFacades::mask_location_id() => 'required',
                'detail' => 'required',
            ];
        }
        return [];
    }

    public function attributes()
    {
        return [
            WoFacades::mask_customer_id() => 'Customer',
            WoFacades::mask_location_id() => 'Location',
        ];
    }

    public function messages()
    {
        return [
            'detail.required' => 'Please input detail product !'
        ];
    }
}
