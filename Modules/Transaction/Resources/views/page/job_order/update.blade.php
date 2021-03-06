@extends(Views::backend())

@section('content')

<div class="row">
    <div class="panel-body">
        {!! Form::model($model, ['route'=>[$route_update, 'code' =>
        $model->{$model->getKeyName()}],'class'=>'form-horizontal','files'=>true]) !!}
        <div class="panel panel-default">
            <header class="panel-heading">
                <h2 class="panel-title">{{ __('Edit') }} {{ __($form_name) }} : {{ $model->{$model->getKeyName()} }}
                </h2>
            </header>
            <div class="panel-body line">
                <div class="">
                    @includeIf(Helper::include($template))
                </div>
            </div>
        </div>
        <div class="navbar-fixed-bottom" id="menu_action">
            <div class="text-right action-wrapper">
                <a id="linkMenu" href="{!! route($route_index) !!}" class="btn btn-warning">{{ __('Back') }}</a>
                <a id="linkMenu" href="{!! route($module.'_print', ['code' => $model->{$model->getKeyName()}]) !!}" target="_blank" class="btn btn-danger">{{ __('Print') }}</a>
                @isset($actions['update'])
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                @endisset
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>

@endsection