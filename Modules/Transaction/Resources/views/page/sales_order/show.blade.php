@extends(Views::backend())

@section('content')

<div class="row">
    <div class="panel-body">
        <div class="panel panel-default">
            <header class="panel-heading">
                <h2 class="panel-title">{{ __('Show') }} {{ __($form_name) }} : {{ $model->{$model->getKeyName()} }}</h2>
            </header>
            <div class="panel-body line">
                <div class="show">
                    <table class="table table-table table-bordered table-striped table-hover mb-none">
                        <tbody>
                            <tr>
                                <th class="col-lg-2">Code</th>
                                <td>{{ $model->{$model->getKeyName()} }}</td>
                            </tr>
                            <tr>
                                <th class="col-lg-2">Company</th>
                                <td>{{ $model->company_name }}</td>
                            </tr>
                            <tr>
                                <th class="col-lg-2">Created At</th>
                                <td>{{ $model->mask_created_at }}</td>
                            </tr>
                            <tr>
                                <th class="col-lg-2">Grand Total</th>
                                <td>{{ Helper::createRupiah($model->mask_total) }}</td>
                            </tr>
                            <tr>
                                <th class="col-lg-2">Total Payment</th>
                                <td>{{ Helper::createRupiah($model->has_payment->sum('payment_value_approve')) }}</td>
                            </tr>
                            <tr>
                                <th class="col-lg-2">UnPaid</th>
                                <td>{{ Helper::createRupiah($model->has_payment->sum('payment_value_approve') - $model->mask_total) }}</td>
                            </tr>
                            <tr>
                                <th class="col-lg-2">Status</th>
                                <td>{{ TransactionStatus::getDescription($model->mask_status) }}</td>
                            </tr>
                        </tbody>
                    </table>

                    @include($folder.'::page.'.$template.'.monitoring')
                </div>
            </div>

            <div class="navbar-fixed-bottom" id="menu_action">
                <div class="text-right action-wrapper">
                    <a id="linkMenu" href="{!! route($route_index) !!}" class="btn btn-warning">{{ __('Back') }}</a>
                    <a id="linkMenu" href="{!! route($module.'_print_order', ['code' => $model->{$model->getKeyName()}]) !!}" target="_blank" class="btn btn-danger">{{ __('Print Order') }}</a>
                    <a id="linkMenu"
                    href="{!! route($module.'_print_invoice', ['code' => $model->{$model->getKeyName()}]) !!}"
                    target="_blank" class="btn btn-success">{{ __('Invoice') }}</a>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection