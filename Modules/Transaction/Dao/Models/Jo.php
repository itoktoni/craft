<?php

namespace Modules\Transaction\Dao\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kirschbaum\PowerJoins\PowerJoins;
use Modules\Master\Dao\Facades\PaymentFacades;
use Modules\Master\Dao\Facades\TruckingFacades;
use Modules\Master\Dao\Facades\VendorFacades;
use Modules\Master\Dao\Models\Payment;
use Modules\Master\Dao\Models\Trucking;
use Modules\System\Dao\Facades\TeamFacades;
use Modules\System\Plugins\Helper;
use Modules\Transaction\Dao\Facades\MonitoringFacades;
use Modules\Transaction\Dao\Facades\SalesDetailFacades;
use Modules\Transaction\Dao\Facades\SalesFacades;
use Modules\Transaction\Dao\Facades\SoDetailFacades;
use Modules\Transaction\Dao\Facades\SoFacades;
use Modules\Transaction\Dao\Facades\JoDetailFacades;
use Modules\Transaction\Dao\Facades\JoFacades;
use Wildside\Userstamps\Userstamps;

class Jo extends Model
{
    use SoftDeletes, Userstamps, PowerJoins;

    protected $table = 'jo';
    protected $primaryKey = 'jo_code';
    protected $primaryType = 'string';

    protected $fillable = [
        'jo_code',
        'jo_ref_code',
        'jo_so_code',
        'jo_inv_code',
        'jo_invoice_date',
        'jo_created_at',
        'jo_updated_at',
        'jo_deleted_at',
        'jo_created_by',
        'jo_updated_by',
        'jo_deleted_by',
        'jo_customer_id',
        'jo_code_invoice',
        'jo_status',
        'jo_notes',
        'jo_discount_name',
        'jo_discount_value',
        'jo_sum_value',
        'jo_sum_discount',
        'jo_sum_total',
        'jo_etd',
        'jo_eta',
        'jo_master_bl',
        'jo_total_weight',
        'jo_delivery_notes',
        'jo_delivery_to',
        'jo_delivery_pickup',
        'jo_trucking_id',
        'jo_vessel',
        'jo_port_of_delivery',
        'jo_port_of_loading',
        'jo_shipper_id',
        'jo_shipper_name',
        'jo_shipper_address',
        'jo_consignee_id',
        'jo_consignee_name',
        'jo_consignee_address',
        'jo_agent_id',
        'jo_agent_name',
        'jo_agent_address',
        'jo_notify_party_id',
        'jo_notify_party_name',
        'jo_notify_party_address',
        'jo_receiver_id',
        'jo_receiver_name',
        'jo_receiver_address',
        'jo_receiver_npwp',
        'jo_unit_code',
    ];

    public $with = ['has_detail', 'has_trucking'];

    public $timestamps = true;
    public $incrementing = false;
    public $rules = [
        'jo_code' => 'required|min:3',
    ];

    const CREATED_AT = 'jo_created_at';
    const UPDATED_AT = 'jo_updated_at';
    const DELETED_AT = 'jo_deleted_at';

    const CREATED_BY = 'jo_created_by';
    const UPDATED_BY = 'jo_updated_by';
    const DELETED_BY = 'jo_deleted_by';

    public $searching = 'jo_code';
    public $datatable = [
        'jo_so_code' => [true => 'Sales Code'],
        'jo_code' => [true => 'Job Code'],
        'name' => [true => 'Customer'],
        'jo_created_at' => [true => 'Date', 'width' => 55],
        'jo_sum_value' => [true => 'Value', 'width' => 60],
        'jo_sum_discount' => [true => 'Discount', 'width' => 60],
        'jo_sum_total' => [true => 'Total', 'width' => 60],
        'jo_status' => [true => 'Status', 'width' => 60, 'class' => 'text-center', 'status' => 'status'],
    ];

    protected $dates = ['jo_invoice_date'];

    protected $casts = [
        'jo_eta' => 'datetime:Y-m-d',
        'jo_invoice_date' => 'datetime:Y-m-d',
        'jo_created_at' => 'datetime:Y-m-d',
    ];

    public function mask_status()
    {
        return 'jo_status';
    }

    public function setMaskStatusAttribute($value)
    {
        $this->attributes[$this->mask_status()] = $value;
    }

    public function getMaskStatusAttribute()
    {
        return $this->{$this->mask_status()};
    }

    public function mask_so_code()
    {
        return 'jo_so_code';
    }

    public function setMaskSoCodeAttribute($value)
    {
        $this->attributes[$this->mask_so_code()] = $value;
    }

    public function getMaskSoCodeAttribute()
    {
        return $this->{$this->mask_so_code()};
    }

    public function mask_trucking_id()
    {
        return 'jo_trucking_id';
    }

    public function setMaskTruckingIdAttribute($value)
    {
        $this->attributes[$this->mask_trucking_id()] = $value;
    }

    public function getMaskTruckingIdAttribute()
    {
        return $this->{$this->mask_trucking_id()};
    }

    public function getMaskTruckingNameAttribute()
    {
        return $this->has_trucking->trucking_name ?? '';
    }

    public function mask_location_id()
    {
        return 'jo_location_id';
    }

    public function setMaskLocationIdAttribute($value)
    {
        $this->attributes[$this->mask_location_id()] = $value;
    }

    public function getMaskLocationIdAttribute()
    {
        return $this->{$this->mask_location_id()};
    }

    public function getMaskLocationNameAttribute()
    {
        return $this->has_location->location_name ?? '';
    }

    public function mask_total()
    {
        return 'jo_sum_total';
    }

    public function setMaskTotalAttribute($value)
    {
        $this->attributes[$this->mask_total()] = $value;
    }

    public function getMaskTotalAttribute()
    {
        return $this->{$this->mask_total()};
    }

    public function getMaskTotalFormatAttribute()
    {
        return Helper::createRupiah($this->{$this->mask_total()});
    }

    public function mask_value()
    {
        return 'jo_sum_value';
    }

    public function setMaskValueAttribute($value)
    {
        $this->attributes[$this->mask_value()] = $value;
    }

    public function getMaskValueAttribute()
    {
        return $this->{$this->mask_value()};
    }

    public function getMaskValueFormatAttribute()
    {
        return Helper::createRupiah($this->{$this->mask_value()});
    }

    public function mask_discount()
    {
        return 'jo_sum_discount';
    }

    public function setMaskDiscountAttribute($value)
    {
        $this->attributes[$this->mask_discount()] = $value;
    }

    public function getMaskDiscountAttribute()
    {
        return $this->{$this->mask_discount()};
    }

    public function mask_discount_name()
    {
        return 'jo_discount_name';
    }

    public function setMaskDiscountNameAttribute($value)
    {
        $this->attributes[$this->mask_discount_name()] = $value;
    }

    public function getMaskDiscountNameAttribute()
    {
        return $this->{$this->mask_discount_name()};
    }

    public function getMaskDiscountFormatAttribute()
    {
        return Helper::createRupiah($this->{$this->mask_discount()});
    }

    public function mask_customer_id()
    {
        return 'jo_customer_id';
    }

    public function setMaskCustomerIdAttribute($value)
    {
        $this->attributes[$this->mask_customer_id()] = $value;
    }

    public function getMaskCustomerIdAttribute()
    {
        return $this->{$this->mask_customer_id()};
    }

    public function getMaskCustomerNameAttribute()
    {
        return $this->has_customer->name ?? '';
    }

    public function mask_created_at()
    {
        return self::CREATED_AT;
    }

    public function setMaskCreatedAtAttribute($value)
    {
        $this->attributes[$this->mask_created_at()] = $value;
    }

    public function getMaskCreatedAtAttribute()
    {
        return $this->{$this->mask_created_at()};
    }

    public function mask_created_by()
    {
        return self::CREATED_BY;
    }

    public function setMaskCreatedByAttribute($value)
    {
        $this->attributes[$this->mask_created_by()] = $value;
    }

    public function getMaskCreatedByAttribute()
    {
        return $this->{$this->mask_created_by()};
    }

    public function has_detail()
    {
        return $this->hasMany(JoDetail::class, JoDetailFacades::mask_jo_code(), JoFacades::getKeyName());
    }

    public function has_customer()
    {
        return $this->hasone(User::class, TeamFacades::getKeyName(), $this->mask_customer_id());
    }

    public function has_trucking()
    {
        return $this->hasone(Trucking::class, TruckingFacades::getKeyName(), $this->mask_trucking_id());
    }

    public function has_payment()
    {
        return $this->hasMany(Payment::class, PaymentFacades::mask_reference(), $this->getKeyName());
    }

    public function has_monitoring()
    {
        return $this->hasMany(Monitoring::class, MonitoringFacades::mask_jo_code(), $this->getKeyName());
    }

    public static function boot()
	{
		parent::boot();
		parent::saving(function($model){
			if(empty($model->jo_etd)){
				$model->jo_etd = null;
			}
            if(empty($model->jo_eta)){
				$model->jo_eta = null;
			}


            if($shipper = $model->jo_shipper_id){
                $model->jo_shipper_name = VendorFacades::find($shipper)->vendor_name ?? '';
                $model->jo_shipper_address = VendorFacades::find($shipper)->vendor_address ?? '';
            }

            if($consignee = $model->jo_consignee_id){
                $model->jo_consignee_name = VendorFacades::find($consignee)->vendor_name ?? '';
                $model->jo_consignee_address = VendorFacades::find($consignee)->vendor_address ?? '';
            }

            if($agent = $model->jo_agent_id){
                $model->jo_agent_name = VendorFacades::find($agent)->vendor_name ?? '';
                $model->jo_agent_address = VendorFacades::find($agent)->vendor_address ?? '';
            }

            if($receiver = $model->jo_receiver_id){
                $model->jo_receiver_name = VendorFacades::find($receiver)->vendor_name ?? '';
                $model->jo_receiver_address = VendorFacades::find($receiver)->vendor_address ?? '';
                $model->jo_receiver_npwp = VendorFacades::find($receiver)->vendor_npwp ?? '';
            }

            if($notify_party = $model->jo_notify_party_id){
                $model->jo_notify_party_name = VendorFacades::find($notify_party)->vendor_name ?? '';
                $model->jo_notify_party_address = VendorFacades::find($notify_party)->vendor_address ?? '';
            }

		});
	}
}
