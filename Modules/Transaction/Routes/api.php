<?php

use Illuminate\Support\Facades\Route;
use Modules\Master\Dao\Repositories\ProductRepository;
use Modules\Master\Dao\Repositories\ServiceRepository;

Route::match(
    [
        'GET',
        'POST'
    ],
    'product_api',
    function () {
        $input = request()->get('id');
        $product = new ProductRepository();
        $query = false;
        if ($input) {
            $query = $product->dataRepository()->where($product->getKeyName(), $input);
            return $query->first()->toArray();
        }
        return $query;
    }
)->name('product_api');

Route::match(
    [
        'GET',
        'POST'
    ],
    'service_api',
    function () {
        $input = request()->get('id');
        $service = new ServiceRepository();
        $query = false;
        if ($input) {
            $query = $service->dataRepository()->where($service->getKeyName(), $input);
            return $query->first()->toArray();
        }
        return $query;
    }
)->name('service_api');