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
use Modules\Transaction\Dao\Facades\MonitoringFacades;

class MonitoringRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function prepareForValidation()
    {
        $wo = $this->code;

        $this->merge([
            MonitoringFacades::mask_wo_code() => $wo,
        ]);

    }

    public function rules()
    {
        return [
            'monitoring_notes' => 'required',
            'monitoring_status' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'monitoring_status' => 'Status',
            'monitoring_notes' => 'Notes',
        ];
    }
}
