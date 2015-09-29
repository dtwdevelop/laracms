@extends('emails._email_order')

@section('content')

    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 12px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
        You have received an order from {{$order->billing_first_name}}. Their order is as follows:</p>

    <h4 style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 20px; line-height: 1.6; font-weight: bold; margin: 0 0 10px; padding: 0;">
        Order: #{{$order->id}} {{date('M d Y', strtotime($order->created_at)) }}</h4>

    <table style="border: 1px solid #DDD; border-collapse: collapse; margin: 14px 0; width: 570px;">
        <thead>
        <tr>
            <th style="border: 1px solid #DDD; width: 120px; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: bold; margin: 0 0 10px; padding: 3px 5px;">
                Product
            </th>
            <th style="border: 1px solid #DDD; width: 80px; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: bold; margin: 0 0 10px; padding: 3px 5px;">
                Quantity
            </th>

            <th style="border: 1px solid #DDD; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: bold; margin: 0 0 10px; padding: 3px 5px;">
                Price
            </th>
        </tr>
        </thead>

        <tbody>

        @foreach ($items->items as $k => $item)
            <tr>
                @if ($item->{'sku'} == 0 )

                    <td colspan="2"
                        style="border: 1px solid #DDD; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 12px; line-height: 1.6; font-weight: bold; margin: 0 0 10px; padding: 3px 5px;">
                        Order Discount:
                    </td>
                    <td style="border: 1px solid #DDD; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 12px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 3px 5px;">
                        £ {{ $item->{'price'} }}  </td>

                @elseif ($item->{'sku'} == 1 )

                @elseif($item->{'sku'} !== 0  or $item->{'sku'} !== 1 )
                    <td style="border: 1px solid #DDD; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 12px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 3px 5px;"> {{$item->{'name'} }}</td>

                    <td style="border: 1px solid #DDD; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 12px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 3px 5px;">{{ $item->{'quantity'} }} </td>
                    <td style="border: 1px solid #DDD; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 12px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 3px 5px;">
                        £ {{number_format($item->{'price'} * $item->{'quantity'},2)  }}</td>

                @endif
            </tr>
        @endforeach

        <tr>
            <td colspan="2"
                style="border: 1px solid #DDD; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 12px; line-height: 1.6; font-weight: bold; margin: 0 0 10px; padding: 3px 5px;">
                Shipping:
            </td>
            @if($order->order_total_sum < 59.99)
                <td style="border: 1px solid #DDD; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 12px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 3px 5px;">
                    Shipping: £4.99 via Standard Shipping (3-4 Working Days)
                </td>
            @else
                <td style="border: 1px solid #DDD; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 12px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 3px 5px;">
                    Free
                </td>
            @endif
        </tr>
        <tr>
            <td colspan="2"
                style="border: 1px solid #DDD; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: bold; margin: 0 0 10px; padding: 3px 5px;">
                Order Total:
            </td>
            <td style="border: 1px solid #DDD; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: bold; margin: 0 0 10px; padding: 3px 5px;">
                £ {{$order->order_total_sum}} </td>
        </tr>

        </tbody>
    </table>

    <h3 style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 20px; line-height: 1.6; font-weight: bold; margin: 0 0 10px; padding: 0;">
        Customer details</h3>
    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: bold; margin: 0 0 10px; padding: 0;">
        Email: <a href=""> {{$order->billing_email}}</a></p>
    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: bold; margin: 0 0 10px; padding: 0;">
        Tel: {{$order->billing_phone}}</p>

    <table style="border-collapse: collapse; margin: 14px 0; width: 570px;">
        <thead>
        <tr>
            <th style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 18px; text-align: left; line-height: 1.6; font-weight: bold; margin: 0 0 10px; padding: 0;">
                Billing address
            </th>
            <th style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 18px; text-align: left; line-height: 1.6; font-weight: bold; margin: 0 0 10px; padding: 0;">
                Shipping address
            </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 12px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">{{$order->billing_first_name}}</td>
            <td style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 12px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">{{$order->shipping_first_name}}</td>
        </tr>
        <tr>
            <td style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 12px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">{{$order->billing_company}}</td>
            <td style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 12px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">{{$order->shipping_company}}</td>
        </tr>
        <tr>
            <td style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 12px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">{{$order->billing_address_1}}</td>
            <td style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 12px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">{{$order->shipping_address_1}}</td>
        </tr>
        <tr>
            <td style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 12px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">{{$order->billing_city}}</td>
            <td style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 12px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">{{$order->shipping_city}}</td>
        </tr>
        <tr>
            <td style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 12px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">{{$order->billing_country}}</td>
            <td style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 12px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">{{$order->shipping_country}}</td>
        </tr>
        <tr>
            <td style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 12px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">{{$order->billing_postcode}}</td>
            <td style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 12px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">{{$order->shipping_postcode}}</td>
        </tr>
        </tbody>
    </table>

@endsection
