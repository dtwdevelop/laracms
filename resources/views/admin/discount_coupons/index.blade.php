@extends('app')
@section('content')
    <h1>Discount coupons <a href="{{ url('admin/discount_coupons/create') }}" class="btn btn-primary pull-right btn-sm">Add
            New </a></h1>
    @if(Session::has('info'))
        <p class="alert alert-success">{{Session::get('info') }}</p>
    @endif
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>id</th>
                <th>sum</th>
                <th>code</th>

                <th>Valid</th>

                <th>Date added</th>
                <th>Is activated</th>
                <th>Actions</th>
            </tr>
            {{-- */$x=0;/* --}}
            @foreach($discount_coupons as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $item->id}}</td>
                    <td>{{ $item->sum}}</td>
                    <td>{{ $item->code}}</td>

                    <td>{{ date('M d Y', strtotime($item->valid_till)) }}</td>
                    <td>{{ date('M d Y', strtotime($item->created_at)) }}</td>
                    <td>
                        @if($item->is_activated == 0 )
                            No
                        @else
                            Yes
                        @endif
                    </td>
                    <td>
                    @if($item->is_activated == 0 )

                        @if($item->is_sent == 0  )
                            <a href="{{ url('admin/discount_coupons/'.$item->id.'/send') }}">
                                    <button type="submit" class="btn btn-info btn-xs">Send to email</button>
                                </a>


                        @elseif($item->is_sent == 1  )
                            <a href="{{ url('admin/discount_coupons/'.$item->id.'/send') }}">
                                    <button onclick="if(confirm('You before sended to email? Are you sure?')) { return true } else {return false };"
                                            type="submit" class="btn btn-warning btn-xs">Resend to email
                                    </button>
                                </a>

                        @endif

                    @endif

                        <form action="{{ url('admin/discount_coupons/delete', $item->id) }}" method="POST"
                              style="display: inline;"
                              onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                            <input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token"
                                                                                      value="{{ csrf_token() }}">
                            <button class="btn btn-danger btn-xs" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            {{ $discount_coupons->render() }}
        </table>
    </div>

@endsection
