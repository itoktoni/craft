<?php

namespace Modules\Transaction\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Modules\Master\Dao\Repositories\ProductRepository;
use Modules\Master\Dao\Repositories\SupplierRepository;
use Modules\System\Dao\Repositories\TeamRepository;
use Modules\Transaction\Dao\Enums\SalesStatus;
use Modules\Transaction\Dao\Repositories\BranchRepository;
use Modules\Transaction\Dao\Repositories\WoRepository;
use Modules\Transaction\Http\Requests\SalesRequest;
use Modules\Transaction\Http\Services\SalesCreateService;
use Modules\Transaction\Http\Services\SalesUpdateService;
use Modules\System\Http\Requests\DeleteRequest;
use Modules\System\Http\Requests\GeneralRequest;
use Modules\System\Http\Services\CreateService;
use Modules\System\Http\Services\DataService;
use Modules\System\Http\Services\DeleteService;
use Modules\System\Http\Services\SingleService;
use Modules\System\Http\Services\UpdateService;
use Modules\System\Plugins\Alert;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Response;
use Modules\System\Plugins\Views;
use Modules\Transaction\Dao\Enums\TransactionStatus;
use Modules\Transaction\Dao\Facades\SoFacades;
use Modules\Transaction\Dao\Facades\WoFacades;
use Modules\Transaction\Http\Requests\MonitoringRequest;
use Modules\Transaction\Http\Requests\WoRequest;
use Modules\Transaction\Http\Services\WoCreateService;
use Modules\Transaction\Http\Services\WoUpdateService;
use Barryvdh\DomPDF\Facade as PDF;
use Modules\Master\Dao\Facades\ProductFacades;
use Modules\Master\Dao\Repositories\LocationRepository;
use Modules\Master\Dao\Repositories\WarehouseRepository;
use Modules\System\Dao\Facades\TeamFacades;
use Modules\Transaction\Dao\Facades\MonitoringFacades;
use Modules\Transaction\Http\Requests\WoDeliveryRequest;
use Modules\Transaction\Http\Requests\WoReceiveRequest;
use Modules\Transaction\Http\Services\WoDeliveryService;
use Modules\Transaction\Http\Services\WoReceiveService;

class WorkOrderController extends Controller
{
    public static $template;
    public static $service;
    public static $model;

    public function __construct(WoRepository $model, SingleService $service)
    {
        self::$model = self::$model ?? $model;
        self::$service = self::$service ?? $service;
    }

    private function share($data = [])
    {
        $product = Views::option(new ProductRepository());
        $supplier = Views::option(new SupplierRepository());
        $status = TransactionStatus::getOptions();
        $customer = Views::option(new TeamRepository());
        $location = Views::option(new LocationRepository());
        $order = SoFacades::select(SoFacades::getKeyName())
            ->where(SoFacades::mask_status(), TransactionStatus::Create)
            ->get()->pluck(SoFacades::getKeyName(), SoFacades::getKeyName())
            ->prepend('- Select No. Order -', '');

        $view = [
            'location' => $location,
            'customer' => $customer,
            'supplier' => $supplier,
            'product' => $product,
            'status' => $status,
            'order' => $order,
            'model' => self::$model,
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

    public function save(WoRequest $request, WoCreateService $service)
    {
        $data = $service->save(self::$model, $request);
        return Response::redirectBack($data);
    }

    public function data(DataService $service)
    {
        return $service->setModel(self::$model)
            ->EditColumn([
                self::$model->mask_value() => 'mask_value_format',
                self::$model->mask_discount() => 'mask_discount_format',
                self::$model->mask_total() => 'mask_total_format',
            ])
            ->EditAction([
                'page'      => config('page'),
                'folder'    => config('folder'),
            ])
            ->EditStatus([
                self::$model->mask_status() => TransactionStatus::class
            ])->make();
    }

    public function edit($code)
    {
        $data = $this->get($code);
        return view(Views::update(config('page'), config('folder')))->with($this->share([
            'model' => $data,
            'detail' => $data->has_detail,
        ]));
    }

    public function update($code, WoRequest $request, WoUpdateService $service)
    {
        $data = $service->update(self::$model, $request, $code);
        return Response::redirectBack($data);
    }

    public function show($code)
    {
        $data = $this->get($code, ['has_payment']);
        return view(Views::show(config('page'), config('folder')))->with($this->share([
            'fields' => Helper::listData(self::$model->datatable),
            'model' => $data,
            'detail' => $data->detail ?? []
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

    public function printWo($code)
    {
        $data = $this->get($code, ['has_supplier', 'has_detail', 'has_detail.has_product']);
        $passing = [
            'master' => $data,
            'detail' => $data->has_detail,
            'payment' => $data->has_payment,
        ];
        
        $pdf = PDF::loadView(Helper::setViewPrint(__FUNCTION__, config('folder')), $passing);
        return $pdf->stream();
    }

    public function formMonitoring($code)
    {
        $data = $this->get($code, ['has_supplier', 'has_detail', 'has_detail.has_product']);
        $detail = $data->has_detail->pluck('wo_detail_product_id');
        $product = ProductFacades::WhereIn(ProductFacades::getKeyName(), $detail)->get();
        $status = TransactionStatus::getOptions();

        $monitoring = MonitoringFacades::with('has_product')->where(MonitoringFacades::mask_wo_code(), $code)->get();

        return view(Views::form('monitoring', config('page'), config('folder')))
            ->with($this->share([
                'model' => $data,
                'status' => $status,
                'monitoring' => $monitoring ?? false,
                'product' => $product->pluck(ProductFacades::mask_name(), ProductFacades::getKeyname()),
                'payment' => TransactionStatus::getOptions(),
            ]));
    }

    public function postMonitoring(MonitoringRequest $request, WoRepository $repository)
    {
        $check = false;
        try {
            $check = $repository->monitorRepository($request->all());
            if(isset($check['status']) && $check['status']){

                Alert::create();
            }
            else{
                $message = env('APP_DEBUG') ? $check['data'] : $check['message'];
                Alert::error($message);
            }
        } catch (\Throwable $th) {
            Alert::error($th->getMessage());
            return $th->getMessage();
        }

        return Response::redirectBack($check);
    }

    public function formDelivery($code)
    {
        $data = $this->get($code);
        return view(Views::form('delivery', config('page'), config('folder')))
        ->with($this->share([
            'model' => $data,
            'detail' => $data->has_detail,
            'order' => [$data->mask_so_code => $data->mask_so_code],
            'customer' => [$data->mask_customer_id => $data->mask_customer_name],
            'status' => TransactionStatus::getOptions(TransactionStatus::Process),
        ]));
    }

    // public function doDelivery(WoDeliveryRequest $request, WoDeliveryService $service)
    // {
    //     $data = $service->update(self::$model, $request, $request->code);
    //     return Response::redirectBack($data);
    // }

    // public function printDelivery($code)
    // {
    //     $data = $this->get($code, ['has_customer', 'has_detail', 'has_detail.has_product']);

    //     $passing = [
    //         'master' => $data,
    //         'detail' => $data->has_detail,
    //     ];
        
    //     $pdf = PDF::loadView(Helper::setViewPrint(__FUNCTION__, config('folder')), $passing);
    //     return $pdf->stream();
    // }

    public function formReceive($code)
    {
        $data = $this->get($code);
        return view(Views::form('receive', config('page'), config('folder')))
        ->with($this->share([
            'model' => $data,
            'detail' => $data->has_detail,
            'order' => [$data->mask_so_code => $data->mask_so_code],
            'customer' => [$data->mask_customer_id => $data->mask_customer_name],
            'status' => TransactionStatus::getOptions([
                TransactionStatus::Delivery, TransactionStatus::Complete
            ]),
        ]));
    }

    public function postReceive(WoReceiveRequest $request, WoReceiveService $service)
    {
        $data = $service->update(self::$model, $request, $request->code);
        return Response::redirectBack($data);
    }

    public function printReceive($code)
    {
        $data = $this->get($code, ['has_supplier', 'has_detail', 'has_detail.has_product']);
        $passing = [
            'master' => $data,
            'detail' => $data->has_detail,
        ];
        
        $pdf = PDF::loadView(Helper::setViewPrint(__FUNCTION__, config('folder')), $passing);
        return $pdf->stream();
    }
}
