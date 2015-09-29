<?php

use App\DBConfiguration as cfg;
?>
@extends('frontend.layouts.main')

@section('subtitle')
    My cart -
@endsection

@section('body')
    <body>
    @include("frontend.include.navbar2")

    <div class="container-fluid cart" id="cart">
        <div class="row">
            <div class="col-lg-12"><h2>MY CART</h2></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0 col-xs-11 col-xs-offset-1 table-cart-heeader">
                        <div class="col-md-12 col-sm-12 col-xs-12 header-table-cart">
                            <div class="col-lg-5 col-xs-3">Product</div>
                            <div class="col-lg-2 col-lg-offset-0 col-xs-2 col-xs-offset-1">Price</div>
                            <div class="col-lg-2 col-lg-offset-0 col-xs-2 col-xs-offset-1">Quantity</div>
                            <div class="col-lg-1 hidden-xs">Total</div>
                            <div class="col-lg-1 hidden-xs"></div>
                        </div>
                        <form method="POST" action="/checkout">
                            <div class="col-md-12 col-sm-12 col-xs-12 body-table-cart">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                @foreach($pro as $key=> $product)

                                    <div class="col-lg-5 col-sm-4 col-xs-4 ">
                                        <div class="col-lg-2 col-md-1 hidden-sm hidden-xs">
                                            <!--<img src="http://placehold.it/100x100" alt="..." class="img-responsive"/>-->
                                            <?php echo HTML::image('appfiles/products/' . $product->get('id') . '/' . $product->get('image'), '', ['class' => 'img-responsive', 'width' => 150]) ?>
                                        </div>
                                        <h4>{{$product->get('name')}}</h4>
                                    </div>

                                    <div class="col-lg-2 col-lg-offset-0 col-sm-2 col-sm-offset-0 col-xs-2 col-xs-offset-0">
                                        <div class="cart-price-text">&pound <span id="price{{$product->get('id') }}"
                                                                                  class="price">{{$product->get('price')}}</span>
                                        </div>

                                    </div>

                                    <div class="col-lg-2 col-lg-offset-0 col-sm-2 col-sm-offset-1 col-xs-4 col-xs-offset-1">
                                        <input type="hidden" name="item[id][]" value="{{$product->id}}">
                                        <input id="{{$product->get('id')}}" type="number" name="item[quantyt][]"
                                               class="form-control text-center qt quantyty" min="1"
                                               value="{{$product->get('qty')}}">
                                    </div>

                                    <div class="col-lg-1 col-sm-1 hidden-xs">

                                        <div class="cart-subtotal-text">
                                            &pound;<span id="sub{{$product->get('id')}}"
                                                         class="subtotal">{{number_format($product->price * $product->get('qty') ,2) }}</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-1 col-lg-offset-0 col-sm-1 col-sm-offset-1 col-xs-4 col-xs-offset-8">
                                        <!--<button id="/remove/{{$key}}" class="btn btn-danger btn-sm delete-btn-product" type="button"><img src="img/delete-icon.png"></button>-->
                                        <a class="btn btn-danger btn-sm delete-btn-product" href="/remove/{{$key}}"><img
                                                    src="img/delete-icon.png" width="30"></a>
                                    </div>

                                    <div class="clear margin"></div>
                                @endforeach


                                <div class="col-md-9 col-md-offset-0 col-sm-7 col-sm-offset-0 col-xs-12 card-subtotal">

                                    <h4>STANDARD SHIPPING (3-4 WORKING DAYS):</h4>

                                    <h5>For purchases above £{{config('app.free_shipping_price')}} shipping is free</h5>

                                </div>
                                <div class="col-md-3 col-md-offset-0 col-sm-3 col-sm-offset-2 col-xs-12 card-subtotal-price">
                                    <h4>
                                        <span id="shipping-price">
                                        @if(Session::get('cart.price') < config('app.free_shipping_price'))
                                                &pound{{config('app.shipping_price')}}
                                            @else
                                                FREE

                                            @endif
                                        </span>
                                    </h4></div>

                                <div id="coupon-zone" class="coupinfo">
                                    <div class="col-md-9 col-md-offset-0 col-sm-7 col-sm-offset-1 col-xs-12 card-subtotal">
                                        <h4>DISCOUNT COUPON APPLIED:</h4>
                                        <h5 class="couponcode"></h5>
                                    </div>
                                    <div class="col-md-3 col-md-offset-0 col-sm-3 col-sm-offset-2 col-xs-12 card-subtotal-price">
                                        <h4 class="dsum"></h4></div>
                                </div>

                                <div class="col-md-9 col-md-offset-0 col-sm-7 col-sm-offset-0 col-xs-12 card-subtotal">
                                    <h3>CART SUBTOTAL:</h3></div>
                                <div class="col-md-3 col-md-offset-0 col-sm-3 col-sm-offset-2 col-xs-12 card-subtotal-price">
                                    <h3>
                                        £
                                        <span class='tot'>

                                            @if(Session::has('cart.price'))
                                                @if(Session::get('cart.price') < config('app.free_shipping_price'))
                                                    {{Session::get('cart.price')+ config('app.shipping_price') }}
                                                @else
                                                    {{Session::get('cart.price')}}
                                                @endif
                                            @endif
                                        </span>
                                    </h3>
                                </div>


                                <div class="col-md-8 col-sm-8 col-xs-12">

                                    <div class="form-group">
                                        <input type="text" autocomplete="off" class="form-control card-coupon-input"
                                               value="" id="coupon-input" placeholder="Coupon code">
                                        <span id="message"></span>
                                    </div>
                                    <button autocomplete="off" type="button" class=" cop btn btn-default coupon">Apply
                                        coupon
                                    </button>

                                </div>
                                <div class="col-md-4 col-md-offset-0 col-xs-5 col-xs-offset-6 media-offset-checkout-btn">
                                    <button type="submit" class="btn btn-primary checkout procceed-to-checkout">PROCEED
                                        TO CHECKOUT
                                    </button>
                                </div>
                                @if(Session::has('cart.price'))




                                    <?php $val = (Session::get('cart.price') < config('app.free_shipping_price')) ? Session::get('cart.price') + config('app.shipping_price') : Session::get('cart.price'); ?>
                                    <input type="hidden" name="total" class="shiphide" value="{{$val}}">


                                @endif
                                <input type="hidden" name="code" class="couponcode" value="">
                                <input type="hidden" name="codesum" class="codesum" value="">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(1===0)
        <div class="container-fluid cart-total">
            <div class="row">
                <div class="col-lg-12 col-sm-12"><h2>CART TOTALS</h2></div>
                <div class="container">
                    <div class="col-lg-12 col-lg-offset-0 col-sm-12 col-sm-offset-0 col-xs-11 col-xs-offset-1 cart-total-border">
                        <div class="col-md-9 col-md-offset-0 col-sm-8 col-sm-offset-1 col-xs-8 col-xs-offset-2"><h5>
                                SHIPPING</h5></div>
                        <div class="col-md-3 col-md-offset-0 col-sm-3 col-sm-offset-0 col-xs-8 col-xs-offset-2"><h5>
                                STANDART SHIPPING (3-4 WORKING DAYS) £ {{config('app.shipping_price')}}</h5></div>
                        <div class="col-md-9 col-md-offset-0 col-sm-8 col-sm-offset-1 col-xs-8 col-xs-offset-2"><h5>
                                ORDER TOTAL</h5></div>
                        <div class="col-md-3 col-md-offset-0 col-sm-3 col-sm-offset-0 col-xs-8 col-xs-offset-2"><h5>
                                £ @if(Session::has('cart.price'))     <span
                                        class="ship">{{Session::get('cart.price') + config('app.shipping_price') }}</span> @endif</h5></div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @include("frontend.include.footer")

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">

        jQuery(function () {
            // $('.cop').removeAttr('disabled');
            function toFixed(number, precision) {
                var multiplier = Math.pow(10, precision + 1),
                        wholeNumber = Math.round(number * multiplier).toString(),
                        length = wholeNumber.length - 1;
                wholeNumber = wholeNumber.substr(0, length);
                return [
                    wholeNumber.substr(0, length - precision),
                    wholeNumber.substr(-precision)
                ].join('.');
            }

            var counpon = 0;
            var flag = false;
            var pro;
            $('.coupinfo').hide();

            var totbut = $(".tot").text();
            $('.cprice').text(totbut);

            function totalsums() {

                var totalsum = 0;

                $('.subtotal').each(function (el, v) {

                    var val = $(v).text();

                    totalsum += parseFloat(val);


                });


                return totalsum;

            }

            function quantity() {
                var totalq = 0;
                $('.qt').each(function (el, v) {

                    var c = $(v).val();

                    totalq = totalq + parseInt(c);


                });

                return totalq;
            }

            /**
             *
             * @param sum + shipping
             * @returns sum
             */
            function shipping(sum) {

                //  sum = parseFloat(sum);

                if (sum < {{config('app.free_shipping_price')}}) {

                    $('#shipping-price').text("£{{config('app.shipping_price')}}");


                    var ship = parseFloat({{config('app.shipping_price')}});

                    return ship;
                }

                else if (sum > {{config('app.free_shipping_price')}}) {

                    $('#shipping-price').text("FREE");

                    return 0;
                }


            }

            $('.cop').click(function () {
                var coupon = $('#coupon-input').val();
                if (coupon == "")
                    coupon = 0;
                $.getJSON('/api/get-coupon/' + coupon, function (data) {
                    //  console.log(data);
                    if (data.error == 'err') {
                        $('#message').html('<span style="color: red">Invalid coupon</span>');
                    }
                    if (data.sum) {
                        if (data.is_activated == 1) {
                            $('#message').html('<span style="color: red">Coupon already activated</span>');
                        }
                        else if (data.is_expired == 1) {
                            $('#message').html('<span style="color: red">Coupon has expired</span>');
                        }
                        else {
                            $('#message').html('<span style="color: green">Valid Coupon</span>');

                            var sum = parseFloat(data.sum) / 100;
                            var sub = parseFloat(totalsums());
                            pro = sum;
                            var pr = sub * sum;
                            var dis = pr;
                            counpon = dis;

                            var totatsub = totalsums();

                            var ship = shipping(totatsub);



                           // var disc = shipping(dis);
                            dis = (totatsub - pr) + ship ;

                            //  dis = toFixed(dis+disc,2);
                           // shipping($('.tot').text())
                            flag = true;


                            $('.tot').text(toFixed(dis, 2));
                            $('.shiphide').val(toFixed(dis, 2));

                            $('.cprice').text(toFixed(dis, 2));
                            $('.couponcode').html(data.code);
                            $('.couponcode').text(data.code);

                            $('.dsum').html(data.sum + " %");
                            $('.codesum').val(data.sum);

                            $('.coupinfo').show();

                            $('.cop').attr('disabled', 'disabled');
                        }

                    }
                });
            });


            $('.quantyty').change(function (e) {

                e.preventDefault();

                var attr = $(this).attr('id');

                var q = $(this).val();


                var price = $('#price' + attr).text();

                price = parseFloat(price);

                var price = parseInt(q) * price;
                $('#sub' + attr).text(price.toFixed(2));

                var totatsub = totalsums();


                var ship = shipping(totatsub);

                if (flag) {
                    //  var pros  = totatsub * pro;
                    //  console.log(quantity(), "tatal item");
                    var result = totatsub * pro;
                    //var sh = shipping(result)

                    ship = (totatsub - result ) + ship ;
                   // shipping($('.tot').text())
                }
                else {
                    ship = totatsub + ship;
                }
                //17.79
                $('.cprice').text(toFixed(ship, 2));
                $('.tot').text(toFixed(ship, 2));
                $('.shiphide').val(toFixed(ship, 2));


            });


        });

        function getProducts() {
        }


    </script>


    </body>
