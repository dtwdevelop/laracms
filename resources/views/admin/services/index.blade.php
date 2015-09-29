@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {{{ trans("admin/services.services") }}} :: @parent @stop

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
            <a href="{{URL::to('admin/')}}">{{trans('admin/admin.admin_panel')}}</a> >
            {{{ trans("admin/services.services") }}}
            <div class="pull-right">
                <div class="pull-right">
                    <a href="{{{ URL::to('admin/services/create') }}}"
                       class="btn btn-sm  btn-success iframe"><span
                                class="glyphicon glyphicon-plus-sign"></span> {{
					trans("admin/services.button_create_service") }}</a>
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
        @if (!$services->isEmpty())
            @foreach($services as $service)
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            {{$service->title_en}}
                        </div>
                    </div>
                    <a href="{{URL::to('admin/services/'.$service->id.'/edit')}}">

                        <img width="200" src="{{$service->getIconUrl()}}">

                        <ul>
                        @foreach($service->getDescriptions() as $description)
                            <li>{{$description->title_en}}</li>
                        @endforeach
                        </ul>

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
            <h4>{{trans('admin/services.ux_no_services_yet')}} <a href="{{URL::to('admin/services/create')}}">{{trans('admin/services.ux_create_new_service')}}</a></h4>
        @endif
    </div>

@stop
