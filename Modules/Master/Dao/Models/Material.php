<?php

namespace Modules\Master\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Material extends Model
{
    protected $table = 'material';
    protected $primaryKey = 'material_id';

    protected $fillable = [
        'material_id',
        'material_name',
        'material_description',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = true;
    public $rules = [
        'material_name' => 'required|min:3',
    ];

    public $searching = 'material_name';
    public $datatable = [
        'material_id' => [false => 'Code', 'width' => 50],
        'material_name' => [true => 'Name'],
        'material_description' => [true => 'Description'],
    ];
}
