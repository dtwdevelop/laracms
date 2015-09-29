
@extends('admin.layouts.default')
@section('title') {{{ trans("admin/pages.pages") }}} :: @parent @stop
@section('content')
    <div class="page-header">
          <h3>  <a href="{{URL::to('admin/')}}">{{trans('admin/admin.admin_panel')}}</a> >{{trans('admin/pages.pages')}}

       </h3>
        
    </div>


    <div class="row">
        <div class="col-md-12">
           @if(Session::has('photo'))
<p class="alert alert-success">{{Session::get('photo') }}</p>
@endif
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                       
                         <th class="text-left">Meta description</th>
                         <th class="text-left">Meta keywords</th>
                          <th class="text-left">Image</th>
                         <th class="text-right">  <a class="btn btn-success" href="/admin/pages/create"><i class="fa fa-plus"></i>
{{trans('admin/pages.create')}}</a></th>
                    </tr>
                </thead>

                <tbody>
               
                @foreach($pages as $page)
                <tr>
                     <td>{{$page->id}}</td>
                    <td>{{$page->title}}</td>
                   
                    <td>
                        {{$page->meta_description}}
                    </td>
                      <td>
                        {{$page->meta_keywords}}
                    </td>
                     <td>
<?= HTML::image('appfiles/pages/'.$page->id.'/'.$page->image,$page->title, array('class' => 'thumb',"width"=>100))  ?>
                    </td>
                    <td class="text-right">
                        <a class="btn btn-warning " href="{{ url('/admin/pages/edit', $page->id) }}">{{trans('admin/pages.update')}}</a>
                        <form action="{{ url('/admin/pages/delete', $page->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}"> <button class="btn btn-danger" type="submit">Delete</button></form>
                    </td>
                </tr>

                @endforeach

               
                </tbody>
            </table>

            <?= $pages->render(); ?>
        
        
        </div>
    </div>



@endsection

