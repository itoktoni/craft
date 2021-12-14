<?php

namespace Modules\Transaction\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Master\Dao\Repositories\ProductRepository;
use Modules\System\Dao\Enums\GroupUserStatus;
use Modules\System\Dao\Repositories\TeamRepository;
use Modules\Transaction\Dao\Repositories\BranchRepository;
use Modules\Transaction\Dao\Repositories\JobRepository;
use Modules\Transaction\Dao\Repositories\SupplierRepository;
use Modules\Transaction\Http\Requests\JobRequest;
use Modules\Transaction\Http\Services\JobCreateService;
use Modules\Transaction\Http\Services\JobUpdateService;
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
use Modules\Master\Dao\Repositories\CompanyRepository;
use Modules\Master\Dao\Repositories\PaymentRepository;
use Modules\Master\Dao\Repositories\ServiceRepository;
use Modules\Master\Dao\Repositories\TruckingRepository;
use Modules\Master\Dao\Repositories\UnitRepository;
use Modules\Master\Dao\Repositories\VendorRepository;
use Modules\System\Http\Services\CreateService;
use Modules\Transaction\Dao\Enums\ServiceStatus;
use Modules\Transaction\Dao\Repositories\JoRepository;
use Modules\Transaction\Http\Requests\PaymentRequest;
use Modules\Transaction\Http\Requests\JoRequest;
use Modules\Transaction\Http\Services\JoCreateService;
use Modules\Transaction\Http\Services\JoUpdateService;
use PHPUnit\TextUI\Help;

class JobOrderController extends Controller
{
    public static $template;
    public static $service;
    public static $model;

    public function __construct(JoRepository $model, SingleService $service)
    {
        self::$model = self::$model ?? $model;
        self::$service = self::$service ?? $service;
    }

    private function share($data = [])
    {
        $product = Views::option(new ServiceRepository());
        $trucking = Views::option(new TruckingRepository());
        $company = Views::option(new CompanyRepository());
        $unit = Views::option(new UnitRepository());
        $status = ServiceStatus::getOptions();

        if (auth()->user()->group_user == GroupUserStatus::Customer) {

            $customer = [auth()->user()->id => auth()->user()->name];

        } else {

            $customer = Views::option(new TeamRepository());
        }

        $view = [
            'unit' => $unit,
            'company' => $company,
            'trucking' => $trucking,
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

    public function listTemplate()
    {
        return view(Views::index())->with([
            'fields' => Helper::listData(self::$model->datatable),
        ]);
    }

    public function create()
    {
        return view(Views::create())->with($this->share());
    }

    public function save(JoRequest $request, JoCreateService $service)
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
                self::$model->mask_status() => ServiceStatus::class
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

    public function update($code, JoRequest $request, JoUpdateService $service)
    {
        $data = $service->update(self::$model, $request, $code);
        return Response::redirectBack();
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

    public function print($code)
    {
        $data = $this->get($code, ['has_customer', 'has_detail', 'has_detail.has_product']);

        $passing = [
            'job_order' => $data,
            'job_detail' => $data->has_detail,
            'bank' => Views::option(new BankRepository(), false, true)
        ];

        // return view(Helper::setViewPrint(__FUNCTION__.'_jo', config('folder')), $passing);
        $pdf = PDF::loadView(Helper::setViewPrint(__FUNCTION__ . '_jo', config('folder')), $passing);
        return $pdf->stream();
    }
}
