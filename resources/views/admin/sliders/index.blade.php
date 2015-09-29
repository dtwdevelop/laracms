@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {{{ trans("admin/sliders.sliders") }}} :: @parent @stop

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
            <a href="{{URL::to('admin/')}}">{{trans('admin/admin.admin_panel')}}</a> >
            {{{ trans("admin/sliders.sliders") }}}
            <div class="pull-right">
                <div class="pull-right">
                    <a href="{{{ URL::to('admin/sliders/create') }}}"
                       class="btn btn-sm  btn-success iframe"><span
                                class="glyphicon glyphicon-plus-sign"></span> {{
					trans("admin/sliders.button_create_slider") }}</a>
                </div>
            </div>
        </h3>
    </div>

    @if(Session::has('message'))
        <?php $type = (Session::has('message-type')) ? Session::get('message-type') : 'success'; ?>
        <div class="alert alert-{{$type}}" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif

    <div class="row">
        @if (!$sliders->isEmpty())
            @foreach($sliders as $slider)
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            {{$slider->title_en}}
                        </div>
                    </div>
                    <a href="{{URL::to('admin/sliders/'.$slider->id.'/edit')}}">

                        <img width="200" src="{{$slider->getIconUrl()}}">

                        <div class="panel-footer">
                            <span class="pull-left">{{ trans("admin/admin.edit") }}</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        @else
            <h4>{{trans('admin/sliders.ux_no_sliders_yet')}} <a href="{{URL::to('admin/sliders/create')}}">{{trans('admin/sliders.ux_create_new_slider')}}</a></h4>
        @endif
    </div>

@stop
