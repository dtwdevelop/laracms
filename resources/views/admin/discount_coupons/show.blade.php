@extends('layouts.master')

@section('content')

    <h1>Discount_coupon</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>ID.</th><th>Name</th>
            </tr>
            <tr>
                <td>{{ $discount_coupon->id }}</td><td>{{ $discount_coupon->name }}</td>
            </tr>
        </table>
    </div>

@endsection
