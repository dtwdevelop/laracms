@extends('app')

@section('content')
    <div class="page-header">
             <!--path-->
    <h3> <a href="{{URL::to('admin/')}}">{{trans('admin/admin.admin_panel')}}</a> >
      <a href="{{URL::to('admin/files')}}">{{trans('admin/files.title')}}</a>>
    {{trans('admin/files.update')}}
<!--endpath-->
         </h3>
    </div>

@include("admin.pages.err")
    <div class="row">
        <div class="col-md-6">

            <form action="{{ url('/admin/files/update')}}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <input type="hidden" name="id" value="{{ $page->id}}">
                <div class="form-group">
                     <label for="title">Name</label>
                     <input type="text" name="name" class="form-control" value="{{$page->name}}"/>
                </div>
                
                 <div class="form-group">
                     
                     <a class="btn btn-success" href="/admin/files/download/{{$page->id}}">View file</a>
                     
                </div>
                
                 
                <div class="form-group">
                     
                    <input type="file" name="file" value="" />
                     
                </div>
        
                 
                               


            <a class="btn btn-default" href="{{ url('/admin/files') }}" >Back</a>
            <button class="btn btn-primary" type="submit" >Update</a>
            </form>
        </div>
    </div>
  

@endsection


