<?php

namespace Modules\Master\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Trucking extends Model
{
    protected $table = 'trucking';
    protected $primaryKey = 'trucking_id';

    protected $fillable = [
        'trucking_id',
        'trucking_name',
        'trucking_description',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = true;
    public $rules = [
        'trucking_name' => 'required|min:3',
    ];

    public $searching = 'trucking_name';
    public $datatable = [
        'trucking_id' => [false => 'Code', 'width' => 50],
        'trucking_name' => [true => 'Name'],
        'trucking_description' => [true => 'Description'],
    ];
}
