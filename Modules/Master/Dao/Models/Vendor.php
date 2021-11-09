<?php

namespace Modules\Master\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Vendor extends Model
{
    protected $table = 'vendor';
    protected $primaryKey = 'vendor_id';

    protected $fillable = [
        'vendor_id',
        'vendor_name',
        'vendor_type',
        'vendor_npwp',
        'vendor_address',
        'vendor_description',
        'vendor_image',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = true;
    public $rules = [
        'vendor_name' => 'required|min:3',
    ];

    public $searching = 'vendor_name';
    public $datatable = [
        'vendor_id' => [false => 'Code', 'width' => 50],
        'vendor_name' => [true => 'Name'],
        'vendor_description' => [true => 'Description'],
    ];
}
