
@extends('admin.layouts.default')
@section('title') {{{ trans("admin/pages.pages") }}} :: @parent @stop
@section('content')
    <div class="page-header">
        <h3>    <a href="{{URL::to('admin/')}}">{{trans('admin/admin.admin_panel')}}</a> >{{trans('admin/files.title')}}

     </h3>
        
    </div>


    <div class="row">
        <div class="col-md-12">
           @if(Session::has('info'))
<p class="alert alert-success">{{Session::get('info') }}</p>
@endif
            <table class="table table-striped">
                <thead>
                    <tr>
                       
                        <th>Id</th>
                        <th class="text-left">Name</th>
                        <th class="text-left">Created</th>
                         <th class="text-right">  <a class="btn btn-success" href="/admin/files/create"><i class="fa fa-plus"></i> Create</a></th>
                    </tr>
                </thead>

                <tbody>
               
                @foreach($files as $file)
                <tr>
                   
                     <td>
                        {{$file->id}}
                        
                    </td>
                    <td>
                        {{$file->name}}
                        
                    </td>
                    <td>{{ date('M d Y  h:m', strtotime($file->created_at)) }}</td>
                    <td class="text-right">
                        <a class="btn btn-info" href="/admin/files/download/{{$file->id}}"><span class="glyphicon glyphicon-file"></span> View</a>
                        <a class="btn btn-warning " href="{{ url('/admin/files/edit', $file->id) }}">Edit</a>
                        <form action="{{ url('/admin/files/delete', $file->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}"> <button class="btn btn-danger" type="submit">Delete</button></form>
                    </td>
                </tr>

                @endforeach
            
               
                </tbody>
            </table>
  <?= $files->render(); ?>
           
        
        
        </div>
    </div>



@endsection

