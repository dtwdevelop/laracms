@extends('app')

@section('content')
    <div class="page-header">
        <h1>Timelines / Create </h1>
    </div>

@include("timelines.err")
    <div class="row">
        <div class="col-md-6">

            <form action="{{ route('admin.timelines.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                     <label for="title">TITLE</label>
                     <input type="text" name="title" class="form-control" value=""/>
                </div>
                 <div class="form-group">
                     <label for="title">Projects</label>
                      {!! Form::select('project_id', $projects) !!}
                </div>
               
                 <div class="form-group">
                     <label for="title">Start</label>
                     <input class="data" type="text" name="start" class="form-control" value=""/>
                     
                </div>
                <div class="form-group">
                     <label for="title">End</label>
                     <input class="data" type="text" name="end" class="form-control" value=""/>
                     
                </div>


            <a class="btn btn-default" href="{{ route('admin.timelines.index') }}">Back</a>
            <button class="btn btn-primary" type="submit" >Create</a>
            </form>
        </div>
    </div>


@endsection

@section('styles')
<link href="/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

@endsection

@section('scripts')
<!--<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="/js/bootstrap.js"></script>
<scritp src='/js/bootstrap-datetimepicker.min.js'></scritp>
<script type="text/javascript">
   $(document).ready(function() {
    $('.data').datepicker();
})
  
</script>-->
@endsection('scripts')