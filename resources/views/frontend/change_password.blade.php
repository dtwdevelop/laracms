<?php
use App\DBConfiguration as cfg;
?>
@extends('frontend.layouts.main')

@section('body')
    <body>
    @include("frontend.include.navbar2")
    <div class="container authorise new-password" id="profile">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h2>CHANGE PASSWORD</h2>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="profile-wellcome">
                    <p>Hello, <strong>{{$user->first_name}}</strong>.
                        Here you can change your password</p>
                </div>
              @if(Session::has('info'))
                    <div class="alert alert-warning">{{Session::get('info') }}</div>
                @endif
            </div>
            @include("frontend.include.err")
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 enter-new-pass">
                <form method="POST" action="/change">
                       <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0">
                        <input required type="password" name='passwordold' class="form-control" id="current-password" placeholder="Enter Current Password">
                    </div>
                    <div class="form-group col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0">
                        <input required   type="password" name='newpassword' class="form-control" id="new-password" placeholder="Enter New Password">
                    </div>
                    <div class="form-group col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0">
                        <input required  type="password" name='newpasswordr' class="form-control" id="new-password" placeholder="Re-enter New Password">
                    </div>
                       <button type="submit" class="btn btn-default">SAVE NEW PASSWORD</button>
                </form>
            </div>

        </div>
    </div>
   @include("frontend.include.footer")

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    </body>
@endsection