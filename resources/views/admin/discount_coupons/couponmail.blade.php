
@extends('app')
<?php 
use App\DiscountCoupons;
?>
@section('content')

    <h1>Send coupon code to email</h1>
    <hr/>
@if(isset($coupon))
@endif
  @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
   @if(Session::has('info'))
<p class="alert alert-success">{{Session::get('info') }}</p>
@endif
    {!! Form::open(['url' => 'admin/discount_coupons/sendmail', 'method'=>'POST', 'class' => 'form-horizontal']) !!}
    <input type='hidden' name="code" value="{{$coupon->code}}">
    <input type='hidden' name="id" value="{{$coupon->id}}">
    <div class="form-group">
                        {!! Form::label('code', 'Name', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('name', null, ['class' => 'form-control' ]) !!}
                        </div>    
                    </div>
    
     <div class="form-group">
                        {!! Form::label('Email', 'Email: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('email', null, ['class' => 'form-control' ]) !!}
                        </div>    
                    </div>

    <div class="form-group">
       
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Send', ['class' => 'btn btn-primary form-control', 'onclick'=>"if(confirm('Are you sure you want to send it?')) { return true } else {return false };"]) !!}
             
        </div>    
    </div>
    {!! Form::close() !!}
 <a class="btn btn-default" href="{{ url('/admin/discount_coupons') }}" >Back</a>
  
@endsection