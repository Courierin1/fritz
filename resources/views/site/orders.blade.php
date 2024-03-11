@extends('layouts.site.app')


@section('content')

<style>
    .swal2-popup .swal2-styled
    {
        margin: 0px 5px 0 !important;
    }
</style>

<section id="order">

    <div class="container">
        <div class="row">

            <div class="col-md-12">
            </div>
        </div>
    </div>

</section>

<div class="container">
        <div class="row pb-5 order-table">

    <div class="col-md-12">


    <div class="table-responsive">
    <table class="table table-hover mt-5 mb-5" id="example">
        <h3>Event Orders</h3>
        <thead class="order">
            <tr>
                <th>Order ID</th>
                <th>User Name</th>
                <th>User Email</th>
                <th>Payment Method</th>
                <th>Payment Status</th>
                <th>Total</th>
                <th>Date</th>
                <th>Request Refund</th>
                <th>Print</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($orders))
                @foreach ( $orders as $order)
                <tr>
                    <td>{{$order->order_number}}</td>
                    <td>{{$order->first_name . ' ' . $order->last_name}}</td>
                    <td>{{$order->email}}</td>
                    <td>{{ucfirst($order->payment_method)}}</td>
                    <td>{{$order->payment_status==1? 'Paid' : 'UnPaid' }}</td>
                    <td>${{number_format($order->total_ticket_price, 2)}}</td>
                    <td>{{Carbon\Carbon::parse($order->created_at)->format('M d, Y')}}</td>
                    <td class="refund_requested">
                        @if ($order->refund_requested == 0 && $order->total_ticket_price != 0.00)
                        <a href="{{ route('refund_request', ['id' => $order->id]) }}" class="request_refund" data-id="{{$order->id}}">Refund Request</a>
                        @elseif ($order->refund_requested == 1)
                            @if($order->refund_status == 1)
                                Accepted
                            @elseif($order->refund_status == 0)
                                Rejected
                            @else
                                Pending
                            @endif
                        @endif
                    </td>
                    <td>
                        @if ($order->refund_status != 1)
                        <a href="{{ route('print_invoice', ['id' => $order->id]) }}" target="__blank">Print</a>
                        @endif
                    </td>
                </tr>
                @endforeach
                @else
                <td colspan="9"><center> No orders found!</center></td>
            @endif

        </tbody>
    </table>
    </div>

  </div>


</div>



</div>

@endsection

@section("js")

<script type="text/javascript">

    $(document).ready(function() {
    $('#user_orders').DataTable({
        order: [[ 0, 'desc' ]]
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('click', '.request_refund', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to request refund for this order?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
            }).then((result) => {
            if (result.isConfirmed) {
                let href = $(this).attr('href');
                let id = $(this).attr('data-id');
                let this1 = this;
                $.ajax({
                    type: 'POST',
                    url: href,
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: id
                    },
                    success: function (data) {
                        // successtoast(data.success);
                        $(this1).closest('.refund_requested').text('Pending');
                        if (data.message == 'success') {
                            Swal.fire(
                            'Success!',
                            'Your Request has been Submitted.',
                            'success'
                            )
                        }else {
                            alert('Something went wrong!');
                        }
                    },
                    error: function (request, status, error) {
                        alert('Something went wrong!');
                    }
                });
            }
        })
    });
});
</script>
@endsection
