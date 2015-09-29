<nav class="navbar navbar-default navbar-inverse navbar-fixed-top">
    <div class="container" style="width: 95%;">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{URL::to('admin/')}}">{{trans('admin/admin.admin_panel')}}</a>
        </div>

        @if(Auth::check() && Auth::user()->admin==1)
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <!--<li class="{{ (Request::is('admin') ? 'active' : '') }}">
                    <a href="{!! URL::to('admin/') !!}"><i class="fa fa-home"></i> {{trans('admin/admin.home')}}</a>
                </li>-->

                <li class="{{ (Request::is('admin/orders') ? 'active' : '') }}">
                    <a href="{!! URL::to('admin/orders') !!}"><i class="fa fa-shopping-cart"></i> Orders</a>
                </li>

                <li class="{{ (Request::is('admin/discount_coupons') ? 'active' : '') }}">
                    <a href="{!! URL::to('admin/discount_coupons') !!}"><i class="fa fa-ticket"></i> Coupons</a>
                </li>

                <li class="{{ (Request::is('admin/contact_messages') ? 'active' : '') }}">
                    <a href="{!! URL::to('admin/contact_messages') !!}"><i class="glyphicon glyphicon-envelope"></i> Messages</a>
                </li>

                <li class="{{ (Request::is('admin/advertising') ? 'active' : '') }}">
                    <a href="{!! URL::to('admin/advertising') !!}"><i class="fa fa-line-chart"></i> Advertisements</a>
                </li>
                 <!--<li class="{{ (Request::is('admin/config') ? 'active' : '') }}">
                    <a href="{!! URL::to('admin/config') !!}"> <i class="fa fa-cog"></i>
                         Configurations</a>
                </li>-->
                <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">More <span class="caret"></span></a>
               <ul class="dropdown-menu">
                   <li class="{{ (Request::is('admin/site_settings') ? 'active' : '') }}">
                       <a href="{!! URL::to('admin/site_settings') !!}"><i class="fa fa-cog"></i> Site settings</a>
                   </li>
                  <li class="{{ (Request::is('admin/pages') ? 'active' : '') }}">
                    <a href="{!! URL::to('admin/pages') !!}"><i class="fa fa-list-alt"></i> {{trans('admin/pages.pages')}}</a>
                </li>
                  <li class="{{ (Request::is('admin/products') ? 'active' : '') }}">
                    <a href="{!! URL::to('admin/products') !!}"><i class="fa fa-barcode"></i> {{trans('admin/products.title')}}</a>
                </li>
                  <li class="{{ (Request::is('admin/files') ? 'active' : '') }}">
                    <a href="{!! URL::to('admin/files') !!}"><i class="fa fa-file-text-o"></i> Files</a>
                </li>
                 <li class="{{ (Request::is('admin/feedbacks') ? 'active' : '') }}">
                    <a href="{!! URL::to('admin/feedbacks') !!}"><i class="fa fa-comments"></i> {{trans('admin/feedbacks.title')}}</a>
                </li>
                 <li class="{{ (Request::is('admin/faqs') ? 'active' : '') }}">
                    <a href="{!! URL::to('admin/faqs') !!}"><i class="fa fa-question"></i> {{trans('admin/faqs.title')}}</a>
                </li>
                 <li class="{{ (Request::is('admin/benefits') ? 'active' : '') }}">
                    <a href="{!! URL::to('admin/benefits') !!}"><i class="fa fa-plus"></i> {{trans('admin/benefits.title')}}</a>
                </li>

                   <li class="{{ (Request::is('admin/sliders') ? 'active' : '') }}">
                       <a href="{!! URL::to('admin/sliders') !!}"><i class="fa fa-arrows-h"></i> {{trans('admin/sliders.sliders')}}</a>
                   </li>

                   <li class="{{ (Request::is('admin/users') ? 'active' : '') }}">
                       <a href="{!! URL::to('admin/users') !!}"><i class="glyphicon glyphicon-user"></i> {{trans('admin/admin.users')}}</a>
                   </li>

               </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li class="{{ (Request::is('auth/login') ? 'active' : '') }}"><a href="{!! URL::to('auth/login') !!}"><i
                                    class="fa fa-sign-in"></i> Login</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false"><i class="fa fa-user"></i> {{ Auth::user()->name }} <i
                                    class="fa fa-caret-down"></i></a>
                        <ul class="dropdown-menu" role="menu">
                            @if(Auth::check())
                                @if(Auth::user()->admin==1)
                                    <li>
                                        <a href="{!! URL::to('admin/dashboard') !!}"><i class="fa fa-tachometer"></i> Dashboard</a>
                                    </li>
                                @endif
                                <li role="presentation" class="divider"></li>
                            @endif
                            <li>
                                <a href="{!! URL::to('auth/logout') !!}"><i class="fa fa-sign-out"></i> Logout</a>
                            </li>

                        </ul>
                    </li>
                @endif
            </ul>
        </div>
        @endif
    </div>
</nav>