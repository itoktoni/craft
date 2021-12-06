<div class="form-group">
    {!! Form::label('name', __('Customer'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('so_customer_id') ? 'has-error' : ''}}">
        {{ Form::select('so_customer_id', $customer, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('so_customer_id', '<p class="help-block">:message</p>') !!}
    </div>
    @if(auth()->user()->group_user == GroupUserStatus::Developer)
    {!! Form::label('name', __('Status'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('so_status') ? 'has-error' : ''}}">
        {{ Form::select('so_status', $status, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('so_status', '<p class="help-block">:message</p>') !!}
    </div>
    @else
    {!! Form::label('name', __('Last Status'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4">
        <span class="btn btn-default btn-block text-left">{{ $model->mask_status ? TransactionStatus::getDescription($model->mask_status) : 'Create' }}</span>
    </div>
    @endif
</div>

<div class="form-group">

    {!! Form::label('name', __('Customer Notes'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4">
        {!! Form::textarea('so_notes_external', null, ['class' => 'form-control', 'rows' => '3']) !!}
    </div>
    
    @if(auth()->user()->group_user != GroupUserStatus::Customer)
    {!! Form::label('name', __('Internal Notes'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4">
        {!! Form::textarea('so_notes_internal', null, ['class' => 'form-control', 'rows' => '3']) !!}
    </div>
    @endif

</div>

<hr>

@include($folder.'::page.'.$template.'.detail')
@include($folder.'::page.'.$template.'.script')