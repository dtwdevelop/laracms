<?php

$site = App\SiteSetting::get()->first();

?>

@extends('frontend.layouts.main')

@section('subtitle')
    About Capsilite -
@endsection

@section('body')
    <body>

   @include("frontend.include.navbar2")

    <div class="container-fluid how-works">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h2>WHAT, HOW AND WHY?</h2>
            </div>
            @if(isset($pages[0]))
            <div class="col-md-4 col-sm-12 col-sx-12">
                <h4>
                    {{$pages[0]->title}}
                </h4>
                <p>
                    {!! $pages[0]->content !!}
                </p>
            </div>
            @endif
             @if(isset($pages[1]))
            <div class="col-md-4 col-sm-12 col-sx-12">
                <h4>
                    {{$pages[1]->title}}
                </h4>
                <p>
                    {!! $pages[1]->content !!}
                </p>
            </div>
             @endif
              @if(isset($pages[2]))
            <div class="col-md-4 col-sm-12 col-sx-12">
                <h4>
                    {{$pages[2]->title}}
                </h4>
                <p>
                    {!! $pages[2]->content !!}
                </p>
            </div>
              @endif
           
           
        </div>
    </div>


    <div id="about-slider" class="carousel about-slider" data-ride="carousel">
        {{--<ol class="carousel-indicators">--}}
            {{--@foreach(\App\Slider::all() as $li=> $slider)--}}
                {{--<li data-target="#about-slider" data-slide-to="{{$li}}" class="@if($li  == 0) active @endif"></li>--}}
            {{--@endforeach--}}
        {{--</ol>--}}
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            @foreach(\App\Slider::all() as $k=> $slider)


                @if($slider->name == "about-us")
                <div class="item     active  ">
                    <img width="200" src="{{$slider->getIconUrl()}}">
                    <div class="header-text">
                        <div class="col-md-12 col-xs-12 text-center">

                            <div class="slider-button">
                                <a class="" href="/#products">ORDER NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
               @endif
            @endforeach

        </div>

    </div>
    <div class="container-fluid clinical-info">
        <div class="container">
            <div class="row">
                 @if(isset($pages[3]))
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h2> {{$pages[3]->title}}</h2>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <p>
                         {!! $pages[3]->content !!}
                    </p>
                </div>
                  @endif
                <div class="clinical-info-space"></div> </div> </div>



    </div>
   <div class="container-fluid clinical-info-list">
       <div class="row">

               @if(isset($pages[4]))
                   <div class="col-md-4 col-sm-12 col-sx-12">
                       <h4>{{$pages[4]->title}}</h4>
                       <p>{!! $pages[4]->content !!}</p>
                   </div>
               @endif
               @if(isset($pages[5]))
                   <div class="col-md-4 col-sm-12 col-sx-12">
                       <h4>{{$pages[5]->title}} </h4>
                       <p>
                           {!! $pages[5]->content !!}
                       </p>
                   </div>
               @endif
               @if(isset($pages[6]))
                   <div class="col-md-4 col-sm-12 col-sx-12">
                       <h4>{{$pages[6]->title}}</h4>
                       <p>
                           {!! $pages[6]->content !!}
                       </p>
                       @endif
                   </div>

       </div>
   </div>
    <div class="container-fluid clinical-files">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h4>DOWLOAD Clinical Research Files</h4>
            </div>
            @foreach($files as $file)
            <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="file-button">
                    <a href="/files/{{$file->id}}">{{$file->name}}</a>
                </div>
            </div>
          
            @endforeach
        </div>
    </div>
    <div class="container-fluid faq">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h2>FAQ</h2>
            </div>
            <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
                <div id="menu">
                    <div class="panel list-group">
                        @foreach($faqs as $k=> $faq)
                        
                        <a href="#id1{{$faq->id}}" class="list-group-item" data-toggle="collapse" data-target="#id{{$faq->id}}" data-parent="#menu">
                           {{$faq->question}}
                        </a>
                        <div id="id{{$faq->id}}" class="sublinks collapse">
                             {!!$faq->answer !!}
                        </div>
                       @endforeach
                       
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h2><a href="/#contacts">Ask a question</a></h2>
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