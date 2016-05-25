@extends('admin::curd.index')
@section('heading')
<h1>
{!! trans('menu::menu.name') !!}
<small> {!! trans('cms.manage') !!} {!! trans('menu::menu.names') !!}</small>
</h1>
@stop
@section('title')
{!! trans('menu::menu.names') !!}
@stop
@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{!! trans_url('admin') !!}"><i class="fa fa-dashboard"></i> {!! trans('cms.home') !!} </a></li>
    <li class="active">{!! trans('menu::menu.names') !!}</li>
</ol>
@stop
@section('entry')
@stop
@section('tools')
@stop
@section('content')
<div style="min-height:700px;">
<div class="col-md-5">
    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            @foreach($rootMenu as $menu)
            <li {{($parent->getRouteKey() == $menu->getRouteKey()) ? ' class=active ' : ''}}><a href="{{ Trans::to('/admin/menu/menu') }}/{{$menu->getRouteKey()}}">{{$menu->name}}</a></li>
            @endforeach
            <li ><a href="#" data-href="{{ Trans::to('/admin/menu/menu/create') }}"  data-action="LOAD" data-load-to="#menu-entry"><i class="fa fa-plus-circle"></i></a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="details">
                {!!Menu::menu($parent->key, 'menu::admin.menu.nestable')!!}
            </div>
        </div>
    </div>
</div>
<div class="col-md-7">
    <div class="box box-warning" id='menu-entry'>
    </div>
</div>
</div>
@stop
@section('script')
<script type="text/javascript">
var oTable;
$(document).ready(function(){

    var updateMenu = function(e)
    {
        var out = $(e.target).nestable('serialize');
        out     = JSON.stringify(out);

        var formData = new FormData();
        formData.append('tree', out);

        var url  = '{!! trans_url('admin/menu/menu/'. $parent->getRouteKey() . '/tree') !!}';

        $.ajax( {
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success:function (data, textStatus, jqXHR)
            {
                console.log(data);
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
            }
        });
    };

    $('.dd').nestable().on('change', updateMenu);


    $('#menu-entry').load('{{trans_url('admin/menu/menu')}}/{{$parent->getRouteKey()}}');


});
</script>
@stop
@section('style')
<style type="text/css">
.box-body{
    min-height: 420px;
}
</style>
@stop
