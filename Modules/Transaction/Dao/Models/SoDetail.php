<?php

namespace Modules\Transaction\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Mehradsadeghi\FilterQueryString\FilterQueryString;
use Modules\Master\Dao\Facades\ProductFacades;
use Modules\Master\Dao\Facades\SupplierFacades;
use Modules\Master\Dao\Models\Product;
use Modules\Master\Dao\Models\Supplier;

class SoDetail extends Model
{
    use FilterQueryString;
    
    protected $table = 'so_detail';
    protected $primaryKey = 'so_detail_so_code';
    protected $keyType = 'string';

    protected $fillable = [
        'so_detail_so_code',
        'so_detail_notes',
        'so_detail_product_id',
        'so_detail_supplier_id',
        'so_detail_product_price',
        'so_detail_qty',
        'so_detail_sent',
        'so_detail_price',
        'so_detail_total',
    ];

    protected $filters = [
        'so_company_id',
        'so_customer_id'
    ];

    public $with = ['has_product'];

    public $timestamps = false;
    public $incrementing = true;
    
    public function mask_so_code()
    {
        return 'so_detail_so_code';
    }

    public function setMaskSoCodeAttribute($value)
    {
        $this->attributes[$this->mask_so_code()] = $value;
    }

    public function getMaskSoCodeAttribute()
    {
        return $this->{$this->mask_so_code()};
    }    

    public function mask_product_id()
    {
        return 'so_detail_product_id';
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
        return 'so_detail_product_price';
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
        return 'so_detail_supplier_id';
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
        return 'so_detail_qty';
    }

    public function setMaskQtyAttribute($value)
    {
        $this->attributes[$this->mask_qty()] = $value;
    }

    public function getMaskQtyAttribute()
    {
        return $this->{$this->mask_qty()};
    }

    public function mask_sent()
    {
        return 'so_detail_sent';
    }

    public function setMaskSentAttribute($value)
    {
        $this->attributes[$this->mask_sent()] = $value;
    }

    public function getMaskSentAttribute()
    {
        return $this->{$this->mask_sent()};
    }

    public function mask_price()
    {
        return 'so_detail_price';
    }

    public function setMaskPriceAttribute($value)
    {
        $this->attributes[$this->mask_price()] = $value;
    }

    public function getMaskPriceAttribute()
    {
        return $this->{$this->mask_price()};
    }
    
    public function mask_total()
    {
        return 'so_detail_total';
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
