<?php
use App\DBConfiguration as cfg;
?>
@extends('frontend.layouts.main')

@section('body')
    <body>
    @include("frontend.include.navbar2")
    <div class="container authorise" id="auth">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h2>MY ACCOUNT</h2>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                @if(Session::has('message'))
                    <?php $type = (Session::has('message-type')) ? Session::get('message-type') : 'success'; ?>
                    <div class="alert alert-{{$type}}" role="alert">
                        {{ Session::get('message') }}
                    </div>
                @endif
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <h4>LOG IN</h4>
                <form method="POST" action="{{url('auth')}}">
                    <div class="form-group">

                     <input  type="hidden" name="_token" value="{{ csrf_token() }}">

                        <input type="email" name="email" value="{{old('email')}}" required="required" class="form-control" id="login-email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input name="password" type="password" required="required" class="form-control" id="login-password" placeholder="Password">

                    </div>
                    <button type="submit" class="btn btn-default">LOG IN</button>
                </form>
            </div>
            
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <h4>REGISTER</h4>
                 
                <form method="POST" action="{{url('/register')}}">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </div>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{old('first_name')}}" placeholder="First name">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-users"></i>
                            </div>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{old('last_name')}}" placeholder="Last name">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                            </div>
                            <input type="email" class="form-control" id="register-email" name="registration_email" value="{{old('registration_email')}}" placeholder="Email">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-unlock-alt"></i>
                            </div>
                            <input type="password" class="form-control" id="register-password" name="password" placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-lock"></i>
                            </div>
                            <input type="password" class="form-control" id="register-password-re" name="password_confirmation" placeholder="Re-enter password">
                        </div>
                    </div>

                    <button type="register" class="btn btn-default">REGISTER</button>
                </form>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 lost-pass"><a href="reset-password">Lost Password ?</a></div>

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
