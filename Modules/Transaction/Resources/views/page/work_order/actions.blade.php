<div class="action text-center">
    @if (isset($actions['update']))
    <a id="linkMenu" href="{{ route($route_edit, ['code' => $model->{$model->getKeyName()}]) }}" class="btn btn-xs btn-primary">@lang('pages.update')</a>
    @endif
    @if (isset($actions['show']))
    <a id="linkMenu" href="{{ route($route_show, ['code' => $model->{$model->getKeyName()}]) }}" class="btn btn-xs btn-warning">@lang('pages.show')</a>
    @endif
    @if (isset($actions['form_monitoring']))
    <a id="linkMenu" href="{{ route($module.'_form_monitoring', ['code' => $model->{$model->getKeyName()}]) }}" class="btn btn-xs btn-success">Monitoring</a>
    @endif
    @if (isset($actions['form_delivery']))
    <a id="linkMenu" href="{{ route($module.'_form_delivery', ['code' => $model->{$model->getKeyName()}]) }}" class="btn btn-xs btn-danger">Delivery</a>
    @endif
    @if (isset($actions['form_receive']))
    <a id="linkMenu" href="{{ route($module.'_form_receive', ['code' => $model->{$model->getKeyName()}]) }}" class="btn btn-xs btn-info">Receive</a>
    @endif
</div>