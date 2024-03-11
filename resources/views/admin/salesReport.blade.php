@extends('layouts.admin.app')
@section('content')
<section class="content">
    <div class="container-fluid" id="event1">
        <div class="row">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">

                    <div>
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <p><strong>Opps Something went wrong</strong></p>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if(session('success'))
                        <div class="alert alert-success">{{session('success')}}</div>
                        @endif

                        @if(session('error'))
                        <div class="alert alert-danger">{{session('error')}}</div>
                        @endif
                    </div>
                    <div class="box-header with-border">
                        <h3 class="box-title">Global Sales Report</h3>
                    </div>
                    <!-- /.box-header -->


                    <div class="box-body">
                        <div class="row" id="package">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Planners</label>
                                    <select class="form-control" id="planner">
                                        <option value="">Select Planner</option>
                                        @foreach($planners as $planner)

                                        <option value="{{$planner->user['id']}}">
                                            {{$planner->user['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <br>
                        <div class="row" id="chart100">

                            <div class="col-md-4">
                                <canvas id="myChart" width="400" height="400"></canvas>
                            </div>
                            <div class="col-md-4">
                                <div class="event-detail"
                                    style="border: 2px solid #2e6da4;padding: 13px;border-radius: 9px;">
                                    <h3>Orders</h3>
                                    <h3 id="totaleventOrders">{{$totaleventOrders}}</h3>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="event-detail"
                                    style="border: 2px solid #2e6da4;padding: 13px;border-radius: 9px;">
                                    <h3>Gross Sales</h3>
                                    <h3 id="totalRevenue">${{number_format($totalRevenue,2)}}</h3>
                                </div>
                            </div>

                            <div class="col-md-6 mt-5">
                                <div class="event-detail"
                                    style="border: 2px solid #2e6da4;padding: 13px;border-radius: 9px;">
                                    <h3>Actual Sales</h3>
                                    <h3 id="totaltickets">{{$totaltickets}} tickets</h3>
                                </div>
                            </div>
                            <div class="col-md-6 mt-5">
                                <div class="event-detail"
                                    style="border: 2px solid #2e6da4;padding: 13px;border-radius: 9px;">
                                    <h3>Target Sales</h3>
                                    <h3 id="ticketsandsales">{{$totaltickets+$targetSales}} tickets</h3>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="event-detail"
                                    style="border: 2px solid #2e6da4;padding: 13px;border-radius: 9px;">
                                    <h3>Revenue</h3>
                                    <h3 id="revenue">${{number_format($totalRevenue,2)}}</h3>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="event-detail"
                                    style="border: 2px solid #2e6da4;padding: 13px;border-radius: 9px;">
                                    <h3 style="display:initial;">Total Net Profit</h3>
                                    <p id="profit">Event Planner Profit (${{number_format($profit,2)}})</p>
                                    <h3 id="netsales">${{number_format($netSales,2)}}</h3>
                                </div>
                            </div>

                        </div>
                        <br><br>
                        <div class="row" id="chart100">
                            <div class="col-md-4">
                                <div class="event-detail"
                                    style="border: 2px solid #2e6da4;padding: 13px;border-radius: 9px;">
                                    <h3>Customers</h3>
                                    <h3 id="users">{{$users}}</h3>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="event-detail"
                                    style="border: 2px solid #2e6da4;padding: 13px;border-radius: 9px;">
                                    <h3>Events</h3>
                                    <h3 id="events">{{count($events)}}</h3>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="event-detail"
                                    style="border: 2px solid #2e6da4;padding: 13px;border-radius: 9px;">
                                    <h3>Tickets Sold</h3>
                                    <h3 id="sold">{{$totaltickets}}</h3>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <canvas id="eventschart" width="200" height="200"></canvas>
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
function get_data() {


}
const ctx = document.getElementById('myChart').getContext('2d');
var getvalues = get_data();

const myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: [
            'Paid',
            'Free',
            'Donation'
        ],
        datasets: [{
            label: 'Ticket Types',
            data: ["{{$paid}}", "{{$free}}", "{{$donation}}"],
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    }

});

var dat = [];
var lab = [];
@foreach($chart as $ct)
dat.push(
    "{!! $ct->count !!}");
lab.push("{!! $ct->monthyear !!}");
@endforeach
const chart = document.getElementById('eventschart').getContext('2d');
const page_views = new Chart(chart, {
    type: 'line',
    data: {
        labels: lab,
        datasets: [{
            label: 'Event Traffic',
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
var labels = [];
var no = [];

function find_data(data) {
    // document.getElementById('preloader').style.display = "block";
    if (data['id'] != '') {
        $.ajax({
            type: "GET",
            url: "{{route('ajax.admin.sales')}}",
            data: data,
            success: function(data) {
                // document.getElementById('preloader').style.display = "none";
                if (data.status == 1) {
                    document.getElementById('users').innerHTML = data.users;
                    document.getElementById('netsales').innerHTML = "$" + data.netSales.toFixed(2);
                    document.getElementById('totalRevenue').innerHTML = "$" + data.totalRevenue;
                    document.getElementById('revenue').innerHTML = "$" + data.totalRevenue;
                    document.getElementById('sold').innerHTML = data.totaltickets + " tickets";
                    document.getElementById('totaltickets').innerHTML = data.totaltickets + " tickets";
                    document.getElementById('totaleventOrders').innerHTML = data.totaleventOrders;
                    document.getElementById('ticketsandsales').innerHTML = parseInt(data.targetSales) +
                        parseInt(data.totaltickets) + " tickets";
                    document.getElementById('events').innerHTML = data.events;
                    document.getElementById('profit').innerHTML = "Event Planner Profit ($" + data.profit.toFixed(2) +
                        ")";
                    myChart.data.datasets[0].data = [data.paid, data.free, data.donation];
                    myChart.update();
                    labels = [];
                    no = [];
                    data.chart.forEach(myFunction)
                    page_views.data.labels = labels;
                    page_views.data.datasets[0].data = no;
                    page_views.update();
                } else {
                    alert("Something Went Wrong");
                }
            }
        });
    }
}

function myFunction(item) {
    labels.push(item.monthyear);
    no.push(item.count);
}

$('#planner').on('change', function() {
    $last = $(this).val();
    data['id'] = $last
    find_data(data)

});
</script>

@endsection