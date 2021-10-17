<?php

namespace Modules\Master\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Converter extends Model
{
    protected $table = 'converter';
    protected $primaryKey = 'converter_code';

    protected $fillable = [
        'converter_code',
        'converter_name',
        'converter_description',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = true;
    public $rules = [
        'converter_name' => 'required|min:3',
    ];

    public $searching = 'converter_name';
    public $datatable = [
        'converter_code' => [false => 'Code', 'width' => 50],
        'converter_name' => [true => 'Name'],
        'converter_description' => [true => 'Description'],
    ];
}
