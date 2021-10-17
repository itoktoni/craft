<?php

namespace Modules\Master\Http\Services;

use Illuminate\Support\Facades\DB;
use Modules\Master\Http\Resources\LinenCollection;
use Yajra\DataTables\Facades\DataTables;
use Modules\System\Http\Services\DataService;

class LinenDataService extends DataService
{
    public function make()
    {
        $this->setFilter();

        if (!request()->ajax()) {

            $pagination = request()->get('page') ? $this->filter->paginate(request()->get('limit') ?? config('website.pagination')) : $this->filter->get();
            return new LinenCollection($pagination);
        }
        DB::enableQueryLog();

        $request = request()->all();
        $filter = $this->filter;
        $filter = $filter->filter();

        if($rfid = $request['master_linen_rfid']){
            $filter = $filter->where('master_linen_rfid', $rfid);
        }
        if($company = $request['master_linen_company_id']){
            $filter = $filter->where('master_linen_company_id', $company);
        }
        if($location = $request['master_linen_location_id']){
            $filter = $filter->where('master_linen_location_id', $location);
        }
        if($product = $request['master_linen_product_id']){
            $filter = $filter->where('master_linen_product_id', $product);
        }
        if($create = $request['master_linen_created_at']){
            $filter = $filter->whereDate('master_linen_created_at', $create);
        }
        if($register = $request['master_linen_created_by']){
            $filter = $filter->where('master_linen_created_by', $register);
        }
        if($status = $request['status']){
            $filter = $filter->where('master_linen_status', $status);
        }
        if($rent = $request['rent']){
            $filter = $filter->where('master_linen_rent', $rent);
        }
        if($latest = $request['latest']){
            $filter = $filter->where('master_linen_latest', $latest);
        }
        
        $this->datatable = Datatables::of($this->filter);
        $this->setAction();
        $this->setStatus();
        $this->setImage();
        $this->datatable->rawColumns($this->column);
        return $this->datatable->make(true);
    }
}
