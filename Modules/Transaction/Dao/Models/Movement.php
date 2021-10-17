<?php

namespace Modules\Transaction\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kirschbaum\PowerJoins\PowerJoins;
use Modules\Transaction\Dao\Facades\BranchFacades;
use Modules\Transaction\Dao\Facades\MovementFacades;
use Modules\Transaction\Dao\Facades\SupplierFacades;
use Modules\Transaction\Dao\Presenteres\MovementPresenter;
use Wildside\Userstamps\Userstamps;

class Movement extends Model
{
    use SoftDeletes, Userstamps, PowerJoins;

    protected $table = 'movement';
    protected $primaryKey = 'movement_id';

    protected $fillable = [
        'movement_id',
        'movement_created_at',
        'movement_created_by',
        'movement_updated_at',
        'movement_updated_by',
        'movement_deleted_at',
        'movement_deleted_by',
        'movement_date',
        'movement_status',
        'movement_notes',
        'movement_from_id',
        'movement_to_id',
    ];

    // public $with = ['module'];

    public $timestamps = true;
    public $incrementing = false;
    public $rules = [
        'movement_id' => 'required|min:3',
    ];

    const CREATED_AT = 'movement_created_at';
    const UPDATED_AT = 'movement_updated_at';
    const DELETED_AT = 'movement_deleted_at';

    const CREATED_BY = 'movement_created_by';
    const UPDATED_BY = 'movement_updated_by';
    const DELETED_BY = 'movement_deleted_by';

    public $searching = 'movement_id';
    public $datatable = [
        'movement_id' => [false => 'Code'],
        'movement_created_at' => [true => 'Created At'],
        'movement_date' => [true => 'Movement Date'],
        'movement_from_id' => [true => 'Movement From'],
        'movement_to_id' => [true => 'Movement to'],
        'movement_status' => [true => 'Status', 'width' => 100, 'class' => 'text-center'],
    ];

    protected $casts = [
        'movement_date' => 'datetime:Y-m-d',
        'movement_created_at' => 'datetime:Y-m-d',
    ];

    public $status    = [
        '1' => ['Create', 'info'],
        '2' => ['Transfer', 'default'],
        '3' => ['Finish', 'success'],
        '4' => ['Cancel', 'danger'],
    ];

    public function detail_id()
    {
        return 'movement_detail_id';
    }

    public function flag()
    {
        return 'movement_status';
    }

    public function setFlagAttribute($value)
    {
        $this->attributes[$this->flag()] = $value;
    }

    public function getFlagAttribute()
    {
        return $this->{$this->flag()};
    }

    public function branch_from()
    {
        return 'movement_from_id';
    }

    public function setBranchFromAttribute($value)
    {
        $this->attributes[$this->branch_from()] = $value;
    }

    public function getBranchFromAttribute()
    {
        return $this->{$this->branch_from()};
    }

    public function getBranchFromNameAttribute()
    {
        return $this->from->branch_name ?? '';
    }

    public function branch_to()
    {
        return 'movement_to_id';
    }

    public function setBranchToAttribute($value)
    {
        $this->attributes[$this->branch_to()] = $value;
    }

    public function getBranchToAttribute()
    {
        return $this->{$this->branch_to()};
    }
    
    public function getBranchToNameAttribute()
    {
        return $this->to->branch_name ?? '';
    }

    public function detail()
    {
        return $this->hasMany(MovementDetail::class, $this->detail_id(), MovementFacades::getKeyName());
    }

    public function from()
    {
        return $this->hasOne(Branch::class, BranchFacades::getKeyName(), $this->branch_from());
    }

    public function to()
    {
        return $this->hasOne(Branch::class, BranchFacades::getKeyName(), $this->branch_to());
    }
}
