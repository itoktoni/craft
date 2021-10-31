<div class="form-group">

    {!! Form::label('name', __('Customer'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('stock_customer_id') ? 'has-error' : ''}}">
        {{ Form::select('stock_customer_id', $customer, $model->stock_customer_id ?? 1, ['class'=> 'form-control ']) }}
        {!! $errors->first('stock_customer_id', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Product'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('stock_product_id') ? 'has-error' : ''}}">
        {{ Form::select('stock_product_id', $product, $model->stock_product_id ?? 1, ['class'=> 'form-control ']) }}
        {!! $errors->first('stock_product_id', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="form-group">

    {!! Form::label('name', __('Warehouse'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('stock_warehouse_id') ? 'has-error' : ''}}">
        {{ Form::select('stock_warehouse_id', $warehouse, $model->stock_warehouse_id ?? 1, ['class'=> 'form-control ']) }}
        {!! $errors->first('stock_warehouse_id', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Location'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('stock_location_id') ? 'has-error' : ''}}">
        {{ Form::select('stock_location_id', $location, $model->stock_location_id ?? 1, ['class'=> 'form-control ']) }}
        {!! $errors->first('stock_location_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<hr>

<div class="form-group">

    {!! Form::label('name', __('Sales Order'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
    <div class="col-md-3 col-sm-3 {{ $errors->has('stock_so_code') ? 'has-error' : ''}}">
        {{ Form::text('stock_so_code',  null, ['class'=> 'form-control', 'readonly']) }}
        {!! $errors->first('stock_so_code', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Work Order'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
    <div class="col-md-3 col-sm-3 {{ $errors->has('stock_wo_code') ? 'has-error' : ''}}">
        {{ Form::text('stock_wo_code', null, ['class'=> 'form-control', 'readonly']) }}
        {!! $errors->first('stock_wo_code', '<p class="help-block">:message</p>') !!}
    </div>
    
    {!! Form::label('name', __('Qty'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
    <div class="col-md-3 col-sm-3">
        {!! Form::text('stock_qty', null, ['class' => 'form-control']) !!}
    </div>

</div>
