

@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {{{ trans("admin/photo.photo") }}} @parent @stop

{{-- Content --}}
@section('main')
 <div class="container">

@if($contact->message)
<div class="row">
    <div class="col-md-6">
   
    <a class="btn btn-success" href="{{ url("/admin/contact")}}">Back</a>
    <h4>First contact message</h4>
    <div class="col-lg-6">{{$contact->message}}</div>
    <h4>All Client  message</h4>
</div>
</div>

@foreach($messages as $msg)

<div class="row">
    <div class="col-lg-6">{{$msg->message}}</div>
</div>
<hr>
@endforeach
<a class="btn btn-success" href="{{ url("/admin/contact")}}">Back</a>
@endif
</div>
@stop

{{-- Scripts --}}
@section('scripts')
    @parent
 
@stop