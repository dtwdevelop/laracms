@extends('admin.layouts.default')

@section('content')

    <h1>Advertising</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>ID.</th><th>Name</th>
            </tr>
            <tr>
                <td>{{ $advertising->id }}</td><td>{{ $advertising->name }}</td>
            </tr>
        </table>
    </div>

@endsection
