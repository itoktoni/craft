@extends(Views::backend())

@section('content')

<x-date :array="['date']" />

<div class="row">
    <div class="panel-body">
        {!! Form::model($model, ['route'=>[$module.'_post_payment'],'class'=>'form-horizontal','files'=>true]) !!}
        <div class="panel panel-default">
            <header class="panel-heading">
                <h2 class="panel-title">{{ __('Payment') }} {{ __($form_name) }} : {{ $model->{$model->getKeyName()} }}
                </h2>
            </header>
            <div class="panel-body line">
                <div class="">

                    <div class="form-group">

                        {!! Form::label('name', __('Bank From'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
                        <div class="col-md-4 col-sm-4 {{ $errors->has('payment_bank_from') ? 'has-error' : ''}}">
                            {!! Form::text('payment_bank_from', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('payment_bank_from', '<p class="help-block">:message</p>') !!}
                        </div>

                        {!! Form::label('name', __('Bank To'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
                        <div class="col-md-4 col-sm-4 {{ $errors->has('payment_bank_to') ? 'has-error' : ''}}">
                            {{ Form::select('payment_bank_to', $bank, null, ['class'=> 'form-control ']) }}
                            {!! $errors->first('payment_bank_to', '<p class="help-block">:message</p>') !!}
                        </div>

                    </div>

                    <div class="form-group">

                        {!! Form::label('name', __('Person'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
                        <div class="col-md-4 col-sm-4 {{ $errors->has('payment_person') ? 'has-error' : ''}}">
                            {!! Form::text('payment_person', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('payment_person', '<p class="help-block">:message</p>') !!}
                        </div>

                        {!! Form::label('name', __('Date'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
                        <div class="col-md-4 col-sm-4 {{ $errors->has('payment_date') ? 'has-error' : ''}}">
                            <div class="input-group">
                                {!! Form::text('payment_date', $model->payment_date ?? date('Y-m-d'), ['class' =>
                                'form-control date']) !!}
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </div>
                            {!! $errors->first('payment_date', '<p class="help-block">:message</p>') !!}
                        </div>

                    </div>

                    <div class="form-group">

                        {!! Form::label('name', __('Amount'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
                        <div class="col-md-4 col-sm-4 {{ $errors->has('payment_value_user') ? 'has-error' : ''}}">
                            {!! Form::text('payment_value_user', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('payment_value_user', '<p class="help-block">:message</p>') !!}
                        </div>

                        {!! Form::label('name', __('File'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
                        <div class="col-md-4 col-sm-4" {{ $errors->has('file') ? 'has-error' : ''}}">
                            <input type="file" name="file" class="{{ $errors->has('file') ? 'has-error' : ''}} btn btn-default btn-sm btn-block">
                            {!! $errors->first('file', '<p class="help-block">:message</p>') !!}
                        </div>

                    </div>

                    <div class="form-group">

                        {!! Form::label('name', __('Notes'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
                        <div class="col-md-10 col-sm-10 {{ $errors->has('payment_notes_user') ? 'has-error' : ''}}">
                            {!! Form::textarea('payment_notes_user', null, ['class' => 'form-control',
                            'rows' => 3]) !!}
                            {!! $errors->first('payment_notes_user', '<p class="help-block">:message</p>') !!}
                        </div>
                        
                        <input type="hidden" value="{{ $model->{$model->getKeyName()} }}" name="code">

                    </div>
                    
                    <hr>

                    @include($folder.'::page.'.$template.'.table_payment')

                </div>
            </div>
        </div>
        <div class="navbar-fixed-bottom" id="menu_action">
            <div class="text-right action-wrapper">
                <a id="linkMenu" href="{!! route($route_index) !!}" class="btn btn-warning">{{ __('Back') }}</a>
                <a id="linkMenu" href="{!! route('transaction_sales_order_print_order', ['code' => $model->{$model->getKeyName()}]) !!}" target="_blank" class="btn btn-danger">{{ __('Print') }}</a>
                @isset($actions['post_payment'])
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                @endisset
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>

@endsection