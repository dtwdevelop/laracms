@extends('app')

@section('content')
    <div class="page-header">
            <!--path-->
     <h3> <a href="{{URL::to('admin/')}}">{{trans('admin/admin.admin_panel')}}</a> >
      <a href="{{URL::to('admin/products')}}">{{trans('admin/products.title')}}</a>>
    {{trans('admin/products.update')}}
<!--endpath-->
        </h3>
    </div>

@include("admin.pages.err")
    <div class="row">
        <div class="col-md-6">

            <form action="{{ url('/admin/products/update') }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <input type="hidden" name="id" value="{{$product->id}}">
                <div class="form-group">
                     <label for="name">Name</label>
                     <input type="text" name="name" class="form-control" value="{{$product->name}}"/>
                </div>
                
               
                 <div class="form-group">
                     <label for="price">Price</label>
                     <input  type="text" name="price" class="form-control" value="{{$product->price}}"/>
                     
                </div>
        
                <div class="form-group">
                     <img id="image_upload_preview" src="/appfiles/products/{{$product->id}}/{{$product->image}}" width="100" alt="" />
                   
                     <input id="file" type="file" name="image" value="{{$product->image}}" />
                     
                </div>
        
              
                               


            <a class="btn btn-default" href="{{ url('/admin/products') }}">Back</a>
            <button class="btn btn-primary" type="submit" >  {{trans('admin/products.update')}}</button>
            </form>
        </div>
    </div>
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

    $("#file").change(function () {
        readURL(this);
    });
</script>


@endsection

