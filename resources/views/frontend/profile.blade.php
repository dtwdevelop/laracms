
@extends('frontend.layouts.main')

@section('subtitle')
    My Profile -
@endsection

@section('body')
    <body>
    @include("frontend.include.navbar2")
    <div class="container authorise" id="profile">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h2>MY ACCOUNT</h2>
                @if(Session::has('info'))
                    <div class="alert alert-warning">{{Session::get('info') }}</div>
                @endif
            </div>
           
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="profile-wellcome">
                    <p>Hello, <strong>{{$user->first_name}}</strong>.
                        From your account dashboard you can view your recent orders, manage your billing, shipping addresses or <a href="change-password">change your password</a></p>
                </div>
              </div>
            <form method="POST" action="/my-profile" data-toggle="validator">
            <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0">
                @include("frontend.err")
                <h4>Billing Address</h4>
                
                   
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <select   id="countries" name="billing_country" class="countries-dropdown-account">
                                @include("frontend.include.countries")
                                </select>
                            </div>
                            <div class="form-group">
                                <input required  type="text" name="billing_first_name" class="form-control" value="{{$user->first_name}}" id="first-name" placeholder="First Name">
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
                                <input required  type="email" name="billing_email" value="{{$user->email}}" class="form-control" id="e-mail" placeholder="E-mail">
                            </div>
                            <div class="form-group">
                                <input required  type="text" name="billing_phone" value="{{$user->phone}}" class="form-control" id="phone-num" placeholder="Phone">
                            </div>
                    <button type="submit" class="btn btn-default">SAVE ADDRESS</button>
                
            </div>
           
            </form>
        </div>
    </div>

    <div class="container-fluid history">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h2>HISTORY</h2>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0 col-xs-11 col-xs-offset-1">
                        <div class="col-md-12 col-sm-12 col-xs-12 header-table-history">
                            <div class="col-lg-5 col-sm-2 col-xs-3">Product</div>
                            <div class="col-lg-2 col-lg-offset-0 col-sm-2 col-xs-2 col-xs-offset-1">Price</div>
                            <div class="col-lg-2 col-lg-offset-0 col-sm-2 col-xs-2 col-xs-offset-1">Quantity</div>
                            <div class="col-lg-1 col-sm-2 hidden-xs">Total</div>
                            <div class="col-lg-1 col-sm-2 hidden-xs">DATE</div>
                        </div>
                        <!--form order-->
                        @if(isset($order))
                        @foreach($order as $item)
                                @if($item->order_status ==2)
                        <div class="col-md-12 col-sm-12 col-xs-12 body-table-history">
                        
                       

                        @foreach($item->products as $product)
                     
                            <div class="col-lg-5 col-sm-3 col-xs-4 ">
                                <div class="col-lg-2 col-md-1 hidden-sm hidden-xs">
                        <?= HTML::image('appfiles/products/'.$product->id.'/'.$product->image,'',['class'=>'img-responsive','width'=>100])  ?>

                                    <!--<img src="http://placehold.it/100x100" alt="..." class="img-responsive"/>-->
                                </div>
                                <h4>{{$product->name}}</h4>
                            </div>
                            <div class="col-lg-2 col-lg-offset-0 col-sm-2 col-sm-offset-0 col-xs-2 col-xs-offset-0">
                                <div class="history-price-text">&pound; {{$product->product->product_price}}</div>
                            </div>
                            <div class="col-lg-2 col-lg-offset-0 col-sm-2 col-sm-offset-1 col-xs-4 col-xs-offset-1">
                                <div class="quatity"> {{$product->product->quantity}}</div>
                            </div>
                            <div class="col-lg-1 col-sm-1 hidden-xs">
                                <div class="history-price-text"> &pound; {{$item->order_total_sum}}</div>
                            </div>
                            <div class="col-lg-1 col-lg-offset-0 col-sm-1 col-sm-offset-1 col-xs-8 col-xs-offset-2 date-history">
                                <div class="visible-xs">
                                    Date :
                                </div>
                                <div>{{date('M d Y', strtotime($item->created_at)) }}</div>
                            </div>
                        <div class="clear margin"></div>
                           @endforeach
                         @endif
                        
                       
                        </div>
                       @endforeach
                        <?= $order->render(); ?>
                        @endif
                       
                          
                    </div>
                        
                </div>
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
    <script type="text/javascript" src="/js/validator/validator.min.js"></script>
    </body>
@endsection