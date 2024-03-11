@extends('layouts.admin.app')


@section('content')

<section class="content">
    <div class="container-fluid" id="event1">
        <div class="row">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Participants</h3>
                    </div>
                    <!-- /.box-header -->


                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="example" class="table">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Name</th>
                                            <th>Email</th>                                            <th>Event Name</th>
                                            <th>Payment Method</th>
                                            <th>Payment Status</th>
                                            <th>Total Tickets</th>
                                            <th>Subtotal</th>
                                            <th>Total</th>
                                        </tr>
</thead>
<tbody>
                                            @if (count($showEventTickets)==0)
                                                <tr>
                                                    <center>
                                                        <td colspan="9">No participants found!</td>
                                                    </center>
                                                </tr>
                                            @else
                                                @foreach ( $showEventTickets as $showEventTicket )
                                                <tr>
                                                    <td>{{$showEventTicket->order_id}}</td>
                                                    <td>{{$showEventTicket->first_name}} {{$showEventTicket->last_name}}</td>
                                                    <td>{{$showEventTicket->email}}</td>                                                
                                                    <td>PayPal</td>
                                                    <td>{{($showEventTicket->payment_status == 1) ? 'Paid' : 'UnPaid'}}</td>
                                                    <td><i class="fa-solid fa-ticket"></i> {{$showEventTicket->no_of_tickets}}</td>
                                                    <td>${{number_format($showEventTicket->ticket_price)}}</td>
                                                    <td>${{number_format($showEventTicket->ticket_price)}}</td>
                                                </tr>
                                                @endforeach
                                            @endif
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
