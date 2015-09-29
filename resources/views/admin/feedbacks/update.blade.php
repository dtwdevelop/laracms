@extends('app')

@section('content')
    <div class="page-header">
        <h1>Page / Create </h1>
    </div>

@include("admin.pages.err")
    <div class="row">
        <div class="col-md-6">

            <form action="{{ url('/admin/pages/update')}}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <input type="hidden" name="id" value="{{ $page->id}}">
                <div class="form-group">
                     <label for="title">TITLE</label>
                     <input type="text" name="title" class="form-control" value="{{$page->title}}"/>
                </div>
                 <div class="form-group">
                     <label for="meta_description">Meta description</label>
                     <input type="text" name="meta_description" class="form-control" value="{{$page->meta_description}}"/>
                </div>
               
                 <div class="form-group">
                     <label for="meta_keywords">Meta keywords</label>
                     <input class="data" type="text" name="meta_keywords" class="form-control" value="{{$page->meta_keywords}}"/>
                     
                </div>
        
                <div class="form-group">
                     
                    <input type="hidden" name="file" value="{{$page->file}}" />
                     
                </div>
        
                  <div class="form-group">
                        <label for="content">Content</label>
                    <textarea name="content" > {{$page->content}}</textarea>
                     
                </div>
                               


            <a class="btn btn-default" href="{{ url('/admin/pages') }}" >Back</a>
            <button class="btn btn-primary" type="submit" >Update</a>
            </form>
        </div>
    </div>
  

@endsection


