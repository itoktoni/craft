<table id="transaction" class="table table-no-more table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-left col-md-1">ID</th>
            <th class="text-left col-md-4">Product Name</th>
            <th class="text-right col-md-1">Request</th>
            <th class="text-right col-md-1">Sent</th>
            <th class="text-right col-md-1">Receive</th>
        </tr>
    </thead>
    <tbody class="markup">
        @if(!empty($detail) || old('detail'))
        @foreach (old('detail') ?? $detail as $item)
        <tr>
            <td data-title="ID Product">
                <input type="text" readonly class="form-control input-sm" value="{{ $item['temp_id'] ?? $item->mask_product_id }}">
                <input type="hidden" value="{{ $item['temp_id'] ?? $item->mask_product_id }}" name="temp_id[]">
                <input type="hidden" value="{{ $item['temp_id'] ?? $item->mask_product_id }}" name="detail[{{ $loop->index }}][temp_id]">
            </td>
            <td data-title="Product">
                <input type="text" readonly class="form-control input-sm" value="{{ $item['temp_product'] ?? $item->mask_product_name }}" name="detail[{{ $loop->index }}][temp_product]">
            </td>
            <td data-title="Request" class="text-right col-lg-1">
                <input type="text" tabindex="{{ $loop->iteration }}1" readonly name="detail[{{ $loop->index }}][temp_qty]" class="form-control input-sm text-right number temp_qty" value="{{ $item['temp_qty'] ?? $item->mask_qty }}">

            </td>
            <td data-title="Sent" class="text-right col-lg-1">
                <input type="text" tabindex="{{ $loop->iteration }}1" readonly name="detail[{{ $loop->index }}][temp_sent]" class="form-control input-sm text-right number temp_sent" value="{{ $item['temp_sent'] ?? $item->mask_sent }}">
            </td> 
            <td data-title="Receive" class="text-right col-lg-1">
                <input type="text" tabindex="{{ $loop->iteration }}1" name="detail[{{ $loop->index }}][temp_receive]" class="form-control input-sm text-right number temp_receive" value="{{ $item['temp_receive'] ?? $item->mask_receive }}">
            </td>
        </tr>
        @endforeach
        @endisset
    </tbody>

</table>