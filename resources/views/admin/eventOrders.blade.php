@extends('layouts.admin.app')


@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Event Orders</h3>
                    </div>
                    <!-- /.box-header -->


                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="example" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>User Ticket ID</th>
                                                <th>User Name</th>
                                                <th>User Email</th>
                                                <th>Payment Type</th>
                                                <th>Payment Status</th>
                                                <th>Subtotal</th>
                                                <th>Total</th>
                                                <th>Actions</th>
                                            </tr>

                                        </thead>


                                        <tbody>
                                            @foreach ( $orders as $order )
                                            <tr>
                                                <td>{{$order->order_number}}</td>
                                                <td>{{$order->user->ticket_id}}</td>
                                                <td>{{$order->first_name}} {{$order->last_name}}</td>
                                                <td>{{$order->email}}</td>
                                                <td>{{ucfirst($order->payment_method)}}</td>
                                                <td>{{($order->payment_status == 1) ? 'Paid' : 'UnPaid'}}</td>
                                                <td>{{number_format($order->total_ticket_price - $order->total_ticket_fee,2)}}</td>
                                                <td>{{number_format($order->total_ticket_price,2)}}</td>
                                                <td>
                                                    <a href="{{route('admin.order.detail',$order->id)}}"><i class="fa-solid fa-eye" title="View"></i></a>
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
