

@extends('app')

@section('content')
    <div class="page-header">
          <!--path-->
    <h3> <a href="{{URL::to('admin/')}}">{{trans('admin/admin.admin_panel')}}</a> >
      <a href="{{URL::to('admin/files')}}">{{trans('admin/files.title')}}</a>>
    {{trans('admin/files.create')}}
<!--endpath-->
         </h3>
    </div>

@include("admin.pages.err")
    <div class="row">
        <div class="col-md-6">

            <form action="{{ url('/admin/files/store') }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                     <label for="name">Name</label>
                     <input type="text" name="name" class="form-control" value=""/>
                </div>
                
               
        
                <div class="form-group">
                    <img id="image_upload_preview" src="" width="200" alt="foto" />
                     <label for="file">Files</label>
                     <input id="file" type="file" name="file" />
                     
                </div>
        
                
                               


            <a class="btn btn-default" href="{{ url('/admin/files') }}">Back</a>
            <button class="btn btn-primary" type="submit" ><i class="fa fa-plus"></i> Create</button>
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
