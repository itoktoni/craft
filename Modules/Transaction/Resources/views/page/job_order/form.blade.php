<div class="form-group">
    {!! Form::label('name', __('Customer'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('jo_customer_id') ? 'has-error' : ''}}">
        {{ Form::select('jo_customer_id', $customer, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('jo_customer_id', '<p class="help-block">:message</p>') !!}
    </div>
    @if(auth()->user()->group_user == GroupUserStatus::Developer)
    {!! Form::label('name', __('Status'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('jo_status') ? 'has-error' : ''}}">
        {{ Form::select('jo_status', $status, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('jo_status', '<p class="help-block">:message</p>') !!}
    </div>
    @else
    {!! Form::label('name', __('Last Status'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4">
        <button
            class="btn btn-default btn-block text-left">{{ TransactionStatus::getDescription($model->mask_status) }}</button>
    </div>
    @endif
</div>

<div class="form-group">
    {!! Form::label('name', __('Trucking'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('jo_trucking_id') ? 'has-error' : ''}}">
        {{ Form::select('jo_trucking_id', $trucking, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('jo_trucking_id', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', 'Delivery To', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('jo_delivery_to') ? 'has-error' : ''}}">
        {!! Form::text('jo_delivery_to', null, ['class' => 'form-control']) !!}
        {!! $errors->first('jo_delivery_to', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="form-group">

    {!! Form::label('name', 'Pickup Point', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('jo_delivery_pickup') ? 'has-error' : ''}}">
        {!! Form::text('jo_delivery_pickup', null, ['class' => 'form-control']) !!}
        {!! $errors->first('jo_delivery_pickup', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Notes'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4">
        {!! Form::textarea('jo_notes', null, ['class' => 'form-control', 'rows' => '3']) !!}
    </div>

</div>

<hr>

<div class="form-group">
    {!! Form::label('name', __('ETD'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('jo_etd') ? 'has-error' : ''}}">
        <div class="input-group">
            {!! Form::text('jo_etd', null, ['class' =>
            'form-control date']) !!}
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
        </div>
        {!! $errors->first('jo_etd', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('ETA'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('jo_eta') ? 'has-error' : ''}}">
        <div class="input-group">
            {!! Form::text('jo_eta', null, ['class' =>
            'form-control date']) !!}
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
        </div>
        {!! $errors->first('jo_eta', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="form-group">

    {!! Form::label('name', 'Master BL', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('jo_mater_bl') ? 'has-error' : ''}}">
        {!! Form::text('jo_mater_bl', null, ['class' => 'form-control']) !!}
        {!! $errors->first('jo_mater_bl', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', 'Total Weight', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('jo_total_weight') ? 'has-error' : ''}}">
        {!! Form::text('jo_total_weight', null, ['class' => 'form-control']) !!}
        {!! $errors->first('jo_total_weight', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="form-group">

    {!! Form::label('name', __('Delivery Notes'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4">
        {!! Form::textarea('jo_delivery_notes', null, ['class' => 'form-control', 'rows' => '3']) !!}
    </div>

   

    {!! Form::label('name', 'No. Sales Order', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('jo_so_code') ? 'has-error' : ''}}">
        {!! Form::text('jo_so_code', null, ['class' => 'form-control']) !!}
        {!! $errors->first('jo_so_code', '<p class="help-block">:message</p>') !!}
    </div>

</div>


@include($folder.'::page.'.$template.'.detail')
@include($folder.'::page.'.$template.'.script')