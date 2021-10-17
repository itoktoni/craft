<?php

namespace Modules\Master\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Master\Dao\Repositories\CategoryRepository;
use Modules\Master\Dao\Repositories\CraftsmanRepository;
use Modules\Master\Dao\Repositories\MaterialRepository;
use Modules\Master\Dao\Repositories\ProductRepository;
use Modules\Master\Dao\Repositories\SizeRepository;
use Modules\Master\Dao\Repositories\SupplierRepository;
use Modules\Master\Dao\Repositories\TaxRepository;
use Modules\Master\Dao\Repositories\UnitRepository;
use Modules\System\Http\Requests\DeleteRequest;
use Modules\System\Http\Requests\GeneralRequest;
use Modules\System\Http\Services\CreateService;
use Modules\System\Http\Services\DataService;
use Modules\System\Http\Services\DeleteService;
use Modules\System\Http\Services\SingleService;
use Modules\System\Http\Services\UpdateService;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Response;
use Modules\System\Plugins\Views;

class ProductController extends Controller
{
    public static $template;
    public static $service;
    public static $model;

    public function __construct(ProductRepository $model, SingleService $service)
    {
        self::$model = self::$model ?? $model;
        self::$service = self::$service ?? $service;
    }

    private function share($data = [])
    {
        $category = Views::option(new CategoryRepository());
        $size = Views::option(new SizeRepository());
        $material = Views::option(new MaterialRepository());
        $unit = Views::option(new UnitRepository());
        $tax = Views::option(new TaxRepository());
        $supplier = Views::option(new SupplierRepository());
        $view = [
            'size' => $size,
            'material' => $material,
            'unit' => $unit,
            'supplier' => $supplier,
            'tax' => $tax,
            'category' => $category,
        ];
        return array_merge($view, $data);
    }

    public function index()
    {
        return view(Views::index())->with([
            'fields' => Helper::listData(self::$model->datatable),
        ]);
    }

    public function create()
    {
        return view(Views::create())->with($this->share());
    }

    public function save(GeneralRequest $request, CreateService $service)
    {
        $data = $service->save(self::$model, $request);
        return Response::redirectBack($data);
    }

    public function data(DataService $service)
    {
        return $service
            ->setModel(self::$model)
            ->EditColumn([
                self::$model->mask_buy() => 'mask_buy_format',
                self::$model->mask_sell() => 'mask_sell_format',
                self::$model->mask_price() => 'mask_price_format',
            ])
            ->make();
    }

    public function edit($code)
    {
        return view(Views::update())->with($this->share([
            'model' => $this->get($code),
        ]));
    }

    public function update($code, GeneralRequest $request, UpdateService $service)
    {
        $data = $service->update(self::$model, $request, $code);
        return Response::redirectBack($data);
    }

    public function show($code)
    {
        return view(Views::show())->with($this->share([
            'fields' => Helper::listData(self::$model->datatable),
            'model' => $this->get($code),
        ]));
    }

    public function get($code = null, $relation = null)
    {
        $relation = $relation ?? request()->get('relation');
        if ($relation) {
            return self::$service->get(self::$model, $code, $relation);
        }
        return self::$service->get(self::$model, $code);
    }

    public function delete(DeleteRequest $request, DeleteService $service)
    {
        $code = $request->get('code');
        $data = $service->delete(self::$model, $code);
        return Response::redirectBack($data);
    }
}
