@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {{{ trans("admin/users.users") }}} :: @parent
@stop

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
            <a href="{{URL::to('admin/')}}">{{trans('admin/admin.admin_panel')}}</a> >
            {{{ trans("admin/admin.price_offers") }}}
            <div class="pull-right">
                <div class="pull-right">
                    <a href="{{{ URL::to('admin/price_offers/create') }}}"
                       class="btn btn-sm  btn-success iframe"><span
                                class="glyphicon glyphicon-plus-sign"></span> {{
					trans("admin/admin.create") }}</a>
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

    <table id="table" class="table table-striped table-hover">
        <thead>
        <tr>
            <th>{{{ trans("admin/admin.order_nr") }}}</th>
            <th>{{{ trans("admin/admin.company_name") }}}</th>
            <th>{{{ trans("admin/admin.contact_person_name") }}}</th>
            <th>{{{ trans("admin/admin.contact_email") }}}</th>
            <th>{{{ trans("admin/admin.contact_phone") }}}</th>
            <th>{{{ trans("admin/admin.total_price") }}}</th>
            <th>{{{ trans("admin/admin.begin_date") }}}</th>
            <th>{{{ trans("admin/admin.end_date") }}}</th>
            <th>{{{ trans("admin/admin.order_status") }}}</th>
            <th>{{{ trans("admin/admin.actions") }}}</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
@stop

{{-- Scripts --}}
@section('scripts')
    @parent
    <script type="text/javascript">
        var oTable;
        $(document).ready(function () {
            oTable = $('#table').DataTable({
                //"sDom": "<'row'<'col-md-4'l><'col-md-4'f>r>t<'row'<'col-md-4'i><'col-md-4'p>>",
                "sPaginationType": "bootstrap",
                "processing": true,
                "serverSide": true,
                "ajax": "{{ URL::to('admin/price_offers/data/') }}",
                "fnDrawCallback": function (oSettings) {
                    $(".iframe").colorbox({
                        iframe: true,
                        width: "80%",
                        height: "80%",
                        onClosed: function () {
                            window.location.reload();
                        }
                    });
                }
            });
        });
    </script>
@stop
