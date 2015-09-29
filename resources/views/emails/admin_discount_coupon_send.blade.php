
@include('emails._email_header')
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    Dear {{$name}},
</p>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    To claim the <b>{{$sum}}%</b> discount, type this code in at the check out:
</p>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 17px; line-height: 1.6; font-weight: bold; margin: 0 0 10px; padding: 0;">
    {{$code}}
</p>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Arial, sans-serif; font-size: 14px; line-height: 1.2; color: #000; font-weight: normal; margin: 40px 0 10px; padding: 0;">
    This coupon will expire on <b>{{$expire}}</b>.
</p>
@include('emails._email_footer')
