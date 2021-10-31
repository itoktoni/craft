<?php

namespace Modules\Master\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Location extends Model
{
    protected $table = 'location';
    protected $primaryKey = 'location_id';

    protected $fillable = [
        'location_id',
        'location_name',
        'location_warehouse_id',
        'location_description',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = true;
    public $rules = [
        'location_name' => 'required|min:3',
        'location_warehouse_id' => 'required',
    ];

    public $searching = 'location_name';
    public $datatable = [
        'location_id' => [false => 'Code', 'width' => 50],
        'location_name' => [true => 'Name'],
        'location_warehouse_id' => [true => 'Name'],
        'location_description' => [true => 'Description'],
    ];
}
