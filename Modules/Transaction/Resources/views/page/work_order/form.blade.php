<div class="form-group">
    {!! Form::label('name', __('Customer'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('wo_customer_id') ? 'has-error' : ''}}">
        {{ Form::select('wo_customer_id', $customer, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('wo_customer_id', '<p class="help-block">:message</p>') !!}
    </div>
    @if(auth()->user()->group_user == GroupUserStatus::Developer)
    {!! Form::label('name', __('Status'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('wo_status') ? 'has-error' : ''}}">
        {{ Form::select('wo_status', $status, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('wo_status', '<p class="help-block">:message</p>') !!}
    </div>
    @else
    {!! Form::label('name', __('Last Status'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4">
        <button class="btn btn-default btn-block text-left">{{ TransactionStatus::getDescription($model->mask_status) }}</button>
    </div>
    @endif
</div>

<div class="form-group">

    {!! Form::label('name', __('No. Order'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('wo_so_code') ? 'has-error' : ''}}">
        {{ Form::select('wo_so_code', $order, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('wo_so_code', '<p class="help-block">:message</p>') !!}
    </div>
    
    @if(auth()->user()->group_user != GroupUserStatus::Customer)
    {!! Form::label('name', __('Notes'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4">
        {!! Form::textarea('wo_notes_internal', null, ['class' => 'form-control', 'rows' => '3']) !!}
    </div>
    @endif

</div>

<hr>

@include($folder.'::page.'.$template.'.detail')
@include($folder.'::page.'.$template.'.script')