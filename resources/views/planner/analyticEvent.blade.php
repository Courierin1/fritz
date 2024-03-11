@extends('layouts.planner.app')


@section('content')

<section class="content">
    <div class="container-fluid" id="analytic">
        <div class="row">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Analytics</h3>
                        <p>See where your sales are coming from, in real time</p>
                    </div>
                    <!-- /.box-header -->

                    <hr class="solid">
                    <div class="box-body">

                        <div class="row">

                            <div class="col-md-4">
                                <label for="eventname">Event Name</label>
                                <div class="form-group">

                                    <select class="form-control" id="event-list">
                                        <option value="">Select Event</option>
                                    @foreach($events as $event)
                                        <option value="{{$event->id}}">{{$event->title}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="eventname">Report Category</label>
                                <div class="form-group">

                                    <select class="form-control report-category" id="report-category">
                                        <option value="sales">Sales</option>
                                        <option value="attendees">Attendees</option>
                                        <option value="traffic">Traffic</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="eventname">Select</label>
                                <div class="form-group">

                                    <select class="form-control" id="last-days">

                                        <option value="30">Last 30 days</option>
                                        <option value="60">Last 60 days</option>
                                        <option value="90">Last 90 days</option>
                                        <!-- <option value="1">All time</option> -->
                                    </select>
                                </div>
                                <br>

                            </div>

                        </div>
                       
                        <button
                                    style=" background-color: #858bcc!important;border-radius: 4px!important;border: unset;"
                                    type="button" id="orga123" class="btn btn-primary"
                                    onclick="javascript:window.location.reload();">Clear</button>

                    </div>
                        <div class="row">
                            <div class="col-md-6">
                                <canvas id="analyticschart" width="200" height="200"></canvas>
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

    <script>
        $(document).ready(function() {
            $(".sales").show();
            $(".attendees").hide();
            $(".traffic").hide();
        });

        $(".report-category").click(function() {

            var select = document.getElementById('report-category');
            var value = select.options[select.selectedIndex].value;

            if (value == "sales") {
                $(".sales").show();
                $(".attendees").hide();
                $(".traffic").hide();

            } else if (value == "attendees") {
                $(".attendees").show();
                $(".sales").hide();
                $(".traffic").hide();
            } else {
                $(".traffic").show();
                $(".sales").hide();
                $(".attendees").hide();
            }
        });

    // {{-- Chart Js --}}
        const ctx = document.getElementById('analyticschart').getContext('2d');
        const sales = new Chart(ctx, {
            type: 'line',
            data: {
                
                labels: [],
                datasets: [{
                        label: 'Event Analytics',
                        data: [],
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
                    }
                ]
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
            // document.getElementById('preloader').style.display = "block";
            if(data['report']==null || data['days']==null || data['list']==null){
                // document.getElementById('preloader').style.display = "none";
                alert("Please Select All Values");
            }
            else{
               
                $.ajax({
                type:"GET",
                url:"{{route('ajax.analytics')}}",
                data: data,
                success: function(dat) {
                    // document.getElementById('preloader').style.display = "none";
                    if(dat.status==1){
                      no=[];
                      labels=[];  
                    dat.data.forEach(myFunction)
                    sales.data.labels = labels;
                    sales.data.datasets[0].data = no;  
                    sales.update(); }
                    else{
                        alert("Something Went Wrong");
                    }
}
                
            });
        }
            }
           function myFunction(item){
               labels.push(item.monthyear);
               no.push(item.count);
           }

        $('#report-category').on('change', function () {
            $report = $(this).val();
            data['report'] = $report
            
            find_data(data);

        });
        $('#last-days').on('change', function () {
            $last = $(this).val();
            data['days'] =  $last
            
            find_data(data);

        });
        $('#event-list').on('change', function () {
            $Event= $(this).val();
            data['list'] =  $Event
            $report = $('#report-category').val();
            data['report'] = $report
            $last = $('#last-days').val();
            data['days'] =  $last
            find_data(data);


        });
    </script>
@endsection
