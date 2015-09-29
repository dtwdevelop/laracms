@extends('admin.layouts.default')

@section('content')

    <h3>
        <a href="{{URL::to('admin/')}}">{{trans('admin/admin.admin_panel')}}</a> >
        <a href="{{URL::to('admin/advertising')}}">{{trans('admin/advertising.title')}}</a>>
        {{trans('admin/advertising.create')}}
    </h3>
    <a class="btn btn-success" href="{{url('admin/advertising')}}">Back</a>
    <hr/>
    <div class="row">
        <div class="col-md-12">
            @if(Session::has('info'))
                <p class="alert alert-success">{{Session::get('info') }}</p>
            @endif

    {!! Form::open(['url' => 'admin/advertising', 'method'=>'POST', 'enctype'=>"multipart/form-data", 'class' => 'form-horizontal']) !!}
    
    {{--<div class="form-group">--}}
                        {{--{!! Form::label('title', 'Title: ', ['class' => 'col-sm-3 control-label']) !!}--}}
                        {{--<div class="col-sm-6"> --}}
                            {{--{!! Form::text('title', null, ['class' => 'form-control']) !!}--}}
                        {{--</div>    --}}
                    {{--</div>--}}
    <div class="form-group">
        {!! Form::label('image', 'Image: ', ['class' => 'col-sm-3 control-label']) !!}
<?php // HTML::image('appfiles/benefits/'.$review->id.'/'.$review->icon,'', array('id'=>"image_upload_preview",'class' => 'thumb',"width"=>100,'style'=>'background:orange'))  ?>

        <div class="col-sm-6">
            <img id="image_upload_preview" src="" width="100" alt="" />

            <input id="image"  id="image" type="file" name="image" />
            </div>
    </div>
    {{--<div class="form-group">--}}
                        {{--{!! Form::label('text', 'Text: ', ['class' => 'col-sm-3 control-label']) !!}--}}
                        {{--<div class="col-sm-6"> --}}
                            {{--{!! Form::text('text', null, ['class' => 'form-control']) !!}--}}
                        {{--</div>    --}}
                    {{--</div>--}}
    <div class="form-group">
        {!! Form::label('is_active', 'Active: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::checkbox('is_active', null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit(trans('admin/advertising.create'), ['class' => 'btn btn-primary form-control']) !!}
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
