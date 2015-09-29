<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
</head>
<body style="width: 600px; border: 1px solid #DDD">
    <h3 style="text-align: center; background: orange; color: white; padding: 4px; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 20px; line-height: 1.6; font-weight: bold; margin: 0 0 10px;"> {{$title}} </h3>
    <div style="padding: 12px;">

    @if (isset($_original_sendmail_to))
        <h5 style="color: red">Original send mail to:
            @if (is_array($_original_sendmail_to))
                @foreach($_original_sendmail_to as $_o)
                    {{$_o}},
                @endforeach
            @else
                {{$_original_sendmail_to}}
            @endif
        </h5>
    @endif

    @yield('content')

    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 12px; line-height: 1.6; font-weight: normal; margin: 10px 0 10px 0; padding: 0;">
        Kind Regards,<br>
        Capsilite Team<br>
        <a href="mailto:{{config('mail.username')}}">{{config('mail.username')}}</a><br>
        <a href="{{config('app.url')}}">{{config('app.url')}}</a><br>
    </p>
    <a style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 12px; line-height: 1.6; font-weight: normal; margin: 0 0 10px 0; padding: 0;" href="{{config('app.url')}}"> <img src="{{App\SiteSetting::get()->last()->getLogoUrl()}}" alt="Logo" /></a>

    </div>
</body>
</html>
