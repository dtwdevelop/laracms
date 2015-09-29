@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Timelines / Show </h1>
    </div>


    <div class="row">
        <div class="col-md-12">

            <form action="#">
                <div class="form-group">
                    <label for="nome">ID</label>
                    <p class="form-control-static">{{$timeline->id}}</p>
                </div>
                <div class="form-group">
                     <label for="title">TITLE</label>
                     <p class="form-control-static">{{$timeline->title}}</p>
                </div>
            </form>



            <a class="btn btn-default" href="{{ route('timelines.index') }}">Back</a>
            <a class="btn btn-warning" href="{{ route('timelines.edit', $timeline->id) }}">Edit</a>
            <form action="#/$timeline->id" method="DELETE" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><button class="btn btn-danger" type="submit">Delete</button></form>
        </div>
    </div>


@endsection