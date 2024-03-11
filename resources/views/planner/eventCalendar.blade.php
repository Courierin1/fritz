@extends('layouts.planner.app')

@section('css')
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">

@endsection

@section('content')



<section class="content">
    <div class="container-fluid" id="event-calender">

        <div class="row">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Calendar</h3>
                    </div>
                    <!-- /.box-header -->


                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-4">
                                <div class="input-group">
                                    <label>Search</label>
                                    <input type="text" name="q" class="form-control" id="search-data"
                                        placeholder="Search...">
                                    <span class="input-group-btn">
                                        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                                                class="fa fa-search" style="display:none;"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Event status</label>
                                    <select class="form-control" id="published">
                                        <option value="All">All</option>
                                        <option value="Published">Published</option>
                                        <option value="Draft">Draft</option>
                                        <option value="Past">Past</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Organizer</label>
                                    <select class="form-control" id="organize">
                                        <option value="">Select Organizer</option>
                                        @foreach($organizers as $organizer)
                                        <option value="{{$organizer->id}}">{{$organizer->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div id='calendar'></div>







                    </div>
                </div>

            </div>


        </div>


    </div>

    </div>
    </div>

</section>






@section('js')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js">
</script>

<script>
var calendar;
var events = [];


$(document).ready(function() {
    var calendarEl = $('#calendar');
    @foreach($events as $event)
    events.push({
        title: "{!! $event->title !!}" + "\n end: {{$event->event_end}}",
        start: "{!! $event->event_start !!}",

    });
    @endforeach


    calendar = $('#calendar').fullCalendar({
        header: {
            left: 'prev,next,today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        events: events
    });



});

function myFunction(item) {

    events.push({
        title: item.title + "\n end: " + item.event_end,
        start: item.event_start,

    });

}
var data = {};

function find_data(data) {
    // document.getElementById('preloader').style.display = "block";

    $.ajax({
        type: "GET",
        url: "{{route('get.ajaxevents')}}",
        data: data,
        success: function(data) {
            // document.getElementById('preloader').style.display = "none";
            console.log(data);
            if (data.status == 1) {
                $('#calendar').fullCalendar('removeEventSource', events)
                events = [];
                data.events.forEach(myFunction);
                $('#calendar').fullCalendar('addEventSource', events);
            } else {
                errortoast(data.message);
            }

        }
    });
}

$("#search-data").focusout(function() {
    find_data(data);
});



$('#search-data').keyup(function() {
    $report = this.value;
    if ($report.length > 3) {
        data['title'] = $report;
    }
});

$('#published').on('change', function() {
    $last = $(this).val();
    data['days'] = $last;
    find_data(data);

});
$('#organize').on('change', function() {
    $Event = $(this).val();
    data['list'] = $Event;
    find_data(data);

});
</script>

@endsection