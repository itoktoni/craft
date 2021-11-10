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

    {!! Form::label('name', __('Receiver'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('jo_receiver_id') ? 'has-error' : ''}}">
        {{ Form::select('jo_receiver_id', $vendor, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('jo_receiver_id', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Trucking'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('jo_trucking_id') ? 'has-error' : ''}}">
        {{ Form::select('jo_trucking_id', $trucking, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('jo_trucking_id', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="form-group">

    {!! Form::label('name', __('Shipper'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('jo_shipper_id') ? 'has-error' : ''}}">
        {{ Form::select('jo_shipper_id', $vendor, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('jo_shipper_id', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Notify Party'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('jo_notify_party_id') ? 'has-error' : ''}}">
        {{ Form::select('jo_notify_party_id', $vendor, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('jo_notify_party_id', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="form-group">

    {!! Form::label('name', __('Consignee'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('jo_consignee_id') ? 'has-error' : ''}}">
        {{ Form::select('jo_consignee_id', $vendor, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('jo_consignee_id', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Agent'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('jo_agent_id') ? 'has-error' : ''}}">
        {{ Form::select('jo_agent_id', $vendor, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('jo_agent_id', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="form-group">

    {!! Form::label('name', 'Reference Code', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('jo_ref_code') ? 'has-error' : ''}}">
        {!! Form::text('jo_ref_code', null, ['class' => 'form-control']) !!}
        {!! $errors->first('jo_ref_code', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Notes'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4">
        {!! Form::textarea('jo_notes', null, ['class' => 'form-control', 'rows' => '3']) !!}
    </div>

</div>

<hr>

<div class="form-group">

    {!! Form::label('name', 'BL Number', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('jo_master_bl') ? 'has-error' : ''}}">
        {!! Form::text('jo_master_bl', null, ['class' => 'form-control']) !!}
        {!! $errors->first('jo_master_bl', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', 'Vessel', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('jo_vessel') ? 'has-error' : ''}}">
        {!! Form::text('jo_vessel', null, ['class' => 'form-control']) !!}
        {!! $errors->first('jo_vessel', '<p class="help-block">:message</p>') !!}
    </div>

</div>


<div class="form-group">

    {!! Form::label('name', 'Port of loading', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('jo_port_of_delivery') ? 'has-error' : ''}}">
        {!! Form::text('jo_port_of_delivery', null, ['class' => 'form-control']) !!}
        {!! $errors->first('jo_port_of_delivery', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', 'Port of delivery', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('jo_port_of_loading') ? 'has-error' : ''}}">
        {!! Form::text('jo_port_of_loading', null, ['class' => 'form-control']) !!}
        {!! $errors->first('jo_port_of_loading', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="form-group">
    {!! Form::label('name', __('Invoice Date'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('jo_invoice_date') ? 'has-error' : ''}}">
        <div class="input-group">
            {!! Form::text('jo_invoice_date', null, ['class' =>
            'form-control date']) !!}
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
        </div>
        {!! $errors->first('jo_invoice_date', '<p class="help-block">:message</p>') !!}
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

    {!! Form::label('name', 'Total Weight', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('jo_total_weight') ? 'has-error' : ''}}">
        {!! Form::text('jo_total_weight', null, ['class' => 'form-control']) !!}
        {!! $errors->first('jo_total_weight', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Unit'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('jo_unit_code') ? 'has-error' : ''}}">
        {{ Form::select('jo_unit_code', $unit, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('jo_unit_code', '<p class="help-block">:message</p>') !!}
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