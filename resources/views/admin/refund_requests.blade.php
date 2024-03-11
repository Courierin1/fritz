@extends('layouts.admin.app')
@section('title', 'Event Orders')
@section('content')

<section class="content">
    <div class="container-fluid" id="org-data">
        <div class="row">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Refund Requests</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="user_orders" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>User Name</th>
                                                <th>User Email</th>
                                                <th>Payment Type</th>
                                                <th>Payment Status</th>
                                                <th>Total</th>
                                                <th>Request Status</th>
                                                <th>Created At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ( $eventOrders as $eventOrder)
                                            <tr>
                                                <td>{{$eventOrder->order_number}}</td>
                                                <td>{{$eventOrder->first_name}} {{$eventOrder->last_name}}</td>
                                                <td>{{$eventOrder->email}}</td>
                                                <td>{{$eventOrder->payment_type}}</td>
                                                <td>{{($eventOrder->payment_status == 1) ? 'Paid' : 'UnPaid'}}</td>
                                                <td>${{number_format(($eventOrder->total_ticket_price - $eventOrder->ticket_fee), 2)}}</td>
                                                <td>
                                                    <select name="request_status" 
                                                    data-id="{{$eventOrder->refundRequest->id}}" 
                                                    data-href="{{ route('update_admin_refund_request', $eventOrder->refundRequest->id ) }}"
                                                    >
                                                        <option value="-1" {{($eventOrder->refundRequest->accept_by_planner == -1) ? 'selected' : ''}}>Pending</option>
                                                        <option value="1" {{($eventOrder->refundRequest->accept_by_planner == 1) ? 'selected' : ''}}>Accepted</option>
                                                        <option value="0" {{($eventOrder->refundRequest->accept_by_planner == 0) ? 'selected' : ''}}>Rejected</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <p>{{ Carbon\Carbon::parse($eventOrder->refundRequest->created_at)->format('M d, Y') }}</p>
                                                </td>
                                                <td>
                                                    <a href="{{route('admin.order.detail',$eventOrder->id)}}"><i class="fa-solid fa-eye" title="View"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




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
    $(document).on('change', 'select[name="request_status"]', function(e) {   
        let href = $(this).attr('data-href');
        let id = $(this).attr('data-id');
        let status = $(this).val();
        $.ajax({
            type: 'POST',
            url: href,
            data: {
                _token: $("meta[name='csrf-token']").attr("content"),
                id: id,
                status: status
            },
            success: function (data) {
                // successtoast(data.success);
                if (data.message == 'success') {
                        successtoast('status updated');
                } else {
                        errortoast('Something went wrong!');
                }
            },
            error: function (request, status, error) {
                alert('something went wrong');
            }
        });
    });
});
</script>  

@endsection