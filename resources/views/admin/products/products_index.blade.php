@extends('admin.layouts.default')
@section('title') {{{ trans("admin/products.title") }}} :: @parent @stop
@section('content')
    <div class="page-header">
         <h3> <a href="{{URL::to('admin/')}}">{{trans('admin/admin.admin_panel')}}</a> >{{trans('admin/products.title')}}
        </h3>
        
    </div>


    <div class="row">
        <div class="col-md-12">
           @if(Session::has('product'))
<p class="alert alert-success">{{Session::get('product') }}</p>
@endif
            <table class="table table-striped">
                <thead>
                    <tr>
                       
                       
                        <th class="text-left">Name</th>
                         <th class="text-left">Image</th>
                          <th class="text-left">Price</th>
                          <th class="text-right"> <a class="btn btn-success" href="/admin/products/create"><i class="fa fa-plus"></i>
Create</a></th>
                    </tr>
                </thead>

                <tbody>
               
                @foreach($products as $page)
                <tr>
                    
                    <td>{{$page->name}}</td>
                    <td>
<?= HTML::image('appfiles/products/'.$page->id.'/'.$page->image,$page->title, array('class' => 'thumb',"width"=>100))  ?>
</td>
  <td>{{$page->price}}</td>
                    <td class="text-right">
                        <a class="btn btn-warning " href="{{ url('/admin/products/edit', $page->id) }}">Edit</a>
                        <form action="{{ url('/admin/products/delete', $page->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}"> <button class="btn btn-danger" type="submit">Delete</button></form>
                    </td>
                  
                </tr>

                @endforeach

               
                </tbody>
            </table>

            <?= $products->render(); ?>
        
        
        </div>
    </div>



@endsection



