<table id="transaction" class="table table-no-more table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-left col-md-1">ID</th>
            <th class="text-left col-md-4">Product Name</th>
            <th class="text-right col-md-1">Qty</th>
            <th class="text-right col-md-2">Price</th>
            <th class="text-right col-md-2">Total</th>
        </tr>
    </thead>
    <tbody class="markup">
        @if(!empty($detail) || old('detail'))
        @foreach (old('detail') ?? $detail as $item)
        <tr>
            <td data-title="ID Product">
                {{ $item->mask_product_id }}
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
            <td data-title="Total" class="text-right col-lg-1">
                {{ Helper::createRupiah($item->mask_total) }}
            </td>
        </tr>
        @if($monitoring)
        @foreach($monitoring as $monitor)
        @if($monitor->monitoring_product_id == $item->mask_product_id)
        <tr>
            <td>Notes :</td>
            <td colspan="2">{{ $monitor->monitoring_notes }}</td>
            <td class="text-right">Status : {{ TransactionStatus::getDescription($monitor->monitoring_status) }}</td>
            <td class="text-right">Date : {{ $monitor->monitoring_created_at }}</td>
        </tr>
        @endif
        @endforeach
        @endif
        @endforeach
        @endif
    </tbody>
  
</table>