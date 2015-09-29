@extends('admin.layouts.default')

@section('content')

    <h3>
        <a href="{{URL::to('admin/')}}">{{trans('admin/admin.admin_panel')}}</a> >
        <a href="{{URL::to('admin/advertising')}}">{{trans('admin/advertising.title')}}</a>>
        {{trans('admin/advertising.update')}}
    </h3>
    <a class="btn btn-success" href="{{url('admin/advertising')}}">Back</a>
    <hr/>

    {!! Form::model($advertising, ['method' => 'Post', 'action' => ['Admin\AdvertisingAdminController@store', $advertising->id], 'class' => 'form-horizontal']) !!}

    {{--<div class="form-group">--}}
                        {{--{!! Form::label('title', 'Title: ', ['class' => 'col-sm-3 control-label']) !!}--}}
                        {{--<div class="col-sm-6"> --}}
                            {{--{!! Form::text('title', null, ['class' => 'form-control']) !!}--}}
                        {{--</div>    --}}
                    {{--</div>--}}


        <div class="form-group">
            {!! Form::label('image', 'Image: ', ['class' => 'col-sm-3 control-label']) !!}

            <div class="col-sm-6">
                <img id="image_upload_preview" src="{{$advertising->getImageUrl()}}" width="100" alt="" />
                {{--{!! Form::file('image', ['class' => '', 'id'=>'name']) !!}--}}
            </div>
        </div>
     <input type="hidden" name="id" value="{{$advertising->id}}" />
                    <div class="form-group">
                        {!! Form::label('text', 'Text: ', ['enctype'=>"multipart/form-data",'class' => 'col-sm-3 control-label']) !!}
                        {{--<div class="col-sm-6"> --}}
                            {{--{!! Form::text('text', null, ['class' => 'form-control']) !!}--}}
                        {{--</div>    --}}
                    </div>
    <div class="form-group">
        {!! Form::label('is_active', 'Active: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::checkbox('is_active', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit(  trans('admin/advertising.update'), ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image_upload_preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image").change(function () {
            readURL(this);
        });
    </script>

@endsection
