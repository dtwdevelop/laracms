@extends('app')

@section('content')
    <div class="page-header">
        <h1>Product / Create </h1>
    </div>

@include("admin.pages.err")
    <div class="row">
        <div class="col-md-6">

            <form action="{{ url('/admin/products/store') }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                     <label for="name">Name</label>
                     <input type="text" name="name" class="form-control" value=""/>
                </div>
                
               
                 <div class="form-group">
                     <label for="price">Price</label>
                     <input class="data" type="text" name="price" class="form-control" value=""/>
                     
                </div>
        
                <div class="form-group">
                     <label for="image">Image</label>
                     <input type="file" name="image" />
                     
                </div>
        
              
                               


            <a class="btn btn-default" href="{{ url('/admin/products') }}">Back</a>
            <button class="btn btn-primary" type="submit" >Create</a>
            </form>
        </div>
    </div>


@endsection
