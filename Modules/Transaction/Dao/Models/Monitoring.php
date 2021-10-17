<?php

namespace Modules\Transaction\Dao\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kirschbaum\PowerJoins\PowerJoins;
use Modules\Master\Dao\Facades\PaymentFacades;
use Modules\Master\Dao\Facades\SupplierFacades;
use Modules\Master\Dao\Models\Payment;
use Modules\Master\Dao\Models\Supplier;
use Modules\System\Dao\Facades\TeamFacades;
use Modules\System\Plugins\Helper;
use Modules\Transaction\Dao\Facades\SalesDetailFacades;
use Modules\Transaction\Dao\Facades\SalesFacades;
use Modules\Transaction\Dao\Facades\SoDetailFacades;
use Modules\Transaction\Dao\Facades\SoFacades;
use Modules\Transaction\Dao\Facades\WoDetailFacades;
use Modules\Transaction\Dao\Facades\WoFacades;
use Wildside\Userstamps\Userstamps;

class Monitoring extends Model
{
    use SoftDeletes, Userstamps, PowerJoins;

    protected $table = 'monitoring';
    protected $primaryKey = 'monitoring_id';

    protected $fillable = [
        'monitoring_created_at',
        'monitoring_updated_at',
        'monitoring_deleted_at',
        'monitoring_created_by',
        'monitoring_updated_by',
        'monitoring_deleted_by',
        'monitoring_status',
        'monitoring_notes',
        'monitoring_wo_code',
    ];

    // public $with = ['has_detail', 'has_supplier'];

    public $timestamps = true;
    public $incrementing = false;
    public $rules = [
        'monitoring_notes' => 'required|min:2',
    ];

    const CREATED_AT = 'monitoring_created_at';
    const UPDATED_AT = 'monitoring_updated_at';
    const DELETED_AT = 'monitoring_deleted_at';

    const CREATED_BY = 'monitoring_created_by';
    const UPDATED_BY = 'monitoring_updated_by';
    const DELETED_BY = 'monitoring_deleted_by';

    public $searching = 'monitoring_notes';
    public $datatable = [
        'monitoring_id' => [false => 'Monitoring Id'],
        'monitoring_wo_code' => [true => 'Wo Code'],
        'monitoring_notes' => [true => 'Notes'],
        'monitoring_status' => [true => 'Status', 'width' => 70, 'class' => 'text-center', 'status' => 'status'],
    ];

    protected $casts = [
        'monitoring_created_at' => 'datetime:Y-m-d',
    ];

    public function mask_status()
    {
        return 'monitoring_status';
    }

    public function setMaskStatusAttribute($value)
    {
        $this->attributes[$this->mask_status()] = $value;
    }

    public function getMaskStatusAttribute()
    {
        return $this->{$this->mask_status()};
    }

    public function mask_wo_code()
    {
        return 'monitoring_wo_code';
    }

    public function setMaskWoCodeAttribute($value)
    {
        $this->attributes[$this->mask_wo_code()] = $value;
    }

    public function getMaskWoCodeAttribute()
    {
        return $this->{$this->mask_wo_code()};
    }

    public function mask_notes()
    {
        return 'monitoring_notes';
    }

    public function setMaskNotesAttribute($value)
    {
        $this->attributes[$this->mask_notes()] = $value;
    }

    public function getMaskNotesAttribute()
    {
        return $this->{$this->mask_notes()};
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

    public function getMaskCreatedNameAttribute()
    {
        return $this->has_user->name ?? '';
    }

    public function has_detail()
    {
        return $this->hasMany(WoDetail::class, WoDetailFacades::mask_monitoring_code(), WoFacades::getKeyName());
    }

    public function has_user()
    {
        return $this->hasone(User::class, TeamFacades::getKeyName(), $this->mask_created_by());
    }
}
