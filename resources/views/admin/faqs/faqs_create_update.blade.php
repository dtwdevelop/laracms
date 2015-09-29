@extends('app')

@section('content')
    <div class="page-header">
     <h3>     <a href="{{URL::to('admin/')}}">{{trans('admin/admin.admin_panel')}}</a> >
      <a href="{{URL::to('admin/faqs')}}">{{trans('admin/faqs.title')}}</a>>
    {{trans('admin/faqs.update')}}
         </h3>
    </div>

@include("admin.pages.err")
    <div class="row">
        <div class="col-md-6">

            <form action="{{ url('/admin/faqs/update')}}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <input type="hidden" name="id" value="{{ $review->id}}">
                <div class="form-group">
                     <label for="name">Question</label>
                     <input  type="text" name="question" class="form-control" value="{{$review->question}}"/>
                </div>
                
               
                <div class="form-group">
                   
                        <p>Answer</p>
                    <textarea cols="80"   name="answer">{{$review->answer}} </textarea>
                     
                </div>
                 
                 <div class="form-group">
                   
                    
                      <div class="form-group">
                     <label for="order">Order</label>
                     <input  type="text" name="order" class="form-control" value="{{$review->order}}"/>

                    
                </div>
                           
                </div>
                               


            <a class="btn btn-default" href="{{ url('/admin/faqs') }}" >Back</a>
            <button class="btn btn-primary" type="submit" >{{trans('admin/faqs.update')}} </button>
            </form>
        </div>
    </div>

@endsection
