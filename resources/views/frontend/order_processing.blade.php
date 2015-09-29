<?php
use App\DBConfiguration as cfg;
?>
@extends('frontend.layouts.main')

@section('body')
    <body>
     @include("frontend.include.navbar2")

    <div class="container-fluid checkout thanks-page-margin" id="checkout">
        <div class="row">
            <div class="col-lg-12"><h2>CONFIRMATION</h2></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="profile-wellcome">
                            @if(isset($order))
                            <p>Thank you for your order !<br>
                                You will get confirmation letter on your email.</p>
                            @else
                                <div><h3>Your order is canceled</h3>
                                </div>
                             @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid cart-total">
        <div class="row">
            <div class="container">
                @if(isset($order))
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 confirmation-head-table">
                    <div class="col-lg-5 col-md-3 col-sm-3 col-xs-4">Order</div>
                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4">Date</div>
                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3">Total</div>
                    <div class="col-lg-2 col-md-3 col-sm-3 hidden-xs">Payment method</div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 confirmation-body-table">
                    <div class="col-lg-5 col-md-3 col-sm-3 col-xs-3">#{{$order->id}}</div>
                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4">{{date('M d Y', strtotime($order->created_at)) }}</div>
                    <div class="col-lg-2 col-lg-offset-0 col-md-3 col-md-offset-0 col-sm-3 col-sm-offset-0 col-xs-4 col-xs-offset-1">&pound; {{$order->order_total_sum}}</div>
                    <div class="col-lg-2 col-md-3 col-sm-3 hidden-xs">PAY PAL</div>
                </div>

                @endif
            </div>
        </div>
    </div>

    @include("frontend.include.footer")
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>


    </body>