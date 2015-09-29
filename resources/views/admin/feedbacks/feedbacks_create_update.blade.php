@extends('app')

@section('content')
    <div class="page-header">
       <h3>    <a href="{{URL::to('admin/')}}">{{trans('admin/admin.admin_panel')}}</a> >
      <a href="{{URL::to('admin/feedbacks')}}">{{trans('admin/feedbacks.title')}}</a>>
    {{trans('admin/feedbacks.update')}}
      </h3>
    </div>

@include("admin.pages.err")
    <div class="row">
        <div class="col-md-6">

            <form action="{{ url('/admin/feedbacks/update')}}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <input type="hidden" name="id" value="{{ $review->id}}">
                <div class="form-group">
                     <label for="name">Client name</label>
                     <input  type="text" name="client_name" class="form-control" value="{{$review->client_name}}"/>
                </div>
                <div class="form-group">
                    <!--<img id="image_upload_preview" src="" width="100" alt="" />-->
                    <?= HTML::image($review->getFotoUrl(),'', array('id'=>"image_upload_preview",'class' => 'thumb',"width"=>100,'style'=>'background:orange'))  ?>


                    <input id="icon" type="file" name="foto" />
                </div>


                <div class="form-group">
                        <p>Client quote</p>
                        <textarea cols="80"  name="client_quote">{{$review->client_quote}} </textarea>
                     
                </div>
                 
                 <div class="form-group">
                     <label for="is_reviewed">Active</label>
                    
                     <select  type="checkbox" name="is_active" class="form-control">
                         @if($review->is_active > 0)
                         <option selected="selected" value="1">{{trans('admin/feedbacks.yes')}}</option>
                          <option value="0">{{trans('admin/feedbacks.no')}}</option>
                          @else
                          <option value="1">{{trans('admin/feedbacks.yes')}}</option>
                          <option selected="selected" value="0">{{trans('admin/feedbacks.no')}}</option>
                          @endif
                     </select>
                </div>
                               


            <a class="btn btn-default" href="{{ url('/admin/feedbacks') }}" >Back</a>
            <button class="btn btn-primary" type="submit" >  {{trans('admin/feedbacks.update')}}</button>
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
