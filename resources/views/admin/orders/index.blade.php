@extends('app')

@section('content')
<table class="table table-striped">
    <thead>
    <tr>
        <th class="text-left">Number</th>
        <th class="text-left">Billing first name</th>
        <th class="text-left">Billing last name</th>
        <th class="text-left">Billing email</th>
        <th class="text-left">Billing phone</th>
        <th class="text-left">Order date</th>
        <th class="text-left">  Order total </th>
        <th class="text-left">Status  </th>
       
        <th class="text-left">Actions </th>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
    @if ($order->order_status == 0)
    <tr class="danger">
    @elseif ($order->order_status == 1)
    <tr class="success">
    @else
    <tr>
    @endif
        <td>{{ $order->id }}</td>
        <td>{{ $order->billing_first_name }}</td>
        <td>{{ $order->billing_last_name }}</td>
        <td>{{ $order->billing_email }}</td>
        <td>{{ $order->billing_phone }}</td>

        <td>{{ date('M d Y  h:m', strtotime($order->created_at)) }}</td>
        <td>{{$order->order_total_sum}}</td>
        <td>
            @if($order->order_status > 0)
                <i class="fa fa-check"></i>

            @endif
                @if($order->order_status == 0)
                <i class="fa fa-times"></i>

            @endif
        </td>
        <td>
            @if($order->order_status == 1)
            <form action="{{ url('/admin/orders/completed')}}" method="POST" style="display: inline;" onsubmit="if(confirm('Complete? Are you sure?')) { return true } else {return false };"><input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" value="{{$order->id}}" name="complete">
                <button class="btn btn-sm btn-success" type="submit">Complete</button>
            </form>


            @endif
        </td>
    </tr>

    @endforeach
    <?php echo $orders->render(); ?>
    </tbody>
</table>
@endsection
