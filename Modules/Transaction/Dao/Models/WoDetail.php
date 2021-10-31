<?php

namespace Modules\Transaction\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Master\Dao\Facades\ProductFacades;
use Modules\Master\Dao\Facades\SupplierFacades;
use Modules\Master\Dao\Models\Product;
use Modules\Master\Dao\Models\Supplier;

class WoDetail extends Model
{
    protected $table = 'wo_detail';
    protected $primaryKey = 'wo_detail_wo_code';

    protected $fillable = [
        'wo_detail_wo_code',
        'wo_detail_so_code',
        'wo_detail_notes',
        'wo_detail_product_id',
        'wo_detail_supplier_id',
        'wo_detail_product_price',
        'wo_detail_qty',
        'wo_detail_price',
        'wo_detail_total',
        'wo_detail_delivery',
        'wo_detail_receive',
    ];

    public $with = ['has_product'];

    public $timestamps = false;
    public $incrementing = false;
    
    public function mask_so_code()
    {
        return 'wo_detail_so_code';
    }

    public function setMaskSoCodeAttribute($value)
    {
        $this->attributes[$this->mask_so_code()] = $value;
    }

    public function getMaskSoCodeAttribute()
    {
        return $this->{$this->mask_so_code()};
    }    

    public function mask_wo_code()
    {
        return 'wo_detail_wo_code';
    }

    public function setMaskWoCodeAttribute($value)
    {
        $this->attributes[$this->mask_wo_code()] = $value;
    }

    public function getMaskWoCodeAttribute()
    {
        return $this->{$this->mask_wo_code()};
    } 

    public function mask_product_id()
    {
        return 'wo_detail_product_id';
    }

    public function setMaskProductIdAttribute($value)
    {
        $this->attributes[$this->mask_product_id()] = $value;
    }

    public function getMaskProductIdAttribute()
    {
        return $this->{$this->mask_product_id()};
    }

    public function getMaskProductNameAttribute()
    {
        return $this->has_product->product_name;
    }

    public function mask_product_price()
    {
        return 'wo_detail_product_price';
    }

    public function setMaskProductPriceAttribute($value)
    {
        $this->attributes[$this->mask_product_price()] = $value;
    }

    public function getMaskProductPriceAttribute()
    {
        return $this->{$this->mask_product_price()};
    }

    public function mask_supplier_id()
    {
        return 'wo_detail_supplier_id';
    }

    public function setMaskSupplierIdAttribute($value)
    {
        $this->attributes[$this->mask_supplier_id()] = $value;
    }

    public function getMaskSupplierIdAttribute()
    {
        return $this->{$this->mask_supplier_id()};
    }

    public function getMaskSupplierNameAttribute()
    {
        return $this->has_supplier->supplier_name;
    }

    public function mask_qty()
    {
        return 'wo_detail_qty';
    }

    public function setMaskQtyAttribute($value)
    {
        $this->attributes[$this->mask_qty()] = $value;
    }

    public function getMaskQtyAttribute()
    {
        return $this->{$this->mask_qty()};
    }

    public function mask_price()
    {
        return 'wo_detail_price';
    }

    public function setMaskPriceAttribute($value)
    {
        $this->attributes[$this->mask_price()] = $value;
    }

    public function getMaskPriceAttribute()
    {
        return $this->{$this->mask_price()};
    }

    public function mask_sent()
    {
        return 'wo_detail_sent';
    }

    public function setMaskSentAttribute($value)
    {
        $this->attributes[$this->mask_deliver()] = $value;
    }

    public function getMaskSentAttribute()
    {
        return $this->{$this->mask_sent()};
    }

    public function mask_receive()
    {
        return 'wo_detail_receive';
    }

    public function setMaskReceiveAttribute($value)
    {
        $this->attributes[$this->mask_receive()] = $value;
    }

    public function getMaskReceiveAttribute()
    {
        return $this->{$this->mask_receive()};
    }
    
    public function mask_total()
    {
        return 'wo_detail_total';
    }

    public function setMaskTotalAttribute($value)
    {
        $this->attributes[$this->mask_total()] = $value;
    }

    public function getMaskTotalAttribute()
    {
        return $this->{$this->mask_total()};
    }

    public function has_product()
    {
        return $this->hasOne(Product::class, ProductFacades::getKeyName(), $this->mask_product_id());
    }

    public function has_supplier()
    {
        return $this->hasOne(Supplier::class, SupplierFacades::getKeyName(), $this->mask_supplier_id());
    }
}
