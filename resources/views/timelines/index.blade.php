@extends('app')

@section('content')
    <div class="page-header">
        <h1>Pages</h1>
        
    </div>

@if(Session::has('photo'))
<p class="alert alert-success">{{Session::get('photo') }}</p>
@endif
    <div class="row">
        <div class="col-md-6">
           
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>TITLE</th>
                        <th class="text-right">OPTIONS</th>
                    </tr>
                </thead>

                <tbody>
          

                @foreach($pages as $page)
                <tr>
                    
                    <td>{{$page->title}}</td>
                    <td class="text-right">
                        <a class="btn btn-warning " href="{{ url('/admin/pages/edit', $page->id) }}">Edit</a>
                        <form action="{{ route('admin.timelines.destroy', $timeline->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}"> <button class="btn btn-danger" type="submit">Delete</button></form>
                    </td>
                </tr>

                @endforeach
                </tbody>
            </table>

            <a class="btn btn-success" href="{{ route('admin.pages.create') }}">Create</a>
        
        
        </div>
    </div>



@endsection