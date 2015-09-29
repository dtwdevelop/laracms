<?php
use App\DBConfiguration as cfg;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>{{cfg::get('site_title')}}@yield('subtitle')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="{{cfg::get('site_description')}}" />
    <meta name="keywords" content="{{cfg::get('site_keywords')}}" />
    <link href="/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" type="text/css" href="css/slider.css" />
    @yield('styles')
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    @yield('scripts_top')
</head>

@yield('body')

@yield('scripts_bottom')

</html>
