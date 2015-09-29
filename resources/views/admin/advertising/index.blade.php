@extends('admin.layouts.default')

@section('content')

    <h3>
        <a href="{{URL::to('admin/')}}">{{trans('admin/admin.admin_panel')}}</a> >
        {{ trans("admin/advertising.title") }}
        <div class="pull-right">
            <div class="pull-right">

                <a href="{{ URL::to('/admin/advertising/create') }}"
                   class="btn btn-sm  btn-success iframe"><span
                            class="glyphicon glyphicon-plus-sign"></span> {{
					trans("admin/advertising.create") }}</a>

            </div>
        </div>
    </h3>

    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>Id</th>
                {{--<th>Title</th>--}}
                <th>Image</th>
                {{--<th>Text</th>--}}
                <th>Active</th>
                <th>Actions</th>
            </tr>
            {{-- */$x=0;/* --}}
            @foreach($advertisings as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    {{--<td>{{ $item->title }}</td>--}}
                    <td><?php echo HTML::image($item->getImageUrl(),'', array('class' => 'thumb',"width"=>100,'style'=>'background:silver'))  ?></td>
                    </td>
                    {{--<td>{{ $item->text }}</td>--}}
                    <td>{{ $item->is_active}}</td>
                    <td>
                        <a href="{{ URL::to('/admin/advertising/active',$item->id) }}"
                           class="btn btn-xs  btn-success "><span
                                    class="glyphicon "></span>  Set	active</a>
                        {{--<a href="{{ url('/admin/advertising/'.$item->id.'/edit') }}">--}}
                            {{--<button type="submit" class="btn btn-primary btn-xs">{{trans('admin/advertising.update')}}</button>--}}
                        {{--</a> --}}

                        {!! Form::open(['method'=>'delete','action'=>['Admin\AdvertisingAdminController@destroy',$item->id], 'style' => 'display:inline']) !!}<button type="submit" class="btn btn-danger btn-xs">{{ trans('admin/advertising.delete')}}</button>{!! Form::close() !!}</td>

                </tr>
            @endforeach
        </table>
    </div>

@endsection
