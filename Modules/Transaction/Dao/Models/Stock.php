<?php

namespace Modules\Transaction\Dao\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kirschbaum\PowerJoins\PowerJoins;
use Modules\Master\Dao\Facades\LocationFacades;
use Modules\Master\Dao\Facades\ProductFacades;
use Modules\Master\Dao\Facades\WarehouseFacades;
use Modules\Master\Dao\Models\Location;
use Modules\Master\Dao\Models\Product;
use Modules\Master\Dao\Models\Warehouse;
use Modules\System\Dao\Facades\TeamFacades;
use Wildside\Userstamps\Userstamps;

class Stock extends Model
{
    use PowerJoins;
    protected $table = 'stock';
    protected $primaryKey = 'stock_customer_id';

    protected $fillable = [
        'stock_customer_id',
        'stock_warehouse_id',
        'stock_location_id',
        'stock_product_id',
        'stock_so_code',
        'stock_wo_code',
        'stock_qty',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = true;
    public $rules = [
        'stock_location_id' => 'required',
    ];

    public $searching = 'stock_location_id';
    public $datatable = [
        'stock_so_code' => [true => 'So Code'],
        'stock_wo_code' => [true => 'Wo Code'],
        'stock_customer_id' => [false => 'Customer'],
        'stock_warehouse_id' => [false => 'Warehouse', 'width' => 50],
        'stock_location_id' => [false => 'Location'],
        'stock_product_id' => [false => 'Product'],
        'name' => [true => 'Customer'],
        'warehouse_name' => [true => 'Warehouse'],
        'location_name' => [true => 'Location'],
        'product_name' => [true => 'Product'],
        'stock_qty' => [true => 'Qty', 'width' => 50],
    ];

    public function mask_wo_code()
    {
        return 'stock_wo_code';
    }

    public function setMaskWoCodeAttribute($value)
    {
        $this->attributes[$this->mask_wo_code()] = $value;
    }

    public function getMaskWoCodeAttribute()
    {
        return $this->{$this->mask_wo_code()};
    }

    public function mask_so_code()
    {
        return 'stock_so_code';
    }

    public function setMaskSoCodeAttribute($value)
    {
        $this->attributes[$this->mask_so_code()] = $value;
    }

    public function getMaskSoCodeAttribute()
    {
        return $this->{$this->mask_so_code()};
    }

    public function mask_customer_id()
    {
        return 'stock_customer_id';
    }

    public function setMaskCustomerIdAttribute($value)
    {
        $this->attributes[$this->mask_customer_id()] = $value;
    }

    public function getMaskCustomerIdAttribute()
    {
        return $this->{$this->mask_customer_id()};
    }

    public function getMaskSupplierNameAttribute()
    {
        return $this->has_supplier->supplier_name ?? '';
    }

    public function mask_location_id()
    {
        return 'stock_location_id';
    }

    public function setMaskLocationIdAttribute($value)
    {
        $this->attributes[$this->mask_location_id()] = $value;
    }

    public function getMaskLocationIdAttribute()
    {
        return $this->{$this->mask_location_id()};
    }

    public function getMaskLocationNameAttribute()
    {
        return $this->has_location->location_name ?? '';
    }

    public function mask_warehouse_id()
    {
        return 'stock_warehouse_id';
    }

    public function setMaskWarehouseIdAttribute($value)
    {
        $this->attributes[$this->mask_warehouse_id()] = $value;
    }

    public function getMaskWarehouseIdAttribute()
    {
        return $this->{$this->mask_warehouse_id()};
    }

    public function getMaskWarehouseNameAttribute()
    {
        return $this->has_warehouse->warehouse_name ?? '';
    }

    public function mask_product_id()
    {
        return 'stock_product_id';
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
        return $this->has_product->product_name ?? '';
    }

    public function mask_qty()
    {
        return 'stock_qty';
    }

    public function setMaskQtyAttribute($value)
    {
        $this->attributes[$this->mask_qty()] = $value;
    }

    public function getMaskQtyAttribute()
    {
        return $this->{$this->mask_qty()};
    }

    public function has_customer()
    {
        return $this->hasone(User::class, TeamFacades::getKeyName(), $this->mask_customer_id());
    }

    public function has_product()
    {
        return $this->hasone(Product::class, ProductFacades::getKeyName(), $this->mask_product_id());
    }

    public function has_warehouse()
    {
        return $this->hasone(Warehouse::class, WarehouseFacades::getKeyName(), $this->mask_warehouse_id());
    }

    public function has_location()
    {
        return $this->hasone(Location::class, LocationFacades::getKeyName(), $this->mask_location_id());
    }

}
