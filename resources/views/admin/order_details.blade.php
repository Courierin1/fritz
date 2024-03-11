@extends('layouts.admin.app')


@section('content')



<section class="content">
    <div class="container-fluid">
    @include('alerts')
    <div class="row">

    <h3 class="box-title mb-3">Order Details</h3>


</div>




        <div class="row mt-3">
        <div class="col-md-6 border-0">

        </div>
        <div class="col-md-4 border-0">

        </div>
        <div class="col-md-2 border border-secondary text-right mb-3" style="color: #858bcc;padding:15px">
        <p>Order # {{$order->order_number}}<p>
        <p>User Ticket ID: {{$order->user->ticket_id}}<p>
        <p>First Name : {{ucfirst($order->first_name)}}<p>
        <p>Last Name : {{ucfirst($order->last_name)}}<p>
        <p>Email :  {{ucfirst($order->email)}}<p>
        <p>Payment Method :  {{ucfirst($order->payment_method)}}<p>

        </div>

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">

                    </div>
                    <!-- /.box-header -->


                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Event</th>
                                            <th>Ticket Type</th>

                                            <th>Total Tickets</th>
                                            <th>Price</th>

                                        </tr>


                                    </thead>

                                    <tbody>
                                    @foreach($tickets as $ticket)

                                    <tr>

                                        <td><a href="{{ route('user.view.event', $ticket->event['id']) }}">{{$ticket->event['title']}}</a></td>
                                        <td>{{$ticket->ticket_type}}</td>

                                        <td>{{$ticket->no_of_tickets}}</td>
                                        <td>{{number_format($ticket->ticket_price*$ticket->no_of_tickets,2)}}</td>


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
