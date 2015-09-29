
@extends('frontend.layouts.main')

@section('body')

<body>
  <?php
use App\Slider;
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
                                <li class="col-md-4 col-sm-4 col-xs-12 col-xs-offset-0"><a href="#products">Products</a></li>
                                <li class="col-md-4 col-sm-4 col-xs-12 col-xs-offset-0"><a href="about-us">About</a></li>
                                <li class="col-md-4 col-sm-4 col-xs-12 col-xs-offset-0"><a  class="cls" href="#contacts">Contacts</a></li>
                            </ul>


                        </div><!-- /.navbar-collapse -->
                    </nav>
                </div>
                <div class="col-lg-5 col-lg-offset-0 col-md-5 col-md-offset-0 col-sm-12 col-sm-offset-0  col-xs-8 col-xs-offset-2 card-login">
                    <nav class="navbar navbar-default main-menu">
                        <ul class="nav navbar-nav">

                                    <li class="card hidecart">
                                        <a href="my-cart">
                                     <i class="fa fa-shopping-cart "></i>

                                    <span class="cart">
                                    @if(Session::has('cart.price'))
                                            {{Session::get('total')}} @if(Session::get('total') == 1) Item @else Items  @endif  &pound; -  {{Session::get('cart.price')}}
                                    @endif
                                    </span>       
                                
                                </a></li>

                            <li class="order"><a href="#products">Order now</a></li>
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
    
<div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators-->

        <ol class="carousel-indicators">

            @foreach(\App\Slider::all() as $li=> $slider)
                @if($slider->name == "/")

            <li data-target="#myCarousel" data-slide-to="{{$li}}" class="@if($li  == 0) active @endif"></li>
                @endif
            @endforeach
        </ol>
    <div class="carousel-inner" role="listbox">
        <!-- Wrapper for slides -->
        @foreach(\App\Slider::all() as $k=> $slider)


            @if($slider->name == "/")
                <div class="item    @if($k  == 0) active @endif ">
                    <img width="200" src="{{$slider->getIconUrl()}}">
                    <div class="header-text">
                        <div class="col-md-12 col-xs-12 text-center">
                            <h2>
                            <span>
                                278 more calories burned
                                <br>
                                before, during and after exercises!
                            </span>
                            </h2>
                            <br>
                            <div class="slider-button">
                                <a class="" href="#products">ORDER NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
             @endif
                @endforeach
            </div>







                     <div class="modal mcart fade bs-example-modal-sm"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <span class="popup_gray_header_cursor"></span>
                                <p>Item added to cart  </p>
                            </div>

                        </div>
                    </div>
                </div>

    </div>
    <div class="container-fluid callories">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h2>WHAT IS 278 CALORIES WORTH?</h2>
                </div>
                @foreach($benefits as $benefit)
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <img src="{{$benefit->getImageUrl()}}"  class="thumb" width="100" />
                    <p><?php echo nl2br(htmlspecialchars($benefit->description)); ?></p>
                </div>
               @endforeach
               
            </div>
        </div>
    </div>


    <div class="container-fluid packages" id="products">
        <div class="row">
            <div class="col-lg-12"><h2>PRODUCTS</h2></div>
             
            @foreach($products as $product )
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
             
                <?= HTML::image('appfiles/products/'.$product->id.'/'.$product->image,'')  ?>
                <h4>{{$product->name}}</h4>
                <p class="packages-price">&pound; {{$product->price}}</p>
                <a class="addb btn btn-default" href="{{url('/addcart',$product->id)}}" role="button">Add to cart</a>
            </div>
            
            @endforeach
        </div>
    </div>
    <div class="container-fluid testimonials">
        <div class="col-lg-12"><h2>FEEDBACK</h2></div>
        <div id="testimonials-carousel" class="carousel slide testimonials" data-ride="carousel">
                <!-- Wrapper for slides -->
            <div id="feedBack" class="carousel-inner" role="listbox" >

                @foreach($feedback as $f=> $feed)

                <div class="item @if($f  == 0) active @endif ">
                    <div class="header-text">
                        <div class="col-md-8 col-md-offset-1 col-xs-12 text-center">
                            <h2>
                                <span>
                                    <i>"{{$feed->client_quote}}"</i>
                                </span>
                            </h2>
                            <br>
                            <p class="author"> - {{$feed->client_name}}</p>
                        </div>
                        <div class="col-md-3 hidden-xs feedback-image">

                            {!!  HTML::image($feed->getFotoUrl(),'') !!}
                        </div>
                    </div>
                </div>

                @endforeach
               

            </div>

            <ol class="carousel-indicators">
                @foreach($feedback as $fol=> $feed)

                    <li data-target="#testimonials-carousel" data-slide-to="{{$fol}}" class="@if($fol  == 0) active @endif"></li>

                @endforeach
            </ol>

        </div>
    </div>

    <div class="container contact-us" id="contacts">
        <div class="row">
            <div class="col-lg-12"><h2>CONTACT US</h2></div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="modal cmodal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p>Thank you for getting in touch, we will respond to your query as soon as possible!</p>
                            </div>

                        </div>
                    </div>
                </div> 
                <div class="modal errmodal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body ">
                                <p class="techic">Please fill all required fields</p>
                            </div>

                        </div>
                    </div>
                </div> 
                <form role="form" id="contactf" action="/" method="POST" data-toggle="validator">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="sr-only" for="name">Name</label>
                                <input  required type="text" name="name"  data-error="required Name" class="form-control" id="name" placeholder="Enter your name">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="sr-only" for="last_name">Last name</label>
                                <input  required type="text" name="last_name" data-error="required Last name" class="form-control" id="phone" placeholder="Enter your last name">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="sr-only" for="email">Email address</label>
                                <input  required type="email"  data-error="required Email" name="email" class="form-control" id="e-mail" placeholder="Enter your email">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <div class="form-group">
                            <textarea data-error="required Message"  required name="content" class="form-control" rows="3" placeholder="Message"></textarea>
                            <span class="help-block with-errors"></span>
                            </div>
                               <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12 capdiv">

                                <span style="color:red; float:left" class="cerror"></span>

                                <input required class="form-control" type="text" name="captcha" placeholder="code from image">

                            </div>

                            <span class="cap" style="float:left">{!!  captcha_img('flat')  !!}</span>
                            </div>



                        <div class="form-group">
                        <button  type="submit" class="btn btn-default btnc">SEND</button>
                           </div>
                    </div>

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
     <script type="text/javascript" src="/js/validator/validator.min.js"></script>
    <script type="text/javascript">

jQuery(function () {
    function clearForm(form_el) {
        form_el.find('input[type=text]').val('');
        form_el.find('input[type=email]').val('');
        form_el.find('input[type=checkbox]').prop('checked', false);
        form_el.find('textarea').val('');

    }
     // $('.btnc').css('border','none');
    @if(Session::has('total'))
     $('.hidecart').show();
    @else
  $('.hidecart').hide();
    @endif
$('#contactf').validator().on('submit', function (e) {
                if (e.isDefaultPrevented()) {
                    // handle the invalid form...
                } else {

                    e.preventDefault();
                    var input = $("#contactf").serialize();

                    $.post("/", input, function (data) {
                        if(data.ex){
                            modal("Can't send mail  some problem!","Info");
                            // $('.errmodal').modal('show');

                        }
                        else{
                            modal('Thank you for getting in touch, we will respond to your query as soon as possible!','Thanks');
                            clearForm($("#contactf"));
                            //  $('.cmodal').modal('show');
                            $.get('/codegenerator',function(data){
                                $("span >img").attr('src',data.code);
                            });
                            $('.cerror').html("");

                        }



                    }, 'json').fail(function (data) {




                        // $('.errmodal').modal('show');

//            var img =  $('img').attr('src','/captcha/flat');
//            $('.cap').append(img);
                        $.get('/codegenerator',function(data){
                            $("span >img").attr('src',data.code);
                        });
                        $.each(data.responseJSON, function (i, v) {
                            if(i == "captcha"){
                                $('.cerror').html("the captcha field is required");
                            }
                            else{
                                $('.cerror').html("");
                            }
                        });
                    });

                }
            });
//    $('.btnc').click(function (e) {
//                e.preventDefault();
//
//    });

  $('.addb').click(function(e){
      e.preventDefault();
      var link = $(this).attr('href');
      
      $.getJSON(link,function(data){
          var items="Item";
          if(data.total >1){
              items="Items";
          }
          $('.cart').html( data.total+" " +items+"   &pound;- " +data.cart);
            $('.mcart').modal('show');
          $('.hidecart').show();
      }).fail(function(){

      });
  });


});



    </script>
  @include("frontend.include.advertising")
  @include("frontend.include.cookies")
</body>
@endsection
