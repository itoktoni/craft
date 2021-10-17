<?php

namespace Modules\Master\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Size extends Model
{
    protected $table = 'size';
    protected $primaryKey = 'size_code';
    protected $keyType = 'string';

    protected $fillable = [
        'size_code',
        'size_name',
        'size_description',
        'size_created_at',
        'size_created_by',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = false;
    public $rules = [
        'size_code' => 'required',
        'size_name' => 'required|min:3',
    ];

    public $searching = 'size_name';
    public $datatable = [
        'size_code' => [true => 'Code', 'width' => 50],
        'size_name' => [true => 'Name','width' => 150],
        'size_description' => [true => 'Description'],
    ];
}
