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
            <td data-title="Qty" class="text-right col-lg-1">
                <input type="text" tabindex="{{ $loop->iteration }}1" name="detail[{{ $loop->index }}][temp_qty]" class="form-control input-sm text-right number temp_qty" value="{{ $item['temp_qty'] ?? $item->mask_qty }}">

            </td>
            <td data-title="Price" class="text-right col-lg-1">
                <input type="text" tabindex="{{ $loop->iteration }}2" name="detail[{{ $loop->index }}][temp_price]" class="form-control input-sm text-right money temp_price" {{ auth()->user()->mask_group_user != GroupUserStatus::Developer ? 'readonly' : '' }} value="{{ $item['temp_price'] ?? $item->mask_price }}">

            </td>
            <td data-title="Total" class="text-right col-lg-1">
                <input type="text" readonly name="detail[{{ $loop->index }}][temp_total]" class="form-control input-sm text-right number temp_total" value="{{ $item['temp_total'] ?? $item->mask_total }}">
            </td>
        </tr>
        @endforeach
        @endisset
    </tbody>

    
    <tbody>
        <tr>
            <td data-title="Sebelum Discount" colspan="4" class="text-right">
                <strong>Total Sebelum Discount</strong>
            </td>
            <td data-title="" class="text-right">
                {!! Form::text('so_sum_value', null, ['id' => 'before_discount',
                'readonly', 'class' => 'number form-control text-right']) !!}
            </td>
        </tr>
        @if(auth()->user()->group_user == GroupUserStatus::Developer)
        <tr style="margin-bottom: 20px;">
            <td data-title="" class="text-left col-md-1 hide-xs">
                <button value="Discount" type="button" class="btn btn-xs btn-success btn-block">Discount</button>
            </td>
            <td data-title="Description" class="text-left col-md-4">
                {!! Form::textarea('so_discount_name', null, ['id' => 'grand_discount_description', 'class' =>
                'form-control', 'rows' => 2, 'tabindex' => 500]) !!}
                
                <small id="passwordHelp" class="text-danger">
                    Discount using Persentage ( % )
                </small>
               
            </td>
            <td data-title="Value" class="text-right col-md-1">
                {!! Form::text('so_discount_value', null, ['class' => 'form-control text-right number', 'id' =>
                'grand_discount_value', 'tabindex' => 501, auth()->user()->mask_group_user != GroupUserStatus::Developer ? 'readonly' : '']) !!}

            </td>
            <td data-title="Discount" class="text-right col-md-1">
                {!! Form::text('so_sum_discount', null, ['id' => 'grand_discount_price',
                'readonly', 'class' => 'number form-control text-right', 'tabindex' => 502]) !!}
            </td>
            <td data-title="Total" class="text-right col-md-1">
                {!! Form::text('so_sum_total', null, ['id' => 'grand_discount_total',
                'readonly', 'class' => 'number form-control text-right']) !!}
            </td>
        </tr>
        @endif

    </tbody>
    
</table>