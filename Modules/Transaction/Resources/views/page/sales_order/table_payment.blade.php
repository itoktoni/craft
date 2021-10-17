@if(!empty($detail))
<table id="transaction" class="table table-no-more table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-center col-md-1">Status</th>
            <th class="text-left col-md-1">Voucher</th>
            <th class="text-left col-md-1">Date</th>
            <th class="text-left col-md-1">Bank From</th>
            <th class="text-left col-md-1">Bank To</th>
            <th class="text-left col-md-1">Person</th>
            <th class="text-right col-md-1">Amount</th>
            <th class="text-left col-md-2">Notes</th>
            <th class="text-right col-md-1">Approve</th>
        </tr>
    </thead>
    <tbody class="markup">
        @foreach ($detail as $item)
        <tr>
            <td data-title="Status" class="text-center">
                <button class="btn btn-primary btn-xs btn-block">{{ $payment::getDescription($item->mask_status) }}</button>
            </td>
            <td data-title="ID Product">
                {{ $item->mask_voucher }}
            </td>
            <td data-title="Date">
                {{ $item->mask_date }}
            </td>
            <td data-title="Bank From" class="col-lg-1">
                {{ $item->mask_from }}
            </td>
            <td data-title="Bank To" class="col-lg-1">
                {{ $item->mask_to }}
            </td>
            <td data-title="Person" class="col-lg-1">
                {{ $item->mask_person }}
            </td> 
            <td data-title="Amount" class="text-right col-lg-1">
                {{ Helper::createRupiah($item->mask_amount) }}
            </td>
            <td data-title="Notes" class="col-lg-1">
                {{ $item->mask_notes_approve }}
            </td>
            <td data-title="Total" class="text-right col-lg-1">
                {{ Helper::createRupiah($item->mask_approve) }}
            </td>
        </tr>
        @endforeach
    </tbody>

    <tbody>
        <tr>
            <td data-title="Total Pembayaran" colspan="8" class="text-right">
                <strong>Total Order</strong>
            </td>
            <td data-title="" class="text-right">
                {{ Helper::createRupiah($model->mask_total) }}
            </td>
        </tr>
        <tr>
            <td data-title="Total Pembayaran" colspan="8" class="text-right">
                <strong>Pembayaran</strong>
            </td>
            <td data-title="" class="text-right">
                {{ Helper::createRupiah($detail->sum('payment_value_approve')) }}
            </td>
        </tr>
        <tr>
            <td data-title="Total Pembayaran" colspan="8" class="text-right">
                <strong>Sisa Pembayaran</strong>
            </td>
            <td data-title="" class="text-right">
                {{ Helper::createRupiah($model->mask_total - $detail->sum('payment_value_approve')) }}
            </td>
        </tr>
    </tbody>
</table>
@endif
