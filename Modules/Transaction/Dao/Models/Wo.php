<?php

namespace Modules\Transaction\Dao\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kirschbaum\PowerJoins\PowerJoins;
use Mehradsadeghi\FilterQueryString\FilterQueryString;
use Modules\Master\Dao\Facades\PaymentFacades;
use Modules\Master\Dao\Facades\SupplierFacades;
use Modules\Master\Dao\Models\Payment;
use Modules\Master\Dao\Models\Supplier;
use Modules\System\Dao\Facades\TeamFacades;
use Modules\System\Plugins\Helper;
use Modules\Transaction\Dao\Facades\MonitoringFacades;
use Modules\Transaction\Dao\Facades\SalesDetailFacades;
use Modules\Transaction\Dao\Facades\SalesFacades;
use Modules\Transaction\Dao\Facades\SoDetailFacades;
use Modules\Transaction\Dao\Facades\SoFacades;
use Modules\Transaction\Dao\Facades\WoDetailFacades;
use Modules\Transaction\Dao\Facades\WoFacades;
use Wildside\Userstamps\Userstamps;

class Wo extends Model
{
    use SoftDeletes, Userstamps, PowerJoins, FilterQueryString;

    protected $table = 'wo';
    protected $primaryKey = 'wo_code';
    protected $primaryType = 'string';

    protected $fillable = [
        'wo_code',
        'wo_so_code',
        'wo_created_at',
        'wo_updated_at',
        'wo_processed_at',
        'wo_delivered_at',
        'wo_deleted_at',
        'wo_processed_at',
        'wo_delivered_at',
        'wo_created_by',
        'wo_updated_by',
        'wo_deleted_by',
        'wo_code_delivery',
        'wo_code_invoice',
        'wo_customer_id',
        'wo_supplier_id',
        'wo_location_id',
        'wo_status',
        'wo_notes_internal',
        'wo_notes_external',
        'wo_notes_delivery',
        'wo_notes_receive',
        'wo_discount_name',
        'wo_discount_value',
        'wo_sum_value',
        'wo_sum_discount',
        'wo_sum_total',
    ];

    public $with = ['has_detail', 'has_supplier'];

    protected $filters = [
        'wo_supplier_id',
        'wo_customer_id'
    ];

    public $timestamps = true;
    public $incrementing = false;
    public $rules = [
        'wo_code' => 'required|min:3',
    ];

    const CREATED_AT = 'wo_created_at';
    const UPDATED_AT = 'wo_updated_at';
    const DELETED_AT = 'wo_deleted_at';

    const CREATED_BY = 'wo_created_by';
    const UPDATED_BY = 'wo_updated_by';
    const DELETED_BY = 'wo_deleted_by';

    public $searching = 'wo_code';
    public $datatable = [
        'wo_so_code' => [true => 'Sales Code'],
        'wo_code' => [true => 'Wo Code'],
        'wo_customer_id' => [false => 'Supplier Name'],
        'wo_supplier_id' => [false => 'Supplier Name'],
        'supplier_name' => [true => 'Supplier Name'],
        'name' => [true => 'Customer'],
        'wo_created_at' => [true => 'Date', 'width' => 55],
        'wo_sum_value' => [true => 'Value', 'width' => 60],
        'wo_sum_discount' => [true => 'Discount', 'width' => 60],
        'wo_sum_total' => [true => 'Total', 'width' => 60],
        'wo_status' => [true => 'Status', 'width' => 60, 'class' => 'text-center', 'status' => 'status'],
    ];

    protected $casts = [
        'wo_date_order' => 'datetime:Y-m-d',
        'wo_created_at' => 'datetime:Y-m-d',
    ];

    public function mask_status()
    {
        return 'wo_status';
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
        return 'wo_so_code';
    }

    public function setMaskSoCodeAttribute($value)
    {
        $this->attributes[$this->mask_so_code()] = $value;
    }

    public function getMaskSoCodeAttribute()
    {
        return $this->{$this->mask_so_code()};
    }

    public function mask_supplier_id()
    {
        return 'wo_supplier_id';
    }

    public function setMaskSupplierIdAttribute($value)
    {
        $this->attributes[$this->mask_supplier_id()] = $value;
    }

    public function getMaskSupplierIdAttribute()
    {
        return $this->{$this->mask_supplier_id()};
    }

    public function getMaskSupplierNameAttribute()
    {
        return $this->has_supplier->supplier_name ?? '';
    }

    public function mask_location_id()
    {
        return 'wo_location_id';
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
        return 'wo_sum_total';
    }

    public function setMaskTotalAttribute($value)
    {
        $this->attributes[$this->mask_total()] = $value;
    }

    public function getMaskTotalAttribute()
    {
        return $this->{$this->mask_total()};
    }

    public function mask_external()
    {
        return 'wo_notes_external';
    }

    public function setMaskExternalAttribute($value)
    {
        $this->attributes[$this->mask_external()] = $value;
    }

    public function getMaskExternalAttribute()
    {
        return $this->{$this->mask_external()};
    }

    public function mask_internal()
    {
        return 'wo_notes_internal';
    }

    public function setMaskInternalAttribute($value)
    {
        $this->attributes[$this->mask_internal()] = $value;
    }

    public function getMaskInternalAttribute()
    {
        return $this->{$this->mask_internal()};
    }

    public function getMaskTotalFormatAttribute()
    {
        return Helper::createRupiah($this->{$this->mask_total()});
    }

    public function mask_value()
    {
        return 'wo_sum_value';
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
        return 'wo_sum_discount';
    }

    public function setMaskDiscountAttribute($value)
    {
        $this->attributes[$this->mask_discount()] = $value;
    }

    public function getMaskDiscountAttribute()
    {
        return $this->{$this->mask_discount()};
    }

    public function getMaskDiscountFormatAttribute()
    {
        return Helper::createRupiah($this->{$this->mask_discount()});
    }

    public function mask_customer_id()
    {
        return 'wo_customer_id';
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
        return $this->hasMany(WoDetail::class, WoDetailFacades::mask_wo_code(), WoFacades::getKeyName());
    }

    public function has_customer()
    {
        return $this->hasone(User::class, TeamFacades::getKeyName(), $this->mask_customer_id());
    }

    public function has_supplier()
    {
        return $this->hasone(Supplier::class, SupplierFacades::getKeyName(), $this->mask_supplier_id());
    }

    public function has_payment()
    {
        return $this->hasMany(Payment::class, PaymentFacades::mask_reference(), $this->getKeyName());
    }

    public function has_monitoring()
    {
        return $this->hasMany(Monitoring::class, MonitoringFacades::mask_wo_code(), $this->getKeyName());
    }
}
