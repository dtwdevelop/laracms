@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {{{$title}}} :: @parent @stop

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
            <a href="{{URL::to('admin/')}}">{{trans('admin/admin.admin_panel')}}</a> >
            <a href="{{URL::to('admin/services')}}">{{trans('admin/services.services')}}</a> >
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
          action="@if (isset($service)){{ URL::to('admin/services/' . $service->id . '/edit') }}@endif"
          autocomplete="off">
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
                <!-- begin inputs -->

                <!-- title_en -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="title_en">{{
						trans('admin/services.title_en') }}</label>
                        <div class="col-md-10">
                            <input class="form-control" tabindex="1"
                                   placeholder="{{ trans('admin/services.title_en') }}" type="text"
                                   name="title_en" id="title_en"
                                   value="{{{ Input::old('title_en', isset($service) ? $service->title_en : null) }}}"
                                   autofocus="true">
                        </div>
                    </div>
                </div>

                <!-- title_ru -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="title_lv">{{
						trans('admin/services.title_ru') }}</label>
                        <div class="col-md-10">
                            <input class="form-control" tabindex="1"
                                   placeholder="{{ trans('admin/services.title_ru') }}" type="text"
                                   name="title_ru" id="title_ru"
                                   value="{{{ Input::old('title_ru', isset($service) ? $service->title_ru : null) }}}">
                        </div>
                    </div>
                </div>

                <!-- title_lv -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="title_ru">{{
						trans('admin/services.title_lv') }}</label>
                        <div class="col-md-10">
                            <input class="form-control" tabindex="1"
                                   placeholder="{{ trans('admin/services.title_lv') }}" type="text"
                                   name="title_lv" id="title_lv"
                                   value="{{{ Input::old('title_lv', isset($service) ? $service->title_lv : null) }}}">
                        </div>
                    </div>
                </div>

                <!-- icon -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="icon">{{trans("admin/services.icon") }}</label>
                        <div class="col-md-10">
                            <input name="icon" type="file" class="uploader" id="icon" value="Upload" style="display: inline-block"/>
                            @if (isset($service))
                                <img id="icon-preview" style="display: inline-block; width: 100px;" src="{{$service->getIconUrl()}}" />
                            @endif
                        </div>

                    </div>
                </div>

                <!-- begin service descriptions (children) -->
                <h4>
                    {{trans('admin/services.descriptions')}}
                </h4>


                        <div class="col-md-12 column">
                            <table class="table table-bordered table-hover" id="service_descriptions">
                                <thead>
                                <tr >
                                    <th class="text-center">
                                        #
                                    </th>
                                    <th class="text-center">
                                        {{ trans('admin/services.title_en') }}
                                    </th>
                                    <th class="text-center">
                                        {{ trans('admin/services.title_ru') }}
                                    </th>
                                    <th class="text-center">
                                        {{ trans('admin/services.title_lv') }}
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (isset($service) && !empty($descriptions = $service->getDescriptions()))
                                    @foreach($descriptions as $i => $descr)
                                        <tr id='addr{{$i}}' data-row-id="{{$i+1}}">
                                            <td>
                                                {{$i+1}}
                                                <input type="hidden" name='descriptions[{{$i}}][id]' value="{{$descr->id}}" />
                                            </td>
                                            <td>
                                                <input type="text" name='descriptions[{{$i}}][title_en]'  placeholder='{{ trans('admin/services.title_en') }}' class="form-control" value="{{$descr->title_en}}"/>
                                            </td>
                                            <td>
                                                <input type="text" name='descriptions[{{$i}}][title_ru]' placeholder='{{ trans('admin/services.title_ru') }}' class="form-control" value="{{$descr->title_ru}}"/>
                                            </td>
                                            <td>
                                                <input type="text" name='descriptions[{{$i}}][title_lv]' placeholder='{{ trans('admin/services.title_lv') }}' class="form-control" value="{{$descr->title_lv}}"/>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-warning delete-row" data-row-id="{{$i+1}}">
                                                    <span class="glyphicon glyphicon-ban-circle"></span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <?php $i++; $k=$i+1 ?>
                                    <tr id='addr{{$i}}' data-row-id="{{$k}}"></tr>
                                @else
                                    <tr id='addr0' data-row-id="1">
                                        <td>
                                            1
                                            <input type="hidden" name='descriptions[0][id]' value="0" />
                                        </td>
                                        <td>
                                            <input type="text" name='descriptions[0][title_en]'  placeholder='{{ trans('admin/services.title_en') }}' class="form-control"/>
                                        </td>
                                        <td>
                                            <input type="text" name='descriptions[0][title_ru]' placeholder='{{ trans('admin/services.title_ru') }}' class="form-control"/>
                                        </td>
                                        <td>
                                            <input type="text" name='descriptions[0][title_lv]' placeholder='{{ trans('admin/services.title_lv') }}' class="form-control"/>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-warning delete-row" data-row-id="1">
                                                <span class="glyphicon glyphicon-ban-circle"></span>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr id='addr1' data-row-id="2"></tr>
                                @endif
                                </tbody>
                            </table>
                        </div>

                <!-- /end service descriptions -->

                <!-- /end inputs -->
            </div>
        </div>
        <div class="col-md-12 column" style="margin-bottom: 15px">
            <a id="add_row" class="btn btn-sm  btn-primary iframe"><span
                        class="glyphicon glyphicon-plus-sign"></span> Add Row</a>
        </div>

        <!-- begin form buttons -->
        <div class="col-md-12 column">


                <div class="pull-right">

                    @if (isset($service))
                    <a href="{{URL::to('admin/services/'.$service->id.'/delete')}}" id="btn-delete" type="delete" class="btn btn-sm btn-danger" style="margin: 10px 20px">
                        <span class="glyphicon glyphicon-ban-circle"></span> {{
				trans("admin/modal.delete") }}
                    </a>
                    @endif

                    <a href="{{URL::to('admin/services')}}" type="reset" class="btn btn-sm btn-warning close_popup">
                        <span class="glyphicon glyphicon-ban-circle"></span> {{
                    trans("admin/admin.cancel") }}
                    </a>

                    <button type="reset" class="btn btn-sm btn-default" style="margin: 10px 20px">
                        <span class="glyphicon glyphicon-remove-circle"></span> {{
                    trans("admin/admin.reset") }}
                    </button>

                    <button type="submit" class="btn btn-sm btn-success">
                        <span class="glyphicon glyphicon-ok-circle"></span>
                        @if	(isset($service))
                            {{ trans("admin/services.button_edit_service") }}
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

    @if (isset($service))
    $('#btn-delete').on('click', function(){
        if (confirm('{{sprintf(trans('admin/services.confirm_delete_service'), $service->title_en)}}')){

        }else{
            return false;
        }
    });
    @endif

    function deleteRow(id){
        var str = '{{trans('admin/services.confirm_delete_row')}}';
        if (confirm(str.replace(/%s/g, id))){
            id = id-1;
            $('#addr'+id).remove();
        }else{
            return false;
        }
    }

    $(document).ready(function(){

        var i=$('#service_descriptions tbody tr:last-child').data('row-id')-1;
        $("#add_row").click(function(){

            var button = document.createElement('a');
            button.setAttribute('data-row-id', i+1);
            button.setAttribute('class', 'btn btn-sm btn-warning delete-row');
            button.innerHTML = '<span class="glyphicon glyphicon-ban-circle"></span>';

            $('#addr'+i).html("<td>"+ (i+1) +"<input type='hidden' name='descriptions["+i+"][id]' value='0' /></td><td><input name='descriptions["+i+"][title_en]' type='text' placeholder='{{ trans('admin/services.title_en') }}' class='form-control input-md'  /> </td><td><input  name='descriptions["+i+"][title_ru]' type='text' placeholder='{{ trans('admin/services.title_ru') }}'  class='form-control input-md'></td><td><input name='descriptions["+i+"][title_lv]' type='text' placeholder='{{ trans('admin/services.title_lv') }}'  class='form-control input-md'></td><td>");

            $('#addr'+i+' td:last-child').append(button);

            $('#service_descriptions').append('<tr id="addr'+(i+1)+'"></tr>');
            i++;

            $(button).click(function(){
                deleteRow($(this).data('row-id'));
            })
        });

        $('.delete-row').click(function(){
            deleteRow($(this).data('row-id'));
        })

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
                return "{{trans('admin/services.confirm_leave_page')}}";
            }
        }

        window.onbeforeunload = unloadPage;

    });
    </script>
@stop