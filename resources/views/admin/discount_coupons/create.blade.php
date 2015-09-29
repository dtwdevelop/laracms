@extends('app')
<?php 
use App\DiscountCoupons;
?>
@section('content')

    <h1>Create new Discount coupons</h1>
    <hr/>
  @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    {!! Form::open(['url' => 'admin/discount_coupons/store', 'method'=>'POST', 'class' => 'form-horizontal']) !!}
    
    <div class="form-group">
                        {!! Form::label('code', 'Code: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('code', DiscountCoupons::generateCode(), ['class' => 'form-control' ]) !!}
                        </div>    
                    </div><div class="form-group">
                        {!! Form::label('sum', 'Sum: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('sum', null, ['class' => 'form-control']) !!}
                        </div>    
                    </div><div class="form-group">
                        {!! Form::label('valid_till', 'Valid Till: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('valid_till', null, ['class' => 'form-control date']) !!}
                        </div>    
                     
                    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Create new coupon', ['class' => 'btn btn-primary form-control']) !!}
        </div>    
    </div>
    {!! Form::close() !!}
<a class="btn btn-default" href="{{ url('/admin/discount_coupons') }}" >Back</a>

@endsection

@section('styles')
  <link rel="stylesheet" href="/css/bootstrap-datetimepicker.min.css"/>
@endsection

@section('scripts')

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="/js/moment.min.js"></script>
<script src="/js/bootstrap2.min.js"></script>
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>--}}
<script src="/js/bootstrap-datetimepicker.min.js"></script>
<script type='text/javascript'>

   $(document).ready(function(){
          $(function () {
                $('.date').datetimepicker({
                  format:'YYYY-MM-DD'
                });
            });
    });

</script>
@endsection
