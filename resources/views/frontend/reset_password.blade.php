<?php
use App\DBConfiguration as cfg;
?>
@extends('frontend.layouts.main')

@section('body')
    <body>
     @include("frontend.include.navbar2")
    <div class="container authorise new-password" id="profile">
        @if(Session::has('info'))
            <p class="alert alert-success">{{Session::get('info') }}</p>
        @endif
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h2>LOST PASSWORD</h2>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="profile-wellcome">
                    <p>Lost your password ? Please enter your email address.<br>
                        You will receive a new password via email.</p>
                </div>

            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 enter-new-pass">
                <form method="POST" action="{{url('/lost')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter Your E-mail">
                    </div>
                    <button type="submit" class="btn btn-default">RESET PASSWORD</button>
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