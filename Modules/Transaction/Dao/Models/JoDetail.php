<?php

namespace Modules\Transaction\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Master\Dao\Facades\ProductFacades;
use Modules\Master\Dao\Facades\ServiceFacades;
use Modules\Master\Dao\Facades\SupplierFacades;
use Modules\Master\Dao\Models\Product;
use Modules\Master\Dao\Models\Service;
use Modules\Master\Dao\Models\Supplier;

class JoDetail extends Model
{
    protected $table = 'jo_detail';
    protected $primaryKey = 'jo_detail_jo_code';

    protected $fillable = [
        'jo_detail_jo_code',
        'jo_detail_so_code',
        'jo_detail_notes',
        'jo_detail_product_id',
        'jo_detail_product_price',
        'jo_detail_qty',
        'jo_detail_price',
        'jo_detail_total',
        'jo_detail_delivery',
        'jo_detail_receive',
    ];

    public $with = ['has_product'];

    public $timestamps = false;
    public $incrementing = false;
    
    public function mask_so_code()
    {
        return 'jo_detail_so_code';
    }

    public function setMaskSoCodeAttribute($value)
    {
        $this->attributes[$this->mask_so_code()] = $value;
    }

    public function getMaskSoCodeAttribute()
    {
        return $this->{$this->mask_so_code()};
    }    

    public function mask_jo_code()
    {
        return 'jo_detail_jo_code';
    }

    public function setMaskJoCodeAttribute($value)
    {
        $this->attributes[$this->mask_jo_code()] = $value;
    }

    public function getMaskJoCodeAttribute()
    {
        return $this->{$this->mask_jo_code()};
    } 

    public function mask_product_id()
    {
        return 'jo_detail_product_id';
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
        return $this->has_product->mask_name;
    }

    public function mask_product_price()
    {
        return 'jo_detail_product_price';
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
        return 'jo_detail_supplier_id';
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
        return 'jo_detail_qty';
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
        return 'jo_detail_price';
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
        return 'jo_detail_sent';
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
        return 'jo_detail_receive';
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
        return 'jo_detail_total';
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
        return $this->hasOne(Service::class, ServiceFacades::getKeyName(), $this->mask_product_id());
    }

    public function has_supplier()
    {
        return $this->hasOne(Supplier::class, SupplierFacades::getKeyName(), $this->mask_supplier_id());
    }
}
