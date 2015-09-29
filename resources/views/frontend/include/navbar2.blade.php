<?php

$site = App\SiteSetting::get()->last();

?>

<header>
    <div class="container-fluid">

        <div class="row logo-menu">

            <div class="col-md-1 col-md-offset-0 col-sm-4 col-sm-offset-4 col-xs-8 col-xs-offset-2 col-xs-8 col-xs-offset-2 logo"><a href="/" ><img src="{{$site->getLogoUrl()}}"></a></div>

            <div class="col-lg-5 col-lg-offset-1 col-md-5 col-md-offset-1 col-sm-12 col-xs-12 second-menu">
                <nav class="navbar navbar-default">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">

                        <button type="button" class="navbar-toggle collapsed col-sm-9 col-sm-offset-1  col-xs-8 col-xs-offset-2" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0  col-xs-10 col-xs-offset-1">
                            <li class="col-md-4 col-sm-4 col-xs-12 col-xs-offset-0"><a href="/#products">Products</a></li>
                            <li class="col-md-4 col-sm-4 col-xs-12 col-xs-offset-0"><a href="about-us">About</a></li>
                            <li class="col-md-4 col-sm-4 col-xs-12 col-xs-offset-0"><a  class="cls" href="/#contacts">Contacts</a></li>
                        </ul>


                    </div><!-- /.navbar-collapse -->
                </nav>
            </div>
            <div class="col-lg-5 col-lg-offset-0 col-md-5 col-md-offset-0 col-sm-12 col-sm-offset-0  col-xs-8 col-xs-offset-2 card-login">
                <nav class="navbar navbar-default main-menu">
                    <ul class="nav navbar-nav">
                        @if(Session::has('total'))
                        <li class="card">
                            <a href="my-cart">
                                <i class="fa fa-shopping-cart "></i>

                                    <span class="cart">
                                    @if(Session::has('cart.price'))
                                            {{Session::get('total')}} @if(Session::get('total') == 1) Item @else Items  @endif  &pound; - <span class="cprice">{{Session::get('cart.price')}}</span>
                                        @endif
                                    </span>

                            </a></li>
                        @endif
                        <li class="order"><a href="/#products">Order now</a></li>
                        @if (Auth::guest())
                            <li class="account"><a href="{!! URL::to('auth') !!}">Login / Register</a></li>
                        @else
                            @if(Auth::user())
                                <li class="account">
                                    <div class="dropdown account">
                                        <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            My Account
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu account" aria-labelledby="dLabel">
                                            <li class="card"><a href="{!! URL::to('/my-profile') !!}">My Profile</a></li>
                                            @endif
                                            <li class="order"><a href="{!! URL::to('auth/logout') !!}">Log out</a></li>
                                        </ul>
                                    </div>
                                </li>

                            @endif
                    </ul>
                </nav>
            </div>

        </div>
        <div class="row">


        </div>
    </div>
    </div>
</header>