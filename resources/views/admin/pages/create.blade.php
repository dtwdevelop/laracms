

@extends('app')

@section('content')
    <div class="page-header">
      <!--path-->
     <h3><a href="{{URL::to('admin/')}}">{{trans('admin/admin.admin_panel')}}</a> >
      <a href="{{URL::to('admin/pages')}}">{{trans('admin/pages.pages')}}</a>>
    {{trans('admin/pages.create')}}
<!--endpath-->
      </h3>
    </div>

@include("admin.pages.err")
    <div class="row">
        <div class="col-md-6">

            <form action="{{ url('/admin/pages/store') }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                     <label for="title">Title</label>
                     <input type="text" name="title" class="form-control" value=""/>
                </div>
                 <div class="form-group">
                     <label for="meta_description">Meta description</label>
                     <input type="text" name="meta_description" class="form-control" value=""/>
                </div>
               
                 <div class="form-group">
                     <label for="meta_keywords">Meta keywords</label>
                     <input  type="text" name="meta_keywords" class="form-control" value=""/>
                     
                </div>
        
                <div class="form-group">
                    <img id="image_upload_preview" src="" width="100" alt="foto" />
                     <label for="file">Image</label>
                     <input id="file" type="file" name="file" />
                     
                </div>
        
                  <div class="form-group">
                        <p>Content</p>
                        <textarea cols="80" name="content"> </textarea>
                     
                </div>
                               


            <a class="btn btn-default" href="{{ url('/admin/pages') }}">Back</a>
            <button class="btn btn-primary" type="submit" ><i class="fa fa-plus"></i>
{{trans('admin/pages.create')}}</button>
            </form>
        </div>
    </div>


	

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script type="text/javascript">
     tinymce.init({selector:'textarea'});
</script>


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
