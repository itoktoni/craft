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

class WoDeliveryRequest extends FormRequest
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
            $data_product = ProductFacades::singleRepository($item['temp_id']);
            $data[WoDetailFacades::mask_wo_code()] = $this->code;
            $data[WoDetailFacades::mask_product_id()] = $item['temp_id'];
            $data[WoDetailFacades::mask_sent()] = Helper::filterInput($item['temp_sent']);
            return $data;
        }); 

        $this->merge([
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
