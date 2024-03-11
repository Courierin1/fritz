@extends('layouts.planner.app')


@section('content')

<section class="content">
    <div class="container-fluid" id="evt-desh">
        <div class="row">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">

                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="box-title mb-5">Dashboard</h3>

                            </div>

                        </div>
                        <!-- /.box-header -->


                        <div class="box-body">



                            <div style="background-color:unset;padding:unset;" class="row" id="admin-dash123">
                                <div class="col-md-3">

                                    <div class="event-detail">
                                        <img src="{{asset('assets/images/totalevents.png')}}" alt="">
                                        <div class="det">
                                            <h3>Total Events</h3>
                                    <h3>{{$totalEvents}}</h3>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="event-detail">
                                        <img src="{{asset('assets/images/PastEvents.png')}}" alt="">
                                        <div class="det">
                                            <h3>Past Events</h3>
                                    <h3>{{$pastEvents}}</h3>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-3 cent">
                                    <div class="event-detail">
                                        <img src="{{asset('assets/images/current.png')}}" alt="">

                                        <div class="det">
                                            <h3>Current Events</h3>
                                    <h3>{{$UpComingEvents}}</h3>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-3">
                                    <div class="event-detail">
                                        <img src="{{asset('assets/images/Orders.png')}}" alt="">

                                        <div class="det">
                                            <h3>Total Orders</h3>
                                    <h3>{{$totalOrders}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <h3>Ticket Info</h3>
                                    <div class="table-responsive">
                                        <table id="example001" class="table table-hover">
                                            <thead>
                                                <tr class="round">
                                                    <th>Ticket Name</th>
                                                    <th>Ticket Type</th>
                                                    <th>Price</th>
                                                    <th>Sold</th>
                                                    <th>Status</th>
                                                    <th>End Sales</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ( $tickets as $ticket)
                                                <tr>
                                                    <td>
                                                        <p> {{$ticket->name}} </p>
                                                    </td>
                                                    <td>
                                                        <p> {{$ticket->ticket_type}} </p>
                                                    </td>
                                                    <td>
                                                        <p> {{ $ticket->price!=null? '$'.$ticket->price : 'Free'}} </p>
                                                    </td>
                                                    <td>
                                                        <p> {{$ticket->ticketsPurchased}}/{{$ticket->available_quantity}} </p>
                                                    </td>
                                                    <td>
                                                        <p>{{$ticket->status ? "On Sale":"Sale off"}}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ Carbon\Carbon::parse($ticket->sale_end . ' ' . $ticket->sale_end_time)->toDayDateTimeString() }}</p>
                                                    </td>

                                                </tr>
                                                @endforeach
                                            </tbody>








                                        </table>
                                    </div>
                                </div>
                            </div>



                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <h3>Recent Orders</h3>
                                    <div class="table-responsive">
                                        <table id="example00" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Order ID</th>
                                                    <th>Event Name</th>
                                                    <th>User Name</th>
                                                    <th>User Email</th>
                                                    <th>Tickets</th>
                                                    <th>Ticket Type</th>
                                                    <th>Payment Status</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ( $eventOrders as $eventOrder)
                                                    <tr>
                                                        <td>{{$eventOrder->order_id}}</td>
                                                        <td>{{$eventOrder->event->title}}</td>
                                                        <td>{{$eventOrder->order['first_name']}} {{$eventOrder->order['last_name']}}</td>
                                                        <td>{{$eventOrder->order['email']}}</td>
                                                        <td><i class="fa-solid fa-ticket"></i> {{$eventOrder->no_of_tickets}}</td>
                                                        <td>{{$eventOrder->ticket_type}}</td>
                                                        <td>{{$eventOrder->order['payment_status'] == 1 ? 'Paid' : 'UnPaid' }}</td>
                                                        <td>${{number_format(($eventOrder->ticket_price - $eventOrder->ticket_fee), 2)}}</td>
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
