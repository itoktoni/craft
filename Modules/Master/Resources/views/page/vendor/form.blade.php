<div class="form-group">

    {!! Form::label('name', __('Name'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('vendor_name') ? 'has-error' : ''}}">
        {!! Form::text('vendor_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('vendor_name', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Category'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('vendor_type') ? 'has-error' : ''}}">
        {{ Form::select('vendor_type', $status, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('vendor_type', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="form-group">

    {!! Form::label('name', __('Npwp'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('vendor_npwp') ? 'has-error' : ''}}">
        {!! Form::text('vendor_npwp', null, ['class' => 'form-control']) !!}
        {!! $errors->first('vendor_npwp', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Image'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4" {{ $errors->has('product_image') ? 'has-error' : ''}}">
        <input type="hidden" value="{{ $model->vendor_logo ?? null }}" name="vendor_logo">
        <input type="file" name="file"
            class="{{ $errors->has('vendor_logo') ? 'has-error' : ''}} btn btn-default btn-sm btn-block">
        {!! $errors->first('product_image', '<p class="help-block">:message</p>') !!}
    </div>

</div>


<div class="form-group">

    {!! Form::label('name', __('Address'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4">
        {!! Form::textarea('vendor_address', null, ['class' => 'form-control', 'rows' => '3']) !!}
    </div>

    {!! Form::label('name', __('Description'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4">
        {!! Form::textarea('vendor_description', null, ['class' => 'form-control', 'rows' => '3']) !!}
    </div>

</div>