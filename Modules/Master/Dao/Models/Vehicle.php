<?php

namespace Modules\Master\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Vehicle extends Model
{
    protected $table = 'vehicle';
    protected $primaryKey = 'vehicle_id';

    protected $fillable = [
        'vehicle_id',
        'vehicle_name',
        'vehicle_description',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = true;
    public $rules = [
        'vehicle_name' => 'required|min:3',
    ];

    public $searching = 'vehicle_name';
    public $datatable = [
        'vehicle_id' => [false => 'Code', 'width' => 50],
        'vehicle_name' => [true => 'Name'],
        'vehicle_description' => [true => 'Description'],
    ];
}
