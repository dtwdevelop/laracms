@extends('app')

@section('content')
    <div class="page-header">
        <h1>Timelines / Edit </h1>
    </div>

@include("timelines.err")
    <div class="row">
        <div class="col-md-6">

            <form action="{{ route('admin.timelines.update', $timeline->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="nome">ID </label>
                    <p class="form-control-static">{{$timeline->id}}</p>
                </div>
                <div class="form-group">
                     <label for="title">TITLE</label>
                     <input type="text" name="title" class="form-control" value="{{$timeline->title}}"/>
                </div>
                
                   <div class="form-group">
                     <label for="title">Projects</label>
                      {!! Form::select('project_id', $projects) !!}
                </div>
               
                 <div class="form-group">
                     <label for="title">Start</label>
                     <input type="date" name="start" class="form-control" value="{{$timeline->start}}"/>
                     
                </div>
                <div class="form-group">
                     <label for="title">End</label>
                     <input type="date" name="end" class="form-control" value="{{$timeline->end}}"/>
                     
                </div>



            <a class="btn btn-default" href="{{ route('admin.timelines.index') }}">Back</a>
            <button class="btn btn-primary" type="submit" >Save</a>
            </form>
        </div>
    </div>


@endsection