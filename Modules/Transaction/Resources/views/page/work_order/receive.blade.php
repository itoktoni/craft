@extends(Views::backend())

@section('content')

<div class="row">
    <div class="panel-body">
        {!! Form::model($model, ['route'=>[$module.'_post_receive', 'code' =>
        $model->{$model->getKeyName()}],'class'=>'form-horizontal','files'=>true]) !!}
        <div class="panel panel-default">
            <header class="panel-heading">
                <h2 class="panel-title">{{ __('Receive Order') }} : {{ $model->{$model->getKeyName()} }}
                </h2>
            </header>
            <div class="panel-body line">
                <div class="">
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
                        {!! Form::label('name', __('Status'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
                        <div class="col-md-4 col-sm-4 {{ $errors->has('wo_status') ? 'has-error' : ''}}">
                            {{ Form::select('wo_status', [TransactionStatus::Receive => TransactionStatus::getDescription(TransactionStatus::Receive)], null, ['class'=> 'form-control ']) }}
                            {!! $errors->first('wo_status', '<p class="help-block">:message</p>') !!}
                        </div>
                        @endif
                    </div>

                    <div class="form-group">

                        {!! Form::label('name', __('No. Order'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
                        <div class="col-md-4 col-sm-4 {{ $errors->has('wo_so_code') ? 'has-error' : ''}}">
                            {{ Form::select('wo_so_code', $order, null, ['class'=> 'form-control ']) }}
                            {!! $errors->first('wo_so_code', '<p class="help-block">:message</p>') !!}
                        </div>

                        {!! Form::label('name', __('Location'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
                        <div class="col-md-4 col-sm-4 {{ $errors->has('wo_location_id') ? 'has-error' : ''}}">
                            {{ Form::select('wo_location_id', $location, null, ['class'=> 'form-control ']) }}
                            {!! $errors->first('wo_location_id', '<p class="help-block">:message</p>') !!}
                        </div>

                    </div>

                    <div class="form-group">

                        @if(auth()->user()->group_user != GroupUserStatus::Customer)
                        {!! Form::label('name', __('Notes'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
                        <div class="col-md-10 col-sm-10">
                            {!! Form::textarea('wo_notes_internal', null, ['class' => 'form-control', 'rows' => '3'])
                            !!}
                        </div>
                        @endif

                    </div>

                    <hr>

                    @include($folder.'::page.'.$template.'.table_receive')
                </div>
            </div>
        </div>
        <div class="navbar-fixed-bottom" id="menu_action">
            <div class="text-right action-wrapper">
                <a id="linkMenu" href="{!! route($route_index) !!}" class="btn btn-warning">{{ __('Back') }}</a>
                <a id="linkMenu" href="{!! route($module.'_print_receive', ['code' => $model->{$model->getKeyName()}]) !!}" target="_blank" class="btn btn-danger">{{ __('Print') }}</a>
                @isset($actions['form_receive'])
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                @endisset
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>

@endsection