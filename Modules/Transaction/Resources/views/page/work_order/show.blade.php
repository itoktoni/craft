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

            @include($template_action)

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
                                <th class="text-left col-md-2">Amount</th>
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
                                <td data-title="Amount" class=" col-lg-1">
                                    {{ Helper::createRupiah($payment->mask_approve) }}
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="7">
                                    <h5 class="text-left">Total</h5>
                                </td>
                                <td class="text-left">
                                    {{ Helper::createRupiah($model->has_payment->sum('payment_value_approve')) }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>


        </div>

    </div>

</div>

@endsection