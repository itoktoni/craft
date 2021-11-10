@extends(Views::backend())

@section('content')

<div class="row">
    <div class="panel-body">
        {!! Form::model($model, ['route'=>[$module.'_do_delivery'],'class'=>'form-horizontal','files'=>true]) !!}
        <div class="panel panel-default">
            <header class="panel-heading">
                <h2 class="panel-title">{{ __('Delivery') }} {{ __($form_name) }} : {{ $model->{$model->getKeyName()} }}
                </h2>
            </header>
            <div class="panel-body line">
                <div class="">
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
                            <button
                                class="btn btn-default btn-block text-left">{{ TransactionStatus::getDescription($model->mask_status) }}</button>
                        </div>
                        @endif
                    </div>

                    <div class="form-group">

                        {!! Form::label('name', __('Customer Notes'), ['class' => 'col-md-2 col-sm-2 control-label'])
                        !!}
                        <div class="col-md-4 col-sm-4">
                            {!! Form::textarea('so_notes_external', null, ['class' => 'form-control', 'rows' => '3'])
                            !!}
                        </div>

                        @if(auth()->user()->group_user != GroupUserStatus::Customer)
                        {!! Form::label('name', __('Internal Notes'), ['class' => 'col-md-2 col-sm-2 control-label'])
                        !!}
                        <div class="col-md-4 col-sm-4">
                            {!! Form::textarea('so_notes_internal', null, ['class' => 'form-control', 'rows' => '3'])
                            !!}
                        </div>
                        @endif

                    </div>

                    <hr>

                    @include($folder.'::page.'.$template.'.delivery_detail')
                    @include($folder.'::page.'.$template.'.script')
                </div>
            </div>
        </div>
        <div class="navbar-fixed-bottom" id="menu_action">
            <input type="hidden" name="code" value="{{ $model->{$model->getKeyName()} }}">
            <div class="text-right action-wrapper">
                <a id="linkMenu" href="{!! route($route_index) !!}" class="btn btn-warning">{{ __('Back') }}</a>
                <a id="linkMenu"
                    href="{!! route($module.'_print_delivery', ['code' => $model->{$model->getKeyName()}]) !!}"
                    target="_blank" class="btn btn-danger">{{ __('Print DO') }}</a>
                <a id="linkMenu"
                    href="{!! route($module.'_print_invoice', ['code' => $model->{$model->getKeyName()}]) !!}"
                    target="_blank" class="btn btn-danger">{{ __('Invoice') }}</a>
                @isset($actions['do_delivery'])
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                @endisset
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>

@endsection