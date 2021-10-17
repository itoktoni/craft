<?php

namespace Modules\Transaction\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Master\Dao\Repositories\ProductRepository;
use Modules\System\Dao\Enums\GroupUserStatus;
use Modules\System\Dao\Repositories\TeamRepository;
use Modules\Transaction\Dao\Repositories\BranchRepository;
use Modules\Transaction\Dao\Repositories\SalesRepository;
use Modules\Transaction\Dao\Repositories\SupplierRepository;
use Modules\Transaction\Http\Requests\SalesRequest;
use Modules\Transaction\Http\Services\SalesCreateService;
use Modules\Transaction\Http\Services\SalesUpdateService;
use Modules\System\Http\Requests\DeleteRequest;
use Modules\System\Http\Services\DataService;
use Modules\System\Http\Services\DeleteService;
use Modules\System\Http\Services\SingleService;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Response;
use Modules\System\Plugins\Views;
use Modules\Transaction\Dao\Enums\TransactionStatus;
use Barryvdh\DomPDF\Facade as PDF;
use Modules\Master\Dao\Enums\PaymentStatus;
use Modules\Master\Dao\Repositories\BankRepository;
use Modules\Master\Dao\Repositories\PaymentRepository;
use Modules\System\Http\Services\CreateService;
use Modules\Transaction\Dao\Repositories\SoRepository;
use Modules\Transaction\Http\Requests\PaymentRequest;
use Modules\Transaction\Http\Requests\SoRequest;
use Modules\Transaction\Http\Services\SoCreateService;
use Modules\Transaction\Http\Services\SoUpdateService;
use PHPUnit\TextUI\Help;

class SalesOrderController extends Controller
{
    public static $template;
    public static $service;
    public static $model;

    public function __construct(SoRepository $model, SingleService $service)
    {
        self::$model = self::$model ?? $model;
        self::$service = self::$service ?? $service;
    }

    private function share($data = [])
    {
        $product = Views::option(new ProductRepository());
        $status = TransactionStatus::getOptions();

        if (auth()->user()->group_user == GroupUserStatus::Customer) {

            $customer = [auth()->user()->id => auth()->user()->name];
            
        } else {

            $customer = Views::option(new TeamRepository());
        }

        $view = [
            'product' => $product,
            'status' => $status,
            'customer' => $customer,
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

    public function save(SoRequest $request, SoCreateService $service)
    {
        $data = $service->save(self::$model, $request);
        return Response::redirectBack($data);
    }

    public function data(DataService $service)
    {
        return $service
            ->setModel(self::$model)
            ->EditColumn([
                self::$model->mask_value() => 'mask_value_format',
                self::$model->mask_discount() => 'mask_discount_format',
                self::$model->mask_total() => 'mask_total_format',
            ])
            ->EditStatus([
                self::$model->mask_status() => TransactionStatus::class
            ])
            ->EditAction([
                'page'      => config('page'),
                'folder'    => config('folder'),
            ])
            ->make();
    }

    public function edit($code)
    {
        $data = $this->get($code);
        return view(Views::update(config('page'), config('folder')))
            ->with($this->share([
                'model' => $data,
                'detail' => $data->has_detail,
            ]));
    }

    public function update($code, SoRequest $request, SoUpdateService $service)
    {
        $data = $service->update(self::$model, $request, $code);
        return Response::redirectBack($data);
    }

    public function show($code)
    {
        $data = $this->get($code);
        return view(Views::show())->with($this->share([
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

    public function printOrder($code)
    {
        $data = $this->get($code, ['has_customer', 'has_detail', 'has_detail.has_product']);

        $passing = [
            'master' => $data,
            'detail' => $data->has_detail,
            'bank' => Views::option(new BankRepository(), false, true)
        ];
        
        $pdf = PDF::loadView(Helper::setViewPrint(__FUNCTION__, config('folder')), $passing);
        return $pdf->stream();
    }

    public function formPayment($code)
    {
        $data = $this->get($code);
        $bank = Views::option(new BankRepository(),false, true)
        ->pluck('bank_name', 'bank_name')->prepend('- Select Bank - ', '')->toArray();

        return view(Views::form(Helper::snake(__FUNCTION__), config('page'), config('folder')))
            ->with($this->share([
                'model' => $data,
                'bank' => $bank,
                'payment' => PaymentStatus::class,
                'detail' => $data->has_payment ?? false
            ]));
    }

    public function doPayment(PaymentRequest $request, CreateService $service, PaymentRepository $model)
    {   
        $data = $service->save($model, $request);
        return Response::redirectBack($data);
    }
}
