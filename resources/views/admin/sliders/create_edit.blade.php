@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {{{$title}}} :: @parent @stop

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
            <a href="{{URL::to('admin/')}}">{{trans('admin/admin.admin_panel')}}</a> >
            <a href="{{URL::to('admin/sliders')}}">{{trans('admin/sliders.sliders')}}</a> >
            {{{$title}}}
        </h3>
    </div>

    @if ($errors->all())
    <div class="alert alert-warning" role="alert">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form class="form-horizontal" method="post" enctype="multipart/form-data"
          action="@if (isset($slider)){{ URL::to('admin/sliders/' . $slider->id . '/edit') }}@endif"
          autocomplete="off">
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
                <!-- begin inputs -->

                <!-- title_en -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="title_en">{{
						trans('admin/sliders.title_en') }}</label>
                        <div class="col-md-10">
                            <input class="form-control" tabindex="1"
                                   placeholder="{{ trans('admin/sliders.title_en') }}" type="text"
                                   name="title_en" id="title_en"
                                   value="{{{ Input::old('title_en', isset($slider) ? $slider->title_en : null) }}}"
                                   autofocus="true">
                        </div>
                    </div>
                </div>





                <!-- icon -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="icon">{{trans("admin/sliders.icon") }}</label>
                        <div class="col-md-10">
                            <input name="icon" type="file" class="uploader" id="icon" value="Upload" style="display: inline-block"/>
                            @if (isset($slider))
                                <img id="icon-preview" style="display: inline-block; width: 100px;" src="{{$slider->getIconUrl()}}" />
                            @endif
                        </div>

                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="name">{{
						trans('admin/sliders.name') }}</label>
                        <div class="col-md-10">
                            <input class="form-control" tabindex="1"
                                   placeholder="{{ trans('admin/sliders.name') }}" type="text"
                                   name="name" id="name"
                                   value="{{{ Input::old('name', isset($slider) ? $slider->name : null) }}}">
                        </div>
                    </div>
                </div>

                <!-- /end inputs -->
            </div>
        </div>

        <!-- begin form buttons -->
        <div class="col-md-12 column">


                <div class="pull-right">

                    @if (isset($slider))
                    <a href="{{URL::to('admin/sliders/'.$slider->id.'/delete')}}" id="btn-delete" type="delete" class="btn btn-sm btn-danger" style="margin: 10px 20px">
                        <span class="glyphicon glyphicon-ban-circle"></span> {{
				trans("admin/modal.delete") }}
                    </a>
                    @endif

                    <a href="{{URL::to('admin/sliders')}}" type="reset" class="btn btn-sm btn-warning close_popup">
                        <span class="glyphicon glyphicon-ban-circle"></span> {{
                    trans("admin/admin.cancel") }}
                    </a>

                    <button type="reset" class="btn btn-sm btn-default" style="margin: 10px 20px">
                        <span class="glyphicon glyphicon-remove-circle"></span> {{
                    trans("admin/admin.reset") }}
                    </button>

                    <button type="submit" class="btn btn-sm btn-success">
                        <span class="glyphicon glyphicon-ok-circle"></span>
                        @if	(isset($slider))
                            {{ trans("admin/sliders.button_edit_slider") }}
                        @else
                            {{trans("admin/modal.create") }}
                        @endif
                    </button>

                </div>
        </div>
        <!-- /begin -->

    </form>
@stop

@section('scripts')
    <script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var icon = $('#icon-preview');
                if (!icon.length) {
                    icon = document.createElement('img');
                    icon.setAttribute('id', 'icon-preview');
                    icon.setAttribute('style', 'display: inline-block; width: 100px');
                    $('#icon').after(icon);
                    icon = $(icon);
                }
                icon.attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#icon").change(function(){
        readURL(this);
    });

    $('.btn[type="reset"]').on('click', function(){
        var icon = $('#icon-preview');
        if (icon.length) {
            icon.remove();
        }
    });

    @if (isset($slider))
    $('#btn-delete').on('click', function(){
        if (confirm('{{sprintf(trans('admin/sliders.confirm_delete_slider'), $slider->title_en)}}')){

        }else{
            return false;
        }
    });
    @endif

    $(document).ready(function(){

        //
        var unsaved = false;

        $(":input").change(function(){ //trigers change in all input fields including text type
            unsaved = true;
        });

        $('[type="submit"]').click(function() {
            unsaved = false;
        });

        function unloadPage(){
            if(unsaved){
                return "{{trans('admin/sliders.confirm_leave_page')}}";
            }
        }

        window.onbeforeunload = unloadPage;

    });
    </script>
@stop