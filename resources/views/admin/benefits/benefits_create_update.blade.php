@extends('app')

@section('content')
    <div class="page-header">
         <h3>   <a href="{{URL::to('admin/')}}">{{trans('admin/admin.admin_panel')}}</a> >
      <a href="{{URL::to('admin/benefits')}}">{{trans('admin/benefits.title')}}</a>>
    {{trans('admin/benefits.update')}}
          </h3>
    </div>

@include("admin.pages.err")
    <div class="row">
        <div class="col-md-6">

            <form action="{{ url('/admin/benefits/update')}}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <input type="hidden" name="id" value="{{ $review->id}}">
                <div class="form-group">
                     <!--<img id="image_upload_preview" src="" width="100" alt="" />-->
            <?= HTML::image('appfiles/benefits/'.$review->id.'/'.$review->icon,'', array('id'=>"image_upload_preview",'class' => 'thumb',"width"=>100,'style'=>'background:orange'))  ?>

                   
                     <input id="icon" type="file" name="icon" />
                </div>
                
               
                <div class="form-group">
                   
                    <p> Description</p>
                    <textarea cols="80"   name="description">{{$review->description}} </textarea>
                     
                </div>
                 
                 <div class="form-group">
                   
                    
                      <div class="form-group">
                     <label for="order">Order</label>
                     <input  type="text" name="order" class="form-control" value="{{$review->order}}"/>

                    
                </div>
                           
                </div>
                               


            <a class="btn btn-default" href="{{ url('/admin/benefits') }}" >Back</a>
            <button class="btn btn-primary" type="submit" >Update</a>
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

    $("#icon").change(function () {
        readURL(this);
    });
</script>
@endsection
