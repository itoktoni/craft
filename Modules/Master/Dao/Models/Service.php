<?php

namespace Modules\Master\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Master\Dao\Facades\CategoryFacades;
use Modules\Master\Dao\Facades\ServiceFacades;
use Modules\Master\Dao\Facades\UnitFacades;
use Modules\System\Plugins\Helper;
use Wildside\Userstamps\Userstamps;

class Service extends Model
{
    protected $table = 'service';
    protected $primaryKey = 'service_id';

    protected $fillable = [
        'service_id',
        'service_name',
        'service_buy',
        'service_sell',
        'service_price',
        'service_sku',
        'service_description',
        'service_image',
        'service_category_id',
        'service_tax_code',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = true;
    public $rules = [
        'service_name' => 'required|min:3',
        'service_sku' => 'unique:service',
        'service_buy' => 'required',
        'service_sell' => 'required',
    ];

    protected $casts = [
        'service_buy' => 'integer',
        'service_sell' => 'integer',
        'service_price' => 'integer',
        'service_tax_code' => 'string',
    ];

    public $searching = 'service_name';
    public $datatable = [
        'service_id' => [true => 'Code', 'width' => 50],
        'service_sku' => [true => 'SKU', 'width' => 100],
        'service_name' => [true => 'Name'],
        'service_buy' => [true => 'Buy', 'width' => 100],
        'service_sell' => [true => 'Sell', 'width' => 100],
        'service_price' => [true => 'Price', 'width' => 100],
        'service_image' => [false => 'Image', 'width' => 100, 'class' => 'text-center'],
        'service_description' => [false => 'Image'],
    ];

    public function mask_name()
    {
        return 'service_name';
    }

    public function setMaskNameAttribute($value)
    {
        $this->attributes[$this->mask_name()] = $value;
    }

    public function getMaskNameAttribute()
    {
        return $this->{$this->mask_name()};
    }

    public function mask_price()
    {
        return 'service_price';
    }

    public function setMaskPriceAttribute($value)
    {
        $this->attributes[$this->mask_price()] = $value;
    }

    public function getMaskPriceAttribute()
    {
        return $this->{$this->mask_price()};
    }

    public function getMaskPriceFormatAttribute()
    {
        return Helper::createRupiah($this->{$this->mask_price()});
    }

    public function mask_buy()
    {
        return 'service_buy';
    }

    public function setMaskBuyAttribute($value)
    {
        $this->attributes[$this->mask_buy()] = $value;
    }

    public function getMaskBuyAttribute()
    {
        return $this->{$this->mask_buy()};
    }

    public function getMaskBuyFormatAttribute()
    {
        return Helper::createRupiah($this->{$this->mask_buy()});
    }

    public function mask_sell()
    {
        return 'service_sell';
    }

    public function setMaskSellAttribute($value)
    {
        $this->attributes[$this->mask_sell()] = $value;
    }

    public function getMaskSellAttribute()
    {
        return Helper::createRupiah($this->{$this->mask_sell()});
    }

    public function getMaskSellFormatAttribute()
    {
        return $this->{$this->mask_sell()};
    }

    public function mask_category_id()
    {
        return 'service_category_id';
    }

    public function setMaskCategoryIdAttribute($value)
    {
        $this->attributes[$this->mask_category_id()] = $value;
    }

    public function getMaskCategoryIdAttribute()
    {
        return $this->{$this->mask_category_id()};
    }

    public function mask_description()
    {
        return 'service_description';
    }

    public function setMaskDescriptionAttribute($value)
    {
        $this->attributes[$this->mask_description()] = $value;
    }

    public function getMaskDescriptionAttribute()
    {
        return $this->{$this->mask_description()};
    }

    public static function boot()
    {
        parent::saving(function ($model) {
            $file_name = 'file';
            if (request()->has($file_name)) {
                $file = request()->file($file_name);
                $name = Helper::uploadImage($file, Helper::getTemplate(__CLASS__));
                $model->service_image = $name;
            }
            $model->service_price = $model->service_sell + (($model->service_sell * $model->service_tax_code) / 100);
        });

        parent::boot();
    }

    public function has_category()
    {
        return $this->hasOne(Category::class, CategoryFacades::getKeyName(), $this->mask_category_id());
    }
}
