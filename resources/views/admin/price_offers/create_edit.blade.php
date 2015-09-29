@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
    @if ($price_offer->id === null)
        {{ trans('admin/admin.price_offers_add') }}
    @else
        Edit Price Offer {{$price_offer->doc_nr}}
    @endif
    @parent
    @stop
@endsection

{{-- Content --}}
@section('main')

    <div class="page-header">
        <h3>
            <a href="{{URL::to('admin/')}}">{{trans('admin/admin.admin_panel')}}</a> >
            <!--<a href="{{URL::to('admin/price_offers')}}">{{trans('admin/admin.price_offers')}}</a> >-->
            <a href="{{URL::to('admin/contact')}}">Messages</a> >
            @if ($price_offer->id === null)
                {{ trans('admin/admin.price_offers_add') }}
            @else
                Edit Price Offer {{$price_offer->doc_nr}}
            @endif
        </h3>
    </div>

    @if ($services->isEmpty())
        <div class="alert alert-danger" role="alert">
            <ul>
                There are no services in database. Please add Service first.
            </ul>
        </div>
    @else

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
                    1. {{ trans('admin/price_offers.header_order_info') }}
                </h3>
                <!-- begin inputs -->
                <div class="col-md-12 column">
                    <div class="form-group">
                        <label class="col-md-2 control-label" style="font-size: 15px; font-weight: 700;" for="doc_nr">{{trans("admin/admin.order_nr") }}: </label>
                        <div class="col-md-4">
                            <input type="text" name='doc_nr' placeholder='{{ trans('admin/admin.order_nr') }}' class="form-control" value="{{$price_offer->doc_nr}}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" style="font-size: 15px; font-weight: 700;" for="company_name">{{trans("admin/admin.company_name") }}: </label>
                        <div class="col-md-4">
                            <input type="text" name='company_name' placeholder='{{ trans('admin/admin.company_name') }}' class="form-control" value="{{$price_offer->company_name}}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" style="font-size: 15px; font-weight: 700;" for="contact_person_name">{{trans("admin/admin.contact_person_name") }}: </label>
                        <div class="col-md-4">
                            <input type="text" name='contact_person_name' placeholder='{{ trans('admin/admin.contact_person_name') }}' class="form-control" value="{{$price_offer->contact_person_name}}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" style="font-size: 15px; font-weight: 700;" for="contact_email">{{trans("admin/admin.contact_email") }}: </label>
                        <div class="col-md-4">
                            <input type="text" name='contact_email' placeholder='email@domain.com' class="form-control" value="{{$price_offer->contact_email}}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" style="font-size: 15px; font-weight: 700;" for="contact_phone">{{trans("admin/admin.contact_phone") }}: </label>
                        <div class="col-md-4">
                            <input type="text" name='contact_phone' placeholder='+371 123 456 78' class="form-control" value="{{$price_offer->contact_phone}}"/>
                        </div>
                    </div>
                </div>

                <h3>
                    2. {{ trans('admin/price_offers.header_select_services') }}
                </h3>
                <!-- begin inputs -->
                <div class="col-md-12 column">
                    <table class="table table-bordered table-hover" id="items">
                        <thead>
                        <tr>
                            <th class="text-center">
                                {{ trans('admin/admin.service_category') }}
                            </th>
                            <th class="text-center">
                                {{ trans('admin/admin.service_label') }}
                            </th>
                            <th class="text-center">
                                {{ trans('admin/admin.date_from') }}
                            </th>
                            <th class="text-center">
                                {{ trans('admin/admin.date_to') }}
                            </th>
                            <th class="text-center">
                                {{ trans('admin/admin.price') }}
                            </th>
                            <th class="text-center">
                                {{ trans('admin/admin.actions') }}
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($price_offer->services as $i => $price_offer_service)
                        <?php $k=$i+1; ?>
                        <tr id='addr{{$i}}' data-row-id="{{$i+1}}">
                            <td>

                                <input type="hidden" name="items[{{$i}}][id]" value=""/>

                                <select class="form-control" name="items[{{$i}}][service_id]">
                                    @foreach($services as $service)
                                                <option value="{{$service->id}}"
                                                @if ($service->id == $price_offer_service->service_id)
                                                     selected="selected"
                                                @endif
                                                >{{$service->title_en}}</option>
                                    @endforeach
                                </select>

                            </td>
                            <td>
                                <input type="text" name="items[{{$i}}][label]" placeholder="{{ trans('admin/admin.service_label') }}" class="form-control" value="{{$price_offer_service->label}}"/>
                            </td>
                            <td>

                                <div class="controls">
                                    <div class="input-group">
                                        <input type="text" name="items[{{$i}}][datetime_from]" placeholder="{{ trans('admin/admin.date_from') }}" class="datetimepicker form-control" value="{{$price_offer_service->datetime_from}}" />
                                        <label for="items[{{$i}}][datetime_from]" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span>

                                        </label>
                                    </div>
                                </div>


                            </td>
                            <td>
                                <div class="controls">
                                    <div class="input-group">
                                        <input type="text" name="items[{{$i}}][datetime_to]" placeholder="{{ trans('admin/admin.date_to') }}" class="datetimepicker form-control" value="{{$price_offer_service->datetime_to}}" />
                                        <label for="items[{{$i}}][datetime_to]" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span>

                                        </label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <input type="text" name="items[{{$i}}][price]" placeholder="{{ trans('admin/admin.price') }}" class="form-control" value="{{$price_offer_service->price}}"/>
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
                        </tbody>
                    </table>
                </div>

                <div class="col-md-12 column" style="margin-bottom: 15px">
                    <a id="add_row" class="btn btn-sm  btn-primary iframe"><span
                                class="glyphicon glyphicon-plus-sign"></span> Add Row</a>
                </div>

                <!-- /end inputs -->

                <h3>
                    3. {{ trans('admin/price_offers.header_select_portfolios') }}
                </h3>
                <p>{{ trans('admin/price_offers.help_select_portfolios') }}</p>
                <!-- begin inputs -->
                <div class="col-md-12 column" style="margin-bottom: 30px">
                    <div class="col-md-6">
                        <?php $portfolio_ids = $price_offer->getPortfolioIds(); ?>
                    <select class="form-control" name="portfolios[]" multiple>
                        @foreach($portfolios as $portfolio)
                            <option value="{{$portfolio->id}}"
                            @if (in_array($portfolio->id, $portfolio_ids)))
                                    selected="selected"
                                    @endif
                                    >{{$portfolio->title}}</option>
                        @endforeach
                    </select>
                        </div>
                </div>

                <h3>
                    4. {{ trans('admin/price_offers.header_check_and_save') }}
                </h3>
                <!-- begin inputs -->
                <div class="col-md-12 column">

                    <div class="form-group">
                        <label class="col-md-2 control-label" style="font-size: 15px; font-weight: 700;" for="is_vewable">{{trans("admin/price_offers.is_viewable") }} </label>
                        <div class="col-md-1">
                            <input type="checkbox" name="is_viewable" class="form-control" value="1"
                                    @if ($price_offer->is_viewable == 1)
                                         checked="checked"
                                     @endif
                                    />
                        </div>
                    </div>

                    @if ($price_offer->id)
                    <div class="form-group">
                        <label class="col-md-2 control-label" style="font-size: 15px; font-weight: 700;" for="hash">{{trans("admin/price_offers.public_link") }} </label>
                        <div class="col-md-10">
                            <a href="{{URL::to('/').'/price_offer/'.$price_offer->hash}}" target="_blank">{{URL::to('/').'/price_offer/'.$price_offer->hash}}</a>
                        </div>
                    </div>
                    @endif

                    <div class="form-group">
                        <label class="col-md-2 control-label" style="font-size: 15px; font-weight: 700;" for="status_id">{{trans("admin/price_offers.status") }} </label>
                        <div class="col-md-4">
                            <select class="form-control" name="status_id">
                                @foreach($statuses as $status)
                                    <option value="{{$status->id}}"
                                    @if ($status->id == $price_offer->status_id)
                                            selected="selected"
                                            @endif
                                            >{{$status->name_en}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <!-- begin form buttons -->
        <div class="col-md-12 column">


            <div class="pull-right">

                <a href="{{URL::to('admin/contact')}}" type="reset" class="btn btn-sm btn-warning close_popup">
                    <span class="glyphicon glyphicon-ban-circle"></span> {{
                    trans("admin/admin.cancel") }}
                </a>

                <button type="reset" class="btn btn-sm btn-default" style="margin: 10px 20px">
                    <span class="glyphicon glyphicon-remove-circle"></span> {{
                    trans("admin/admin.reset") }}
                </button>

                <button type="submit" class="btn btn-sm btn-primary" style="margin: 10px 20px">
                    <i class="fa fa-envelope"></i>
                    {{trans("admin/admin.send") }}
                </button>

                <button type="submit" class="btn btn-sm btn-success">
                    <span class="glyphicon glyphicon-ok-circle"></span>
                    @if($price_offer->id === null)
                        {{trans("admin/admin.create") }}
                    @else
                        {{trans("admin/admin.update") }}
                    @endif
                </button>

            </div>
        </div>
        <!-- /begin -->

    </form>

    @endif
@stop

@section('scripts')
    <script type="text/javascript">

        $('.datetimepicker').datetimepicker({
            format: 'Y-m-d H:i:s'
        });

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

        /*function addRow(id, table-id){
            var i = 1;
            $("#" + table-id + " tr:first").clone().find("input, select").each(function() {
                $(this).val('').attr('id', function(_, id) { return id + i });
            }).end().appendTo(table-id);
            i++;
        }*/

        $(document).ready(function(){

            var i=$('#items tbody tr:last-child').data('row-id')-1;
            $("#add_row").click(function(){

                var button = document.createElement('a');
                button.setAttribute('data-row-id', i+1);
                button.setAttribute('class', 'btn btn-sm btn-warning delete-row');
                button.innerHTML = '<span class="glyphicon glyphicon-ban-circle"></span>';

                $('#addr'+i).html("<td>"+
                '<input type="hidden" name="items['+i+'][id]" value=""/>'+
                '<select class="form-control" name="items['+i+'][service_id]">'+
                @foreach($services as $service)
                '<option value="{{$service->id}}">{{$service->title_en}}</option>'+
                @endforeach
            '</select>'+

                '</td>'+
                '<td>'+
                '<input type="text" name="items['+i+'][label]" placeholder="{{ trans('admin/admin.service_label') }}" class="form-control" value=""/>'+
                '</td>'+
                '<td>'+

                '<div class="controls">'+
                '<div class="input-group">'+
                '<input type="text" name="items['+i+'][datetime_from]" placeholder="{{ trans('admin/admin.date_from') }}" class="datetimepicker form-control" />'+
                '<label for="items['+i+'][datetimne_from]" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span>'+

                '</label>'+
                '</div>'+
                '</div>'+


                '</td>'+
                '<td>'+
                '<div class="controls">'+
                '<div class="input-group">'+
                '<input type="text" name="items['+i+'][datetime_to]" placeholder="{{ trans('admin/admin.date_to') }}" class="datetimepicker form-control" />'+
                '<label for="items['+i+'][datetime_to]" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span>'+

                '</label>'+
                '</div>'+
                '</div>'+
                '</td>'+
                '<td>'+
                '<input type="text" name="items['+i+'][price]" placeholder="{{ trans('admin/admin.price') }}" class="form-control" value=""/>'+
                '</td>'+
                '<td>'+
                '</td>');

                $('#addr'+i+' td:last-child').append(button);

                $('#items').append('<tr id="addr'+(i+1)+'"></tr>');
                i++;

                $(button).click(function(){
                    deleteRow($(this).data('row-id'));
                });

                $('.datetimepicker').datetimepicker({
                    format: 'Y-m-d H:i:s'
                });
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