<?php

namespace Modules\Master\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\System\Plugins\Helper;
use Wildside\Userstamps\Userstamps;

class Company extends Model
{
    protected $table = 'company';
    protected $primaryKey = 'company_id';

    protected $fillable = [
        'company_id',
        'company_name',
        'company_type',
        'company_npwp',
        'company_address',
        'company_description',
        'company_logo',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = true;
    public $rules = [
        'company_name' => 'required|min:3',
    ];

    public $searching = 'company_name';
    public $datatable = [
        'company_id' => [false => 'Code', 'width' => 50],
        'company_name' => [true => 'Name'],
        'company_description' => [true => 'Description'],
    ];

    public function mask_name()
    {
        return 'company_name';
    }

    public function setMaskNameAttribute($value)
    {
        $this->attributes[$this->mask_name()] = $value;
    }

    public function getMaskNameAttribute()
    {
        return $this->{$this->mask_name()};
    }

    public static function boot()
    {
        parent::saving(function ($model) {
            $file_name = 'file';
            if (request()->has($file_name)) {
                $file = request()->file($file_name);
                $name = Helper::uploadImage($file, Helper::getTemplate(__CLASS__));
                $model->company_logo = $name;
            }
        });

        parent::boot();
    }
}
