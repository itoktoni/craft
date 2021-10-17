<?php

namespace Modules\Transaction\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Item\Dao\Repositories\ProductRepository;
use Modules\Master\Dao\Enums\PaymentModel;
use Modules\Master\Dao\Enums\PaymentStatus;
use Modules\Master\Dao\Enums\PaymentType;
use Modules\Master\Dao\Facades\BankFacades;
use Modules\Master\Dao\Facades\PaymentFacades;
use Modules\Transaction\Dao\Models\Movement;
use Modules\System\Plugins\Helper;

class PaymentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function prepareForValidation()
    {
        $this->merge([
            PaymentFacades::mask_status() => PaymentStatus::Submit,
            PaymentFacades::mask_model() => PaymentModel::PaymentSales,
            PaymentFacades::mask_reference() => $this->code,
            PaymentFacades::mask_type() => PaymentType::IN,
        ]);

    }

    public function rules()
    {
        return [
            'payment_bank_from' => 'required',
            'payment_bank_to' => 'required',
            'payment_person' => 'required',
            'payment_value_user' => 'required',
            'file' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'payment_bank_from' => 'From Bank',
            'payment_bank_to' => 'To Bank',
            'payment_person' => 'Person',
            'payment_value_user' => 'Amount',
        ];
    }
}
