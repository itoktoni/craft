<?php

namespace Modules\Transaction\Dao\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kirschbaum\PowerJoins\PowerJoins;
use Mehradsadeghi\FilterQueryString\FilterQueryString;
use Modules\Master\Dao\Facades\PaymentFacades;
use Modules\Master\Dao\Models\Payment;
use Modules\System\Dao\Facades\TeamFacades;
use Modules\System\Plugins\Helper;
use Modules\Transaction\Dao\Facades\JoFacades;
use Modules\Transaction\Dao\Facades\MonitoringFacades;
use Modules\Transaction\Dao\Facades\SalesDetailFacades;
use Modules\Transaction\Dao\Facades\SalesFacades;
use Modules\Transaction\Dao\Facades\SoDetailFacades;
use Modules\Transaction\Dao\Facades\SoFacades;
use Modules\Transaction\Dao\Facades\SupplierFacades;
use Wildside\Userstamps\Userstamps;

class So extends Model
{
    use SoftDeletes, Userstamps, PowerJoins, FilterQueryString;

    protected $table = 'so';
    protected $primaryKey = 'so_code';
    protected $primaryType = 'string';

    protected $fillable = [
        'so_code',
        'so_created_at',
        'so_updated_at',
        'so_processed_at',
        'so_delivered_at',
        'so_deleted_at',
        'so_processed_at',
        'so_delivered_at',
        'so_created_by',
        'so_updated_by',
        'so_deleted_by',
        'so_code_delivery',
        'so_code_invoice',
        'so_customer_id',
        'so_status',
        'so_notes_internal',
        'so_notes_external',
        'so_discount_name',
        'so_discount_value',
        'so_sum_value',
        'so_sum_discount',
        'so_sum_total',
        'so_company_id',
        'so_company_name',
        'so_company_address',
        'so_job_code',
    ];

    public $with = ['has_detail'];

    public $timestamps = true;
    public $incrementing = false;
    public $rules = [
        'so_code' => 'required|min:3',
    ];

    const CREATED_AT = 'so_created_at';
    const UPDATED_AT = 'so_updated_at';
    const DELETED_AT = 'so_deleted_at';

    const CREATED_BY = 'so_created_by';
    const UPDATED_BY = 'so_updated_by';
    const DELETED_BY = 'so_deleted_by';

    public $searching = 'so_code';
    public $datatable = [
        'so_code' => [true => 'Code'],
        'name' => [true => 'Customer'],
        'so_company_id' => [false => 'Company'],
        'so_customer_id' => [false => 'Company'],
        'so_company_name' => [true => 'Company'],
        'so_created_at' => [true => 'Created At'],
        'so_sum_value' => [true => 'Total Value'],
        'so_sum_discount' => [true => 'Discount'],
        'so_sum_total' => [true => 'Grand Total'],
        'so_status' => [true => 'Status', 'width' => 50, 'class' => 'text-center', 'status' => 'status'],
    ];

    protected $filters = [
        'so_company_id',
        'so_customer_id'
    ];

    protected $casts = [
        'so_date_order' => 'datetime:Y-m-d',
        'so_created_at' => 'datetime:Y-m-d',
    ];

    public function mask_status()
    {
        return 'so_status';
    }

    public function setMaskStatusAttribute($value)
    {
        $this->attributes[$this->mask_status()] = $value;
    }

    public function getMaskStatusAttribute()
    {
        return $this->{$this->mask_status()};
    }

    public function mask_total()
    {
        return 'so_sum_total';
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
        return 'so_sum_value';
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
        return 'so_sum_discount';
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
        return 'so_customer_id';
    }

    public function setCustomerIdAttribute($value)
    {
        $this->attributes[$this->mask_customer_id()] = $value;
    }

    public function getCustomerIdAttribute()
    {
        return $this->{$this->mask_customer_id()};
    }

    public function mask_company_id()
    {
        return 'so_company_id';
    }

    public function setCompanyIdAttribute($value)
    {
        $this->attributes[$this->mask_company_id()] = $value;
    }

    public function getCompanyIdAttribute()
    {
        return $this->{$this->mask_company_id()};
    }

    public function mask_jo_code()
    {
        return 'so_jo_code';
    }

    public function setJoCodeAttribute($value)
    {
        $this->attributes[$this->mask_jo_code()] = $value;
    }

    public function getJoCodeAttribute()
    {
        return $this->{$this->mask_jo_code()};
    }

    public function getCompanyNameAttribute()
    {
        return $this->so_company_name;
    }
    
    public function getCompanyAddressAttribute()
    {
        return $this->so_company_address;
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

    public function has_detail()
    {
        return $this->hasMany(SoDetail::class, SoDetailFacades::mask_so_code(), SoFacades::getKeyName());
    }

    public function has_customer()
    {
        return $this->hasOne(User::class, TeamFacades::getKeyName(), $this->mask_customer_id());
    }

    public function has_job()
    {
        return $this->hasOne(Jo::class, JoFacades::mask_so_code(), $this->getKeyName());
    }

    public function has_payment()
    {
        return $this->hasMany(Payment::class, PaymentFacades::mask_reference(), $this->getKeyName());
    }

    public function has_monitoring()
    {
        return $this->hasMany(Monitoring::class, MonitoringFacades::mask_so_code(), $this->getKeyName());
    }

    public static function boot()
    {
        parent::saving(function ($model) {
            $company = $model->has_customer->has_company ?? null;
            if($company){
                $model->so_company_id = $company->company_id;
                $model->so_company_name = $company->company_name;
                $model->so_company_address = $company->company_address;
            }
        });

        parent::boot();
    }
}
