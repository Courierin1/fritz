@extends('layouts.admin.app')
@section('title', 'Event Sales Report')
@section('content')

<section class="content">
    <div class="container-fluid" id="sales-report">
        <div class="row">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sales Report</h3>
                    </div>
                    <!-- /.box-header -->


                    <div class="box-body">
                        <input type="hidden" name="event_planner_id" value="{{$id}}">
                        <div class="row">
                            <div class="col-md-6">
                                    <label for="eventname">Event Name</label>
                                    <div class="form-group">

                                        <select class="form-control" id="event_name">>
                                        <option value="">Select Event</option>
                                            @foreach($events as $event)

                                            <option value="{{$event->id}}" >{{$event->title}}</option>

                                            @endforeach
                                        </select>
                                    </div>
                            </div>
                            <!--<div class="col-md-6">
                                <div class="csv-export">
                                    <button class="btn btn-danger pull-right">Export</button>
                                </div>
                            </div>-->
                        </div>

                        <div class="row">

                            <div class="col-md-6" id="start101">
                                <div class="form-group">
                                    <label>Ticket Type</label>
                                    <select class="form-control" id="ticket_type">
                                        <option>Select Ticket Type</option>
                                        <option value="Paid">Paid</option>
                                        <option value="Free">Free</option>
                                        <option value="Donation">Donation</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <div class="input-group date">

                                        <input type="date" id="start_date" class="form-control pull-right"
                                            name="event_start">
                                    </div>


                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <div class="input-group date">

                                        <input type="date" id="end_date" class="form-control pull-right"
                                            name="event_end">
                                    </div>

                                </div>
                            </div>

                        </div>


                        <div class="row mt-5" id="paste">
                            <div class="col-md-3">

                                <div class="event-detail"
                                    style="border: 2px solid #2e6da4;margin-inline-end: 264px;padding: 13px;border-radius: 9px;">
                                    <h3>Gross Sales</h3>
                                    <h3>${{$totalRevenue}}</h3>
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="event-detail"
                                    style="border: 2px solid #2e6da4;margin-inline-end: 264px;padding: 13px;border-radius: 9px;">
                                    <h3>Net Sales</h3>
                                    <p>Event Planner Profit (${{$profit}})</p>
                                    <h3>${{$netSales}}</h3>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="event-detail"
                                    style="border: 2px solid #2e6da4;margin-inline-end: 264px;padding: 13px;border-radius: 9px;">
                                    <h3>Tickets Sold</h3>
                                    <h3>{{$totaltickers}}</h3>
                                </div>

                            </div>

                            <div class="col-md-3">
                                <div class="event-detail"
                                    style="border: 2px solid #2e6da4;margin-inline-end: 264px;padding: 13px;border-radius: 9px;">
                                    <h3>Orders</h3>
                                    <h3>{{$totaleventOrders}}</h3>
                                </div>
                            </div>
                        </div>

                        <hr class="solid">
                        <div class="row">
                            <div class="col-md-6">
                                <canvas id="eventTickets" width="400" height="400"></canvas>
                            </div>
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
       
            dat.push("{!! $ct['count'] !!}");
            lab.push("{!! $ct['monthyear'] !!}");
            @endforeach
            console.log(lab);
        const ctx = document.getElementById('eventTickets').getContext('2d');
        const eventTickets = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: lab,
                datasets: [{
                    label: '# of Tickets Sold',
                    data: dat,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
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
        var data = {};
        var labels= [];
        var no= [];

        function find_data(data) {
                
                $.ajax({
                type:"GET",
                url:"{{route('admin.ajax.sales')}}",
                data: data,
                success: function(data) {
                  if(data.status==1){
                    document.getElementById('paste').innerHTML=data.view;
                    labels=[];
                    no=[];

                    data.tickets.forEach(myFunction)
                    eventTickets.data.labels = labels;
                    eventTickets.data.datasets[0].data = no;
                    eventTickets.update(); 
                  }
                  else {
                      alert('something went wrong');
                  }
                }
            });
            }

            function myFunction(item){
               labels.push(item.monthyear);
               no.push(item.count);
           }

        $('#event_name').on('change', function () {
            $value = $(this).val();
            data['name'] = $value;
            data['event_planner_id'] = $('input[name="event_planner_id"]').val();
            find_data(data);

        });
        $('#ticket_type').on('change', function () {
            $get = $(this).val();
            data['type'] =  $get;
            data['event_planner_id'] = $('input[name="event_planner_id"]').val();
            find_data(data);
        });
        $('#start_date').on('change', function () {
            $date = $(this).val();
            data['start'] =  $date;
            data['event_planner_id'] = $('input[name="event_planner_id"]').val();
            console.log(data);

        });
        $('#end_date').on('change', function () {
            $e_date = $(this).val();
            data['end'] =  $e_date;
            data['event_planner_id'] = $('input[name="event_planner_id"]').val();
            find_data(data);

        });
    </script>
@endsection