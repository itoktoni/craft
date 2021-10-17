@extends(Views::backend())

@section('content')

<div class="row">
    <div class="panel-body">
        {!! Form::open(['route' => $module.'_do_monitoring', 'class' => 'form-horizontal', 'files' => true]) !!}
        <div class="panel panel-default">
            <header class="panel-heading">
                <h2 class="panel-title">Form Monitoring Work Order : {{ $model->{$model->getKeyName()} }} </h2>
            </header>

            <div class="panel-body line">

                <div class="form-group">

                    {!! Form::label('name', __('Status'), ['class' => 'col-md-1 col-sm-2 control-label']) !!}
                    <div class="col-md-2 col-sm-2 {{ $errors->has('monitoring_status') ? 'has-error' : ''}}">
                        {{ Form::select('monitoring_status', $status, null, ['class'=> 'form-control ']) }}
                        {!! $errors->first('monitoring_status', '<p class="help-block">:message</p>') !!}
                    </div>

                    {!! Form::label('name', __('Notes'), ['class' => 'col-md-1 col-sm-2 control-label']) !!}
                    <div class="col-md-8 col-sm-8 {{ $errors->has('monitoring_notes') ? 'has-error' : ''}}">
                        {!! Form::textarea('monitoring_notes', null, ['class' => 'form-control', 'rows' => '5']) !!}
                        {!! $errors->first('monitoring_notes', '<p class="help-block">:message</p>') !!}
                    </div>

                </div>

            </div>

            <div class="navbar-fixed-bottom" id="menu_action">
                <div class="text-right action-wrapper">
                    <a id="linkMenu" href="{!! route($route_index) !!}" class="btn btn-warning">{{ __('Back') }}</a>
                    @isset($actions['update'])
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    @endisset
                </div>
            </div>
        </div>
        {!! Form::close() !!}

        <div class="panel panel-default">
            <header class="panel-heading">
                <h2 class="panel-title">History Monitoring : {{ $model->{$model->getKeyName()} }} </h2>
            </header>
            <div class="panel-body line">
                <div class="show">
                    <table class="table table-no-more table-bordered table-striped mb-none">
                        <thead>
                            <tr>
                                <th class="text-left col-md-2">User</th>
                                <th class="text-left col-md-2">Date</th>
                                <th class="text-left">Notes</th>
                                <th class="text-left col-md-1">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($model->has_monitoring)
                            @foreach($model->has_monitoring as $monitor)
                            <tr>
                                <td data-title="User">
                                    {{ $monitor->mask_created_name }}
                                </td>
                                <td data-title="Date">
                                    {{ $monitor->mask_created_at }}
                                </td>
                                <td data-title="Notes">
                                    {{ $monitor->mask_notes }}
                                </td>
                                <td data-title="Status">
                                    <span class="btn btn-xs btn-block">{{ TransactionStatus::getDescription($monitor->mask_status) }}</span>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>


    </div>
</div>

@endsection