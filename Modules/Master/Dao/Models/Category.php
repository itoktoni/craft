<?php

namespace Modules\Master\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'category_id';

    protected $fillable = [
        'category_id',
        'category_name',
        'category_description',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = true;
    public $rules = [
        'category_name' => 'required|min:3',
    ];

    public $searching = 'category_name';
    public $datatable = [
        'category_id' => [false => 'Code', 'width' => 50],
        'category_name' => [true => 'Name'],
        'category_description' => [true => 'Description'],
    ];
}
