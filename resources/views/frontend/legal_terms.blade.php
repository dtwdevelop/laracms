<?php

$site = App\SiteSetting::get()->first();

?>

@extends('frontend.layouts.main')

@section('subtitle')
    About Capsilite -
@endsection

@section('body')
    <body class="cookies-page">

    @include("frontend.include.navbar2")
    <div class="container terms-page-container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Terms & Conditions</h1>
                <h3>About cookies</h3>
                <p>Cookies are information packets sent by web servers to web browsers, and stored by the web browsers.<br>
                    The information is then sent back to the server each time the browser requests a page from the server. This enables a web server to identify and track web browsers.<br>
                    There are two main kinds of cookies: session cookies and persistent cookies. Session cookies are deleted from your computer when you close your browser, whereas persistent cookies remain stored on your computer until deleted, or until they reach their expiry date.
                </p>
                <br><br>
                <h2>Cookies on our website</h2>
                <p>Capsilite uses the following cookies on this website, for the following purposes:
                </p>
                <ul>
                    <li>
                        Session cookies used for authentication and shopping cart. Those cookies are critical for application to work.
                    </li>
                    <li>
                        Security cookies used to protect user against web vulnerabilities, for example XSRF attacks. Those cookies are critical for application to work.
                    </li>
                    <li>
                        Usability cookies used to improve user experience and usability, for example to remember authenticated user, remember modal notification windows user has already seen.
                    </li>
                </ul>
                <br><br>
                <h2>Google cookies</h2>
                <p>Capsilite uses Google Analytics to analyse the use of this website. Google Analytics generates statistical and other information about website use by means of cookies, which are stored on users' computers. The information generated relating to our website is used to create reports about the use of the website. Google will store and use this information. Google's privacy policy is available at: http://www.google.com/privacypolicy.html.
                    Capsilite publishes Google Adsense interest-based advertisements on this website. These are tailored by Google to reflect your interests. To determine your interests, Google will track your behaviour across the web using cookies. You can view, delete or add interest categories associated with your browser using Google's Ads Preference Manager, available at: http://www.google.com/ads/preferences/. You can opt-out of the Adsense partner network cookie at: http://www.google.com/privacy_ads.html. However, this opt-out mechanism uses a cookie, and if you clear the cookies from your browser your opt-out will not be maintained. To ensure that an opt-out is maintained in respect of a particular browser, you should use the Google browser plug-in available at: http://www.google.com/ads/preferences/plugin.
                </p>
                <br><br>
                <h2>Refusing cookies</h2>
                <p>Most browsers allow you to refuse to accept cookies.<br>
                    In Internet Explorer, you can refuse all cookies by clicking “Tools”, “Internet Options”, “Privacy”, and selecting “Block all cookies” using the sliding selector.<br>
                    In Firefox, you can adjust your cookies settings by clicking “Tools”, “Options” and “Privacy”.<br>
                    Blocking cookies will have a negative impact upon the usability of some websites.
                </p>
                <br><br>
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