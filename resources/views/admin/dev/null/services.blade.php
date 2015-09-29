@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') dev/null/services :: @parent @stop

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
            <a href="{{URL::to('admin/')}}">{{trans('admin/admin.admin_panel')}}</a> >
            dev/null/services
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
          action=""
          autocomplete="off">
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
                <h3>
                    Select services, timelines and prices
                </h3>
                <!-- begin inputs -->
                <div class="col-md-12 column">
                    <table class="table table-bordered table-hover" id="items">
                        <thead>
                        <tr>
                            <th class="text-center">
                                {{ trans('admin/admin.service') }}
                            </th>
                            <th class="text-center">
                                {{ trans('admin/admin.date_from') }}
                            </th>
                            <th>
                                {{ trans('admin/admin.date_to') }}
                            </th>
                            <th>
                                {{ trans('admin/admin.price') }}
                            </th>
                            <th>
                                {{ trans('admin/admin.actions') }}
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0; $k=$i+1; ?>
                        <tr id='addr{{$i}}' data-row-id="{{$i+1}}">
                            <td>
                                <select class="form-control" name="'items[{{$i}}][service_description_id]">
                                    @foreach($services as $i => $service)
                                    <optgroup label="{{$service->title_en}}">
                                        @foreach($service->getDescriptions() as $descr)
                                            <option value="{{$descr->id}}">{{$descr->title_en}}</option>
                                        @endforeach
                                    </optgroup>
                                    @endforeach
                                </select>

                            </td>
                            <td>
                                <!--<input type="text" name='items[{{$i}}][date_from]' placeholder='{{ trans('admin/admin.date_from') }}' class="form-control" value=""/>-->

                                <div class="controls">
                                    <div class="input-group">
                                        <input id="date-picker-2" type="text" class="date-picker form-control" />
                                        <label for="date-picker-2" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span>

                                        </label>
                                    </div>
                                </div>


                            </td>
                            <td>
                                <input type="text" name='items[{{$i}}][date_to]' placeholder='{{ trans('admin/admin.date_to') }}' class="form-control" value=""/>
                            </td>
                            <td>
                                <input type="text" name='items[{{$i}}][price]' placeholder='{{ trans('admin/admin.price') }}' class="form-control" value=""/>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-warning delete-row" data-row-id="{{$i+1}}">
                                    <span class="glyphicon glyphicon-ban-circle"></span>
                                </a>
                            </td>
                        </tr>

                        <?php $i++; $k=$i+1 ?>
                        <tr id='addr{{$i}}' data-row-id="{{$i+1}}">
                            <td>
                                <input type="text" name='items[{{$i}}][key]'  placeholder='{{ trans('admin/admin.key') }}' class="form-control" value=""/>
                            </td>
                            <td>
                                <input type="text" name='items[{{$i}}][value]' placeholder='{{ trans('admin/admin.value') }}' class="form-control" value=""/>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-warning delete-row" data-row-id="{{$i+1}}">
                                    <span class="glyphicon glyphicon-ban-circle"></span>
                                </a>
                            </td>
                        </tr>
                        <?php $i++; $k=$i+1 ?>
                        <tr id='addr{{$i}}' data-row-id="{{$k}}"></tr>
                        </tbody>
                    </table>
                </div>
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

                <button type="reset" class="btn btn-sm btn-default" style="margin: 10px 20px">
                    <span class="glyphicon glyphicon-remove-circle"></span> {{
                    trans("admin/admin.reset") }}
                </button>

                <button type="submit" class="btn btn-sm btn-success">
                    <span class="glyphicon glyphicon-ok-circle"></span>
                    {{trans("admin/admin.update") }}
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

            $(".date-picker").datepicker();

            $(".date-picker").on("change", function () {
                var id = $(this).attr("id");
                var val = $("label[for='" + id + "']").text();
                $("#msg").text(val + " changed");
            });

            var i=$('#items tbody tr:last-child').data('row-id')-1;
            $("#add_row").click(function(){

                var button = document.createElement('a');
                button.setAttribute('data-row-id', i+1);
                button.setAttribute('class', 'btn btn-sm btn-warning delete-row');
                button.innerHTML = '<span class="glyphicon glyphicon-ban-circle"></span>';

                $('#addr'+i).html("<td><input type='text' class='form-control input-md' name='items["+i+"][key]' placeholder='{{ trans('admin/admin.value') }}' /></td><td><input name='items["+i+"][value]' type='text' placeholder='{{ trans('admin/admin.value') }}' class='form-control input-md'  /></td><td></td>");

                $('#addr'+i+' td:last-child').append(button);

                $('#items').append('<tr id="addr'+(i+1)+'"></tr>');
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