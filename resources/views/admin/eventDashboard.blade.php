@extends('layouts.admin.app')
@section('content')


    <section class="content">
        <div class="container-fluid" id="evt-desh">
            <div class="row">

                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">

                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="box-title">Event Dashboard</h3>

                            </div>
                            <!-- <div class="col-md-6" id="sear12">
                                <div class="input-group">
                                    <input type="text" name="q" class="form-control" id="find_attendees" placeholder="Find Attendees">
                                    <span class="input-group-btn">
                                        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                                                class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>

                            </div> -->
                        </div>
                        <!-- /.box-header -->


                        <div class="box-body">
                            <hr class="solid">
                            <div class="row">
                            <div class="col-md-4">
                                <canvas id="eventTickets" width="400" height="400"></canvas>

                            </div>
                            </div>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-md-4" id="gross-1">

                                    <div class="event-detail">
                                        <h3>Net sales</h3>
                                        <p>Event Planner Profit (${{$net_profit}})</p>
                                        <h3>${{number_format($netSales,2)}}</h3>
                                    </div>

                                </div>

                                <div class="col-md-4 cent" id="gross-1">
                                    <div class="event-detail">
                                        <h4>{{$ticketsPurchased ?? 0}} Tickets Sold / {{$event->available_quantity ?? 0}}</h4>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: {{$percentage}}%"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-4" id="gross-1">

                                    <div class="event-detail">
                                        <h3>Gross sales</h3>
                                        <h3>${{$totalRevenue}}</h3>
                                    </div>

                                </div>

                                <div class="col-md-4" id="gross-1">
                                    <div class="event-detail">
                                        <article>
                                            <p>You're collecting payments with:</p>
                                            <h4>
                                            Frimix Payment Processing <p style="font-size:15px;color:#ff5f0c;">(paypal)</p>


                                                <a id="edit_payment_processor" class="js-tracked link-aside" href="#"
                                                    data-label="edit"></a>
                                            </h4>


                                            <!-- <div id="payment_method_logos" class="clrfix">
                                                <img src="{{ asset('assets\images\eventImages\R.png') }}" height="52"
                                                    width="122">

                                            </div> -->

                                        </article>
                                    </div>
                                </div>

                                <div class="col-md-4" id="gross-1">

                                    <div class="event-detail">
                                        <h3>Net Profit</h3>
                                        <h3>${{$net_profit}}</h3>
                                    </div>

                                </div>

                            </div>


                            <br>

                            <hr class="solid">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Ticket Info</h3>
                                    <div class="table-responsive">
                                    <table id="example" class="table table-hover">

                                    <thead>
                                        <tr>
                                            <th style="text-align: center">Ticket Name</th>
                                            <th style="text-align: center">Ticket Type</th>
                                            <th style="text-align: center">Price</th>
                                            <th style="text-align: center">Sold</th>
                                            <th style="text-align: center">Status</th>
                                            <th style="text-align: center">End Sales</th>
                                        </tr>
                                        </thead>

                                        <tbody>


                                        <tr>
                                            <td style="text-align: center">
                                                <p> {{$event->name}} </p>
                                            </td>
                                            <td style="text-align: center">
                                                <p> {{$event->ticket_type}} </p>
                                            </td>
                                            <td style="text-align: center">
                                                <p> ${{$event->price}} </p>
                                            </td>
                                            <td style="text-align: center">
                                                <p> {{$ticketsPurchased}}/{{$event->available_quantity}} </p>
                                            </td>
                                            <td style="text-align: center">
                                                <p>{{$event->status ? "On Sale":"Sale off"}}</p>
                                            </td>
                                            <td style="text-align: center">
                                                <p>{{ Carbon\Carbon::parse($event->sale_end_date_time)->toDayDateTimeString() }}</p>
                                            </td>

                                        </tr>
                                        </tbody>

                                    </table>
                                </div>
                                </div>
                            </div>
                          

                            <hr class="solid">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Recent Orders</h3>
                                    <div class="orders">
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table id="example"  class="table table-hover">
                                              <thead>
                                                        <tr>
                                                            <th style="text-align: center">Order ID</th>
                                                            <th style="text-align: center">Event Name</th>
                                                            <th style="text-align: center">User Name</th>
                                                            <th style="text-align: center">User Email</th>
                                                            <th style="text-align: center">Tickets</th>
                                                            <th style="text-align: center">Ticket Type</th>
                                                            <th style="text-align: center">Payment Status</th>
                                                            <th style="text-align: center">Subtotal</th>
                                                            <th style="text-align: center">Profit</th>
                                                            <th style="text-align: center">Total</th>
                                                        </tr>

                                                        </thead>
                                                        <tbody>
                                                        @if (count($eventOrders)==0)
                                                        <td colspan="7"><center>No orders found!</center></td>
                                                        @else
                                                        @foreach ( $eventOrders as $eventOrder)
                                                        <tr>
                                                            <td style="text-align: center">{{$eventOrder->order_id}}</td>
                                                            <td style="text-align: center">{{$eventOrder->event->title}}</td>
                                                            <td style="text-align: center">{{$eventOrder->order['first_name']}} {{$eventOrder->order['last_name']}}</td>
                                                            <td style="text-align: center">{{$eventOrder->order['email']}}</td>
                                                            <td style="text-align: center"><i class="fa-solid fa-ticket"></i> {{$eventOrder->no_of_tickets}}</td>
                                                            <td style="text-align: center">{{$eventOrder->event->ticket_type}}</td>
                                                            <td style="text-align: center">{{$eventOrder->order['payment_status']==1 ? 'Paid' : 'UnPaid'}}</td>
                                                            <td style="text-align: center">${{number_format(($eventOrder->ticket_price - $eventOrder->ticket_fee), 2)}}</td>
                                                            <td style="text-align: center">${{number_format($eventOrder->ticket_fee, 2)}}</td>
                                                            <td style="text-align: center">${{number_format(($eventOrder->ticket_price), 2)}}</td>
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

                        <hr class="solid">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Your Links</h3>
                                <label for="">Your Organizer URL: <a target="_blank" href="{{route('admin.view.organizer', $event->organizer_id)}}">Ogranizer</a>
                                </label>
                                {{-- [<a role="button" data-toggle="collapse" href="#changeorganizerurl" aria-expanded="false" aria-controls="changeorganizerurl">change</a> ] --}}
                                <div class="collapse" id="changeorganizerurl">
                                    <div class="well">
                                        <p>Create your own Personalized Organizer URL for abc</p>
                                        <div class="btn-group">
                                            http://<input name="orgshortname" id="orgshortname" maxlength="50" type="text"
                                                style="width: 200px;" value="None">.frimix.com

                                        </div>
                                        <button type="button" class="btn btn-warning">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="solid">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Your Event URL</h3>
                             
                               <input type="text" class="form-control" style="position: absolute;" id="event-url"
                                    value="{{route('site.event-detail', $event->id)}}" readonly>
                                <i class="fa-solid fa-copy copied" style="position: relative;float: right;top: 8px;"></i>
                            </div>

                        </div>
                       

                    </div>
                </div>

            </div>

        </div>


    </section>



@endsection

@section('js')


    {{-- Chart Js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>

    {{-- Chart Js --}}
    <script>
        var dat=[];
        var lab=[];
        @foreach($chart as $ct)
            dat.push({!! $ct->count !!});
            lab.push("{!! $ct->monthyear !!}");
            @endforeach
        const ctx = document.getElementById('eventTickets').getContext('2d');
        const eventTickets = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: lab,
                datasets: [{
                    label: '# of Tickets',
                    data: dat,
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script>
        $(".copied").click(function() {
            /* Get the text field */
            var copyText = document.getElementById("event-url");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            navigator.clipboard.writeText(copyText.value);

        });
        var data = {};

        function find_data(data) {
            console.log(data)
            $.ajax({
                type:"GET",
                url:"",
                data: data,
                success: function(data) {
                    console.log(data);
                }
            });
        }




        // $('#find_attendees').keyup(function() {
        //     $report = this. value;
        //     if($report.length > 3)
        //     {
        //         data['report-category'] = $report
        //         console.log(data)
        //     }
        // });
    </script>

@endsection
