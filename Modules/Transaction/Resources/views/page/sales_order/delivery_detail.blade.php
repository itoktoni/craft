<div id="detail" class="panel-body">
    <div class="panel panel-default">
        <div class="row">
            <div class="col-md-6">
                @if ($model->getKeyName() && !old('temp_id'))
                <h2 id="total" class="panel-title text-left">
                    <span id="total_name">Total</span>
                    <span class="money" id="total_value">
                        {{ number_format($detail->sum('so_detail_sent')) }}
                    </span>
                </h2>
                @else
                <h2 id="total" class="panel-title text-left">
                    <span id="total_name">{{ old('total') ? 'Total' : '' }}</span>
                    <span class="money" id="total_value">{{ old('total') ? number_format(old('total')) : '' }}</span>
                    <input type="hidden" id="hidden_total" value="{{ old('total') ? old('total') : 0 }}" name="total">
                </h2>
                @endif
            </div>
           
        </div>
    </div>
</div>

<table id="transaction" class="table table-no-more table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-left col-md-1">ID</th>
            <th class="text-left col-md-4">Product Name</th>
            <th class="text-right col-md-1">Order</th>
            <th class="text-right col-md-1">Delivery</th>
        </tr>
    </thead>
    <tbody class="markup">
        @if(!empty($detail) || old('detail'))
        @foreach (old('detail') ?? $detail as $item)
        <tr>
            <td data-title="ID Product">
                @if(old('detail'))
                <button id="delete" value="{{ $item['temp_id'] }}" type="button" class="btn btn-danger btn-xs btn-block">Delete {{ $item['temp_id'] }}</button>
                @else
                <a id="delete" value="{{ $item->mask_product_id }}" href="{{ route(config('module').'_delete', ['code' => $item->so_detail_id, 'detail' => $item->mask_product_id ]) }}" class="btn btn-danger btn-xs btn-block delete-{{ $item->mask_product_id }}">
                    Delete {{ $item->mask_product_id }}
                </a>
                @endif
                <input type="hidden" value="{{ $item['temp_id'] ?? $item->mask_product_id }}" name="temp_id[]">
                <input type="hidden" value="{{ $item['temp_id'] ?? $item->mask_product_id }}" name="detail[{{ $loop->index }}][temp_id]">
            </td>
            <td data-title="Product">
                <input type="text" readonly class="form-control input-sm" value="{{ $item['temp_product'] ?? $item->mask_product_name }}" name="detail[{{ $loop->index }}][temp_product]">
            </td>
            <td data-title="Order" class="text-right col-lg-1">
                <input type="text" tabindex="{{ $loop->iteration }}1" readonly name="detail[{{ $loop->index }}][temp_qty]" class="form-control input-sm text-right number temp_qty" value="{{ $item['temp_qty'] ?? $item->mask_qty }}">

            </td>
            <td data-title="Delivery" class="text-right col-lg-1">
                <input type="text" tabindex="{{ $loop->iteration }}1" readonly name="detail[{{ $loop->index }}][temp_sent]" class="form-control input-sm text-right number temp_qty" value="{{ $item['temp_sent'] ?? $item->mask_sent }}">

            </td>
        </tr>
        @endforeach
        @endisset
    </tbody>

  
</table>