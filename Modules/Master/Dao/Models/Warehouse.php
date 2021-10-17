<?php

namespace Modules\Master\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Warehouse extends Model
{
    protected $table = 'warehouse';
    protected $primaryKey = 'warehouse_id';

    protected $fillable = [
        'warehouse_id',
        'warehouse_name',
        'warehouse_description',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = true;
    public $rules = [
        'warehouse_name' => 'required|min:3',
    ];

    public $searching = 'warehouse_name';
    public $datatable = [
        'warehouse_id' => [false => 'Code', 'width' => 50],
        'warehouse_name' => [true => 'Name'],
        'warehouse_description' => [true => 'Description'],
    ];
}
