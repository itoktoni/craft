<?php

namespace Modules\Master\Dao\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'unit';
    protected $primaryKey = 'unit_code';
    protected $keyType = 'string';

    protected $fillable = [
        'unit_code',
        'unit_name',
        'unit_description',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = false;
    public $rules = [
        'unit_code' => 'required',
        'unit_name' => 'required|min:3',
    ];

    public $searching = 'unit_name';
    public $datatable = [
        'unit_code' => [true => 'Code', 'width' => 50],
        'unit_name' => [true => 'Name','width' => 150],
        'unit_description' => [true => 'Description'],
    ];
}
