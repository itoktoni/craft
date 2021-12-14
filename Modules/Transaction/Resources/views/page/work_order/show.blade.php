@extends(Views::backend())

@section('content')

<div class="row">
    <div class="panel-body">
        <div class="panel panel-default">
            <header class="panel-heading">
                <h2 class="panel-title">{{ __('Show') }} {{ __($form_name) }} : {{ $model->{$model->getKeyName()} }}
                </h2>
            </header>

            <div class="panel-body line">
                <div class="show">
                    <table class="table table-table table-bordered table-striped table-hover mb-none">
                        <tbody>

                            <tr>
                                <th class="col-lg-2">Sales Code</th>
                                <td>{{ $model->mask_so_code }}</td>
                            </tr>
                            <tr>
                                <th class="col-lg-2">Created At</th>
                                <td>{{ $model->mask_created_at }}</td>
                            </tr>
                            <tr>
                                <th class="col-lg-2">Total Value</th>
                                <td>{{ Helper::createRupiah($model->mask_value) }}</td>
                            </tr>
                            <tr>
                                <th class="col-lg-2">Total Discount</th>
                                <td>{{ Helper::createRupiah($model->mask_discount) }}</td>
                            </tr>
                            <tr>
                                <th class="col-lg-2">Grand Total</th>
                                <td>{{ Helper::createRupiah($model->mask_total) }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="panel-body line">
                <table id="transaction" class="table table-no-more table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-left col-md-1">ID</th>
                            <th class="text-left col-md-4">Product Name</th>
                            <th class="text-right col-md-1">Qty</th>
                            <th class="text-right col-md-1">price</th>
                            <th class="text-right col-md-3">Total</th>
                        </tr>
                    </thead>
                    <tbody class="markup">
                        @if(!empty($detail) || old('detail'))
                        @foreach (old('detail') ?? $detail as $item)
                        <tr>
                            <td data-title="ID Product">
                                {{ $item['temp_id'] ?? $item->mask_product_id }}
                            </td>
                            <td data-title="Product">
                                {{ $item->mask_product_name }}
                            </td>
                            <td data-title="Qty" class="text-right col-lg-1">
                                {{ $item->mask_qty }}
                            </td>

                            <td data-title="Price" class="text-right col-lg-1">
                                 {{ Helper::createRupiah($item->mask_price) }}
                            </td>

                            <td data-title="Total" class="text-right col-lg-3">
                                {{ Helper::createRupiah($item->mask_total) }}
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" class="text-right">Total</td>
                            <td  class="text-right">{{ Helper::createRupiah($detail->sum('wo_detail_total')) }}</td>
                        </tr>
                        @endisset
                    </tbody>

                </table>
            </div>

            <div class="navbar-fixed-bottom" id="menu_action">
                <div class="text-right action-wrapper">
                    <a id="linkMenu" href="{!! route($route_index) !!}" class="btn btn-warning">{{ __('Back') }}</a>
                    <a id="linkMenu" href="{!! route($module.'_print_wo', ['code' => $model->{$model->getKeyName()}]) !!}" target="_blank" class="btn btn-danger">{{ __('Print') }}</a>
                    @isset($actions['update'])
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    @endisset
                </div>
            </div>

        </div>

        <div class="panel panel-default">
            <header class="panel-heading">
                <h2 class="panel-title">History Pembyaran : {{ $model->{$model->getKeyName()} }} </h2>
            </header>
            <div class="panel-body line">
                <div class="show">
                    <table class="table table-no-more table-bordered table-striped mb-none">
                        <thead>
                            <tr>
                                <th class="text-left col-md-2">Voucher</th>
                                <th class="text-left col-md-2">From</th>
                                <th class="text-left col-md-2">To</th>
                                <th class="text-left col-md-2">Receive</th>
                                <th class="text-left col-md-2">Message</th>
                                <th class="text-left col-md-3">Created Date</th>
                                <th class="text-left col-md-2">Created By</th>
                                <th class="text-right col-md-2">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($model->has_payment)
                            @foreach($model->has_payment as $payment)
                            <tr>
                                <td data-title="Voucher">
                                    {{ $payment->mask_voucher }}
                                </td>
                                <td data-title="From">
                                    {{ $payment->mask_from }}
                                </td>
                                <td data-title="To">
                                    {{ $payment->mask_to }}
                                </td>
                                <td data-title="Receive">
                                    {{ $payment->mask_person }}
                                </td>
                                <td data-title="Message" class="col-lg-1">
                                    {{ $payment->mask_notes_approve }}
                                </td>
                                <td data-title="Created At" class="col-lg-2">
                                    {{ $payment->mask_date }}
                                </td>
                                <td data-title="Created By" class="col-lg-1">
                                    {{ $payment->has_user->name ?? '' }}
                                </td>
                                <td data-title="Amount" class="text-right col-lg-1">
                                    {{ Helper::createRupiah($payment->mask_approve) }}
                                </td>
                            </tr>
                            @endforeach

                            @endif
                        </tbody>

                        <tbody>
                            <tr>
                                <td data-title="Total Pembayaran" colspan="7" class="text-right">
                                    <strong>Total Order</strong>
                                </td>
                                <td data-title="" class="text-right">
                                    {{ Helper::createRupiah($model->mask_total) }}
                                </td>
                            </tr>
                            <tr>
                                <td data-title="Total Pembayaran" colspan="7" class="text-right">
                                    <strong>Total Payment</strong>
                                </td>
                                <td data-title="" class="text-right">
                                    {{ Helper::createRupiah($model->has_payment->sum('payment_value_approve')) }}
                                </td>
                            </tr>
                            <tr>
                                <td data-title="Total Pembayaran" colspan="7" class="text-right">
                                    <strong>UnPaid </strong>
                                </td>
                                <td data-title="" class="text-right">
                                    {{ Helper::createRupiah($model->has_payment->sum('payment_value_approve') - $model->mask_total) }}
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>


        </div>

    </div>

</div>

@endsection