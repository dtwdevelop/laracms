
@extends('frontend.layouts.main')

@section('subtitle')
    Checkout -
@endsection

@section('body')
    <body>
    @include("frontend.include.navbar2")
         @if(Session::has('info'))
<span class="alert alert-warning">{{Session::get('info') }}</span>
@endif
  <form method="POST" id="checkform" action="/pay" data-toggle="validator">
    <div class="container-fluid checkout" id="checkout">
        <div class="row">
            <div class="col-lg-12"><h2>CHECKOUT</h2></div>
            <div class="container">
                <div class="row">
                 
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 billing-address-checkout">
                        <h4>Billing Address</h4>
                        
                             <input type="hidden" name="_token" value="{{ csrf_token() }}">
                             <div class="form-group">
                                <select   id="countries" name="billing_country" class="countries-dropdown-account">
                                @include("frontend.include.countries")
                                </select>
                            </div>
                            <div class="form-group">
                                <input required  type="text" name="billing_first_name" class="form-control" value="{{$user->name}}" id="first-name" placeholder="First Name">
                            </div>
                            <div class="form-group">
                                <input required  type="text" name="billing_last_name" value="{{$user->last_name}}" class="form-control" id="second-name" placeholder="Second Name">
                            </div>
                             <div class="form-group">
                                <input type="text" name='billing_company' value="{{$user->company}}"  class="form-control" id="address" placeholder="Company">
                            </div>
                            <div class="form-group">
                                <input required  type="text" name="billing_address_1" value="{{$user->address_1}}"  class="form-control" id="address" placeholder="Address">
                            </div>
                             <div class="form-group">
                                <input type="text" name="billing_address_2" value="{{$user->address_2}}" class="form-control" id="address" placeholder="Address 2">
                            </div>
                            <div class="form-group">
                                <input required  type="text" name="billing_city" value="{{$user->city}}" class="form-control" id="town-city" placeholder="Town / City">
                            </div>
                            <div class="form-group">
                                <input   type="text" name="billing_state" value="{{$user->state}}" class="form-control" id="state-country" placeholder="State / County">
                            </div>
                            <div class="form-group">
                                <input required  type="text" name="billing_postcode" value="{{$user->postcode}}" class="form-control" id="post-code" placeholder="Postcode / Zip">
                            </div>
                            <div class="form-group">
                                <input type="hidden" id="user_id" name='user_id' value="0">
                                <input required  type="email" name="billing_email" value="{{$user->email}}" class="form-control" id="e-mail" placeholder="E-mail">
                            </div>
                            <div class="form-group">
                                <input required  type="text" name="billing_phone" value="{{$user->phone}}" class="form-control" id="phone-num" placeholder="Phone">
                            </div>
                       
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="checkbox">
                            <p>
                                <input id="c1" class="butcheck" type="checkbox" name="cc" value="1" style="display: none;">
                                <label for="c1">Shipp to billing address</label>
                            </p>
                        </div>
                        <h4>Shipping Address</h4>
                        <span class="hideme">
                            <div class="form-group">
                                <select id="countries" name="shipping_country" class="countries-dropdown-account">
                                @include("frontend.include.countries")
                                </select>
                            </div>
                            <div class="form-group">
                                <input required  type="text" name="shipping_first_name" class="form-control" id="first-name" placeholder="First Name">
                            </div>
                            <div class="form-group">
                                <input required  type="text" name="shipping_last_name" class="form-control" id="second-name" placeholder="Second Name">
                            </div>
                             <div class="form-group">
                                <input   type="text" name='shipping_company' class="form-control" id="address" placeholder="Company">
                            </div>
                            <div class="form-group">
                                <input required  type="text" name='shipping_address_1' class="form-control" id="address" placeholder="Address">
                            </div>
                            <div class="form-group">
                                <input   type="text" name='shipping_address_2' class="form-control" id="address" placeholder="Address 2">
                            </div>
                            <div class="form-group">
                                <input required  type="text" name="shipping_city" class="form-control" id="town-city" placeholder="Town / City">
                            </div>
                            <div class="form-group">
                                <input   type="text" name="shipping_state" class="form-control" id="state-country" placeholder="State / County">
                            </div>
                            <div class="form-group">
                                <input required  type="text" name="shipping_postcode"  class="form-control" id="post-code" placeholder="Postcode / Zip">
                            </div>
                            <div class="form-group">
                                <input required  type="email" name="shipping_email" class="form-control" id="e-mail" placeholder="E-mail">
                            </div>
                            <div class="form-group">
                                <input required  type="text" name="shipping_phone" class="form-control" id="phone-num" placeholder="Phone">
                            </div>
                            
                        </span>
                   
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                        
                           @if(!Auth::check())
                            <div class="modal muser fade bs-example-modal-sm" style="top:100px;" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                            <div class="modal-body">
                                <p id='userinfo'>  </p>
                            </div>

                        </div>
                    </div>
                </div>

                            <div class="modal muser2 fade bs-example-modal-lg" style="top:100px;" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content modaluser2">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                         <h3>&nbsp;Thank you for registering!</h3>
                                        <div class="modal-body">
                                            <p id='userinfo2'>
                                                There has been a confirmation link sent to your email, please follow the link to finish your registration.
                                                <br> If you haven’t received our email, check your junk folder, it might be there.

                                            </p>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div id="opwp_woo_tickets">
                                <!--<input id="c5" type="checkbox" class="maxtickets_enable_cbb" name="opwp_wootickets[tickets][0][enable]" style="display: none;">-->
                                <!--<label for="c5" class="maxtickets_enable_cbb" name="opwp_wootickets[tickets][0][enable]">Create an Account</label>-->
                                <label><input id="create-account-label" type="checkbox" class="maxtickets_enable_cb" name="opwp_wootickets[tickets][0][enable]">Create an Account
                                </label>
                                <div class="max_tickets col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input required class="col-lg-12 col-md-6 col-sm-6 col-xs-12 create-an-account-pass" type="password" name="password" placeholder="Enter Your Password">
                                    <input required class="col-lg-12 col-md-6 col-sm-6 col-xs-12 create-an-account-pass" type="password" name="password_repeat" placeholder="Re-enter Your Password">
                                    <button id="usercreate" type="button">Create user</button>
                                    <input type="hidden" id="regitercheck" name="regitercheck" value="0">
                                </div>

                            </div>

                           @endif

                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 "><h2>YOUR ORDER</h2></div>
                    <div class="col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0 col-xs-11 col-xs-offset-1">
                        <div class="col-md-12 col-sm-12 col-xs-12 header-table-checkout">
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-4">Product</div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Quantity</div>
                            <div class="col-lg-1 col-lg-offset-0 col-md-1 col-md-offset-0 col-sm-1 col-sm-offset-0 col-xs-1 col-xs-offset-3">Total</div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 body-table-checkout">
                             @if(Session::has('pro'))
                                 <?php $i=0;  ?>
                                    @foreach(\Cart::all() as $key=> $product)
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-4 ">
                                <div class="col-lg-2 col-md-1 hidden-sm hidden-xs image-checkout-product">
                                    <!--<img src="http://placehold.it/100x100" alt="..." class="img-responsive"/>-->
               <?= HTML::image('appfiles/products/'.$product->get('id').'/'.$product->get('image'),'',['class'=>'img-responsive','width'=>150])  ?>

                                </div>
                                <h4>{{$product->get('name')}}</h4>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
                               
                                
                                <div class="quatity">{{$item['quantyt'][$i]}}</div>
                              
                            </div>
                            <div class="col-lg-1 col-lg-offset-0 col-md-1 col-md-offset-0 col-sm-1 col-sm-offset-0 col-xs-1 col-xs-offset-1">
                                <div class="cart-subtotal-text">£{{number_format($product->get('price') * $item['quantyt'][$i], 2 )}}</div>
                            </div>
                                     <?php $i++; ?>
                                    <div class="clear margin"></div>
                                     @endforeach
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

      <div class="col-md-9 col-md-offset-0 col-sm-7 col-sm-offset-0 col-xs-12 card-subtotal">
          
          <h4>STANDARD SHIPPING (3-4 WORKING DAYS):</h4>
          
          <h5>For purchases above £{{config('app.free_shipping_price')}} shipping is free</h5>
         
      </div>
      <div class="col-md-3 col-md-offset-0 col-sm-3 col-sm-offset-2 col-xs-12 card-subtotal-price"><h4>@if($total - config('app.shipping_price') < config('app.free_shipping_price'))
                                      £{{config('app.shipping_price') }}
                                      @else
                                      FREE
                                      @endif</h4></div>
      @if(isset($code) && !empty($code ))
      <div id="coupon-zone" class="TODO_hidden">
          <div class="col-md-9 col-md-offset-0 col-sm-7 col-sm-offset-1 col-xs-12 card-subtotal">
              <h4>DISCOUNT COUPON APPLIED:</h4>
              <h5>{{$code}}</h5>
          </div>
          <div class="col-md-3 col-md-offset-0 col-sm-3 col-sm-offset-0 col-xs-12 card-subtotal-price"><h4>{{$copsum}}%</h4></div>
      </div>
      @endif

      <div class="col-md-9 col-md-offset-0 col-sm-7 col-sm-offset-0 col-xs-12 card-subtotal"><h3>CARD SUBTOTAL:</h3></div>
      <div class="col-md-3 col-md-offset-0 col-sm-3 col-sm-offset-1 col-xs-12 card-subtotal-price">

          <h3>
              £
                                        <span class='checktotal'>
                                            @if(Session::has('cart.price'))
                                                
                                                 {{$total}}
                                                 
                                                
                                            @endif
                                        </span>
          </h3>
      </div>

    <div class="container-fluid payment-method">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 "><div class="checkbox">
                        <p>
                           
                            <label for="c2"><img src="img/pay-pal-icon.png"></label>
                        </p>
                    </div>

                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 place-order-btn"><button type="submit" class="btn btn-primary place-order">PLACE ORDER</button></div>
            </div>
        </div>
    </div>
         </form>
    @include("frontend.include.footer")

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
   <script type="text/javascript" src="/js/validator/validator.min.js"></script>
<script type="text/javascript">

jQuery(function () {
    var checbok = $('.butcheck').val();
   var tot = $('.checktotal').text();
    $('.cprice').text(tot);
    
    if(checbok ==1){
         $('.hideme').show();
    
        }
    $('.butcheck').click(function(){
        $('.hideme').toggle();
    });
    
    $('#usercreate').click(function(event){
       
        event.preventDefault();
      var data = $('#checkform').serialize();
     
      $.post('/pay',data,function(response){
          if(response.data == 'error'){
              //  $('#userinfo').html("Please enter password and repeat it.");
               //  $('.muser').modal('show')
              modal("Please enter password and repeat it.");
          }
           if(response.data == 'ok'){
              // $('#userinfo').html("User Created");
               modal("{{ trans('modals.client_registered') }}","{{ trans('modals.client_registered_title') }}" );

               $('#user_id').val(response.user);
               $('#regitercheck').val("1");
               $('#opwp_woo_tickets').hide();
           
         }
            if(response.mail == 'err'){
            // $('#userinfo').html("Your email already exists");
                modal("Your email already exists");

               // $('.muser').modal('show');
         }
            
      });
    });


 });


$('.maxtickets_enable_cb').change(function(){
    if($(this).is(":checked"))
        $('.max_tickets').fadeIn('slow');
    else
        $('.max_tickets').fadeOut('slow');

});

    </script>



    </body>