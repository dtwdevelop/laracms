
@extends('admin.layouts.default')
@section('title') {{{ trans("admin/benefits.title") }}} :: @parent @stop
@section('content')
    <div class="page-header">
     <h3>      <a href="{{URL::to('admin/')}}">{{trans('admin/admin.admin_panel')}}</a> >{{trans('admin/benefits.title')}}

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
                       
                       <th class="text-left">Id</th>
                        <th class="text-left">Icon</th>
                         <th class="text-left">Description</th>
                          <th> Order </th>
                        <th class="text-left">Created</th>
                         
                        <th class="text-right">
                           
                        <a class="btn btn-info " href="{{ url('/admin/benefits/edit', 0) }}"><i class="fa fa-plus"></i> {{trans('admin/benefits.create')}}</a>
                         
                         </th>
                    </tr>
                </thead>

                <tbody>
               
                @foreach($pages as $page)
                <tr>
                     <td>{{$page->id}} </td>
                    <td><?= HTML::image('appfiles/benefits/'.$page->id.'/'.$page->icon,'', array('class' => 'thumb',"width"=>100,'style'=>'background:orange'))  ?></td>
                   
                    <td><blockquote>{{str_limit($page->description,70)}}</blockquote></td>
                    <td>{{$page->order}} </td>
                      <td>{{ date('M d Y  h:m', strtotime($page->created_at)) }}</td>
                  
                   <td class="text-right">
                        <a class="btn btn-warning " href="{{ url('/admin/benefits/edit', $page->id) }}">Edit</a>
                        <form action="{{ url('/admin/benefits/delete', $page->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}"> <button class="btn btn-danger" type="submit">Delete</button></form>
                    </td>
                </tr>

                @endforeach

               
                </tbody>
            </table>

            <?= $pages->render(); ?>
        
        
        </div>
    </div>



@endsection

