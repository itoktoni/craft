<?php

namespace Modules\Master\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Supplier extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'supplier_id';

    protected $fillable = [
        'supplier_id',
        'supplier_name',
        'supplier_description',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = true;
    public $rules = [
        'supplier_name' => 'required|min:3',
    ];

    public $searching = 'supplier_name';
    public $datatable = [
        'supplier_id' => [false => 'Code', 'width' => 50],
        'supplier_name' => [true => 'Name'],
        'supplier_description' => [true => 'Description'],
    ];

    public function mask_name()
    {
        return 'supplier_name';
    }

    public function setMaskNameAttribute($value)
    {
        $this->attributes[$this->mask_name()] = $value;
    }

    public function getMaskNameAttribute()
    {
        return $this->{$this->mask_name()};
    }

    public function mask_address()
    {
        return 'supplier_address';
    }

    public function setMaskAddressAttribute($value)
    {
        $this->attributes[$this->mask_address()] = $value;
    }

    public function getMaskAddressAttribute()
    {
        return $this->{$this->mask_address()};
    }
}
