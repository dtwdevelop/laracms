@extends('app')

@section('content')
    <div class="page-header">
         <!--path-->
     <h3><a href="{{URL::to('admin/')}}">{{trans('admin/admin.admin_panel')}}</a> >
      <a href="{{URL::to('admin/contact_messages')}}">{{trans('admin/contact_messages.message')}}</a>>
    {{trans('admin/contact_messages.view')}}
<!--endpath-->
       </h3>
    </div>

@include("admin.pages.err")
    <div class="row">
        <div class="col-md-6">

            <form action="{{ url('/admin/contact_messages/update')}}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <input type="hidden" name="id" value="{{ $review->id}}">
                <div class="form-group">
                     <label for="name">Name</label>
                     <input disabled="disabled" type="text" name="name" class="form-control" value="{{$review->name}}"/>
                </div>
                 
                  <div class="form-group">
                     <label for="last_name"> Last name</label>
                     <input disabled="disabled" type="text" name="last_name" class="form-control" value="{{$review->last_name}}"/>
                </div>
                 <div class="form-group">
                     <label for="email">Email</label>
                     <input disabled="disabled" type="text" name="email" class="form-control" value="{{$review->email}}"/>
                </div>
               
                 <div class="form-group">
                     <label for="is_reviewed">Reviewed</label>
                    
                     <select  type="checkbox" name="is_reviewed" class="form-control">
                         @if($review->is_reviewed > 0)
                         <option selected="selected" value="1">{{trans('admin/contact_messages.yes')}}</option>
                          <option value="0">{{trans('admin/contact_messages.no')}}</option>
                          @else
                          <option value="1">{{trans('admin/contact_messages.yes')}}</option>
                          <option selected="selected" value="0">{{trans('admin/contact_messages.no')}}</option>
                          @endif
                     </select>
                </div>
        
                
        
                  <div class="form-group">
                        <label for="message">Message</label>
                        <textarea  class="form-control" cols="80" disabled="disabled" name="content">{{$review->message}} </textarea>
                     
                </div>
                               


            <a class="btn btn-default" href="{{ url('/admin/contact_messages') }}" >Back</a>
            <button class="btn btn-primary" type="submit" >Update</a>
            </form>
        </div>
    </div>
  

@endsection


