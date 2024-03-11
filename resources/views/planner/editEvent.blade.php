@extends('layouts.planner.app')


@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    @include('alerts')
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Event Info</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form id="c-event" role="form" action="{{route('user.edit.event.post')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEventTitle">Event Title*</label>
                                <input type="text" class="form-control" id="exampleInputEventTitle" required
                                    name="title" placeholder="Be clear and descriptive." value="{{old('title') ?? $event->title}}">
                            </div>
                            <div class="form-group mt-3">
                                <label>Organizer*</label>
                                <select class="form-control" name="organizer_id" id="organizer_id" required>
                                    <option value="" disabled>Select Organizer</option>
                                    @foreach (Auth()->user()->getOrganizers as $organizer)
                                    <option value="{{ $organizer->id }}" {{ ($organizer->id == ( old('organizer_id') ?? $event->organizer_id)) ? 'selected' : '' }}>{{ $organizer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Type*</label>
                                        <select class="form-control" name="type_id" id="type_id" required>
                                            <option value="" disabled>Select Type</option>
                                            @foreach ($types as $eventType)
                                            <option value="{{ $eventType->id }}" {{ ($eventType->id == ( old('type_id') ?? $event->type_id)) ? 'selected' : '' }}>{{ $eventType->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Category*</label>
                                        <select class="form-control" name="category_id" id="category_id" required>
                                            <option value="" disabled>Select Category</option>
                                            @foreach ($categories as $eventCategory)
                                            <option value="{{ $eventCategory->id }}" {{ ($eventCategory->id == ( old('category_id') ?? $event->category_id)) ? 'selected' : '' }}>{{ $eventCategory->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Sub-category*</label>
                                        <select class="form-control" name="sub_category_id" id="sub_category_id" required>
                                            <option value="" disabled>Select Sub-category</option>
                                            @foreach ($sub_categories as $eventSubCategory)
                                            <option value="{{ $eventSubCategory->id }}" {{ ($eventSubCategory->id == ( old('sub_category_id') ?? $event->sub_category_id)) ? 'selected' : '' }}>
                                                {{ $eventSubCategory->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <h3 class="box-title">Location</h3>
                            <p>Help people in the area discover your event and let attendees know where to show up.</p>
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-pills">
                                    <li style="border: unset;" class="get_location nav-item" data-location="venue">
                                        <a href="#venue" class="venue_or_online nav-link  {{ ((old('location_get') ?? $event->location_type) == 'venue') ? 'active' : '' }}" data-value="venue"
                                            data-toggle="tab" aria-expanded="true">Venue</a>
                                        <input type="hidden" name="location_get" class="lclass"
                                            value="{{ old('location_get') ?? $event->location_type}}">
                                    </li>
                                    <li style="border: unset;" class="get_location nav-item" data-location="online-event">
                                        <a href="#online-event" class="venue_or_online nav-link  {{ ((old('location_get') ?? $event->location_type) == 'online-event') ? 'active' : '' }}" data-value="online-event" 
                                            data-toggle="tab" aria-expanded="false">Online event</a></li>

                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane  {{ ((old('location_get') ?? $event->location_type) == 'venue') ? 'active' : '' }}" id="venue">
                                        <div class="input-group">
                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <label for="">Enter Address*</label>
                                                    <input type="text" name="address" class="form-control"
                                                        placeholder="Enter Address" value="{{old('address') ?? $event->address}}" {{ ((old('location_get') ?? $event->location_type) == 'venue') ? 'required' : '' }}>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane mt-3  {{ ((old('location_get') ?? $event->location_type) == 'online-event') ? 'active' : '' }}" id="online-event">
                                        Online events have unique event pages where you can add links to livestreams and
                                        more
                                        <div class="input-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="">Enter Event Link*</label>
                                                    <input type="text" name="url" class="form-control"
                                                        placeholder="Enter Event Link" value="{{old('url') ?? $event->url}}"  {{ ((old('location_get') ?? $event->location_type) == 'online-event') ? 'required' : '' }}>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Venue Name*</label>
                                    <input type="text" name="venue_name" value="{{ old('venue_name') ?? $event->venue_name }}" placeholder="Enter Venue Name" class="form-control" required>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Select Country*</label>
                                    <select name="country" id="country" class="form-control" required>
                                        <option value="" disabled>Select Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{$country->id}}" {{ ($country->name == ( old('country') ?? $event->country)) ? 'selected' : '' }}>{{$country->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Select State*</label>
                                    <select name="state" id="state" class="form-control" required>
                                        <option value="" disabled>Select State</option>
                                        @foreach ($states as $state )
                                        <option value="{{$state->id}}" {{ ($state->name == ( old('state') ?? $event->state)) ? 'selected' : '' }}>{{$state->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="">City*</label>
                                    <input type="text" name="city" value="{{ old('city') ?? $event->city}}" placeholder="Enter city" class="form-control" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Zip*</label>
                                    <input type="text" name="zip" placeholder="Zip Code"
                                        class="form-control" value="{{ old('zip') ?? $event->zipcode}}" required>
                                </div>
                            </div>

                            <hr class="eds-divider__hr eds-bg-color--ui-200 eds-divider--horizontal" data-spec="divider-hr" aria-hidden="true">
                            <h3 class="box-title">Date and time</h3>
                            <p>Tell event-goers when your event starts and ends so they can make plans to attend.</p>
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-pills">
                                    <li style="background:unset;border: unset;" class="active get_event_type" data-event="single_event">
                                        {{-- <a href="#tab_single_event" data-toggle="tab" aria-expanded="true">Schedule Your Event</a> --}}
                                        <input type="hidden" name="event_type" class="eclass"
                                            value="{{($event)?$event->event_type:null}}">
                                    </li>

                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_single_event">
                                        <p>Single event happens once and can last multiple days</p>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Event Starts*</label>
                                                    <div class="input-group date">

                                                        <input type="date" id="start_date"
                                                            class="form-control pull-right" name="event_start"
                                                            value="{{($event) ? $event->event_start:''}}"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="bootstrap-timepicker">
                                                    <div class="form-group">
                                                        <label>Start Time*</label>
                                                        <div class="input-group">
                                                            <input type="time" id="start_time" class="form-control"
                                                                name="start_time"
                                                                value="{{($event) ? $event->start_time:''}}"
                                                                required>

                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Event Ends*</label>
                                                    <div class="input-group date">

                                                        <input type="date" id="end_date" class="form-control pull-right"
                                                            name="event_end"
                                                            value="{{($event) ? $event->event_end:''}}"
                                                            required>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-6 hello123">
                                                <div class="bootstrap-timepicker">
                                                    <div class="form-group">
                                                        <label>End Time*</label>
                                                        <div class="input-group">
                                                            <input type="time" id="end_time" class="form-control"
                                                                name="end_time"
                                                                value="{{($event) ? $event->end_time:''}}"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <input type="checkbox" id="start" name="display_start_time" checked
                                                value="">
                                            <label for="start"> Display start time.</label><br>
                                            <p>The start time of your event will be displayed to attendees.</p>
                                        </div>
                                        <div class="form-group">

                                            <input type="checkbox" id="end" name="display_end_time" checked value="">
                                            <label for="end"> Display end time.</label><br>
                                            <p>The end time of your event will be displayed to attendees.</p>
                                        </div>





                                    </div>

                                    <div class="tab-pane" id="tab_recurring_event">
                                        <p>You’ll be able to set a schedule for your recurring event in the next step.
                                            Event
                                            details and ticket types will apply to all instances.</p>
                                        <div class="form-group">
                                            <input type="checkbox" id="end" name="display_end_time" checked value="">
                                            <label for="end"> Display end time.</label><br>
                                            <p>The end time of your event will be displayed to attendees.</p>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            {{--
                            <div class="form-group" data-select2-id="13">
                                <label>Time Zone*</label>
                                <select aria-labelledby="time-zone-label" id="time_zone_id"
                                    class="form-control select2 select2-hidden-accessible" role="listbox"
                                    style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true"
                                    name="time_zone_id" required>
                                    <option disabled>Select Time Zone</option>
                                    @foreach ($timeZones as $timeZone)
                                        <option value="{{ $timeZone->id }}" {{ ($timeZone->id == $event->time_zone_id) ? 'selected' : '' }}>{{ $timeZone->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            --}}

                        </div>

                        <input type="hidden" name="event_id" value="{{$event->id}}">
                </div>
                <div class="box-footer">
                    <button style="margin-top:3%;" type="submit" class="mt-5 pull-right" id="pop1"><i
                            class="fa-solid fa-arrow-right"></i></button>
                </div>


                </form>
            </div>

        </div>
    </div>

</section>






























@endsection
@section('js')


<script>
    $('#c-event').submit(function(e){
        if ($('input[name="event_start"]').val() == $('input[name="event_end"]').val()) {
            if ($('input[name="start_time"]').val() > $('input[name="end_time"]').val()) {
                e.preventDefault();
                errortoast('Event start time must be less than end time.');
            }
        }
    });

    $(document).ready(function () {
        var val = "venue";
        $('.get_location').on('click', function () {
            var val = $(this).attr('data-location');
            $('.lclass').val(val);
        });
        var val1 = "single_event";
        $('.get_event_type').on('click', function () {
            var val1 = $(this).attr('data-event');
            $('.eclass').val(val1);
        });

        $('.show_detail_btn').on('click', function () {
            $(".detail_show").removeAttr("disabled");
        });
        
        $(document).on('click', '.venue_or_online' , function(e) {
            let this_val = $(this).data('value').length ? $(this).data('value') : '';
            if (this_val == 'venue') {
                $('input[name="event_link"]').length ? $('input[name="event_link"]').val('') : '';

                $('input[name="address"]').length ? $('input[name="address"]').attr('required', 'required') : '';
                $('input[name="event_link"]').length ? $('input[name="event_link"]').removeAttr('required') : '';
            }
            else if(this_val == 'online-event') {
                $('input[name="address"]').length ? $('input[name="address"]').val('') : '';
                
                $('input[name="event_link"]').length ? $('input[name="event_link"]').attr('required', 'required') : '';
                $('input[name="address"]').length ? $('input[name="address"]').removeAttr('required') : '';
            }
        });
    });

</script>

<script>
    $("#time_zone_id option").each(function () {
        $(this).siblings('[value="' + this.value + '"]').remove();
    });
    $("#organizer_id option").each(function () {
        $(this).siblings('[value="' + this.value + '"]').remove();
    });
    $("#type_id option").each(function () {
        $(this).siblings('[value="' + this.value + '"]').remove();
    });
    $("#category_id option").each(function () {
        $(this).siblings('[value="' + this.value + '"]').remove();
    });
    $("#sub_category_id option").each(function () {
        $(this).siblings('[value="' + this.value + '"]').remove();
    });

</script>

<script type="text/javascript">
    $(document).ready(function () {
        var maxField = 5; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML =
            '<div><input type="text" name="tags[]" value="" required/>&nbsp;<a href="javascript:void(0);" class="remove_button"><img src="{{asset("assets/images/avatar/remove-icon.png")}}"/></a></div>'; //New input field html
        var x = 1; //Initial field counter is 1

        //Once add button is clicked
        $(addButton).click(function () {
            //Check maximum number of input fields
            if (x < maxField) {
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function (e) {
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });

</script>

<script>
    // $(function () {
    //     var dtToday = new Date();
    //     var month = dtToday.getMonth() + 1;
    //     var day = dtToday.getDate();
    //     var year = dtToday.getFullYear();
    //     if (month < 10)
    //         month = '0' + month.toString();
    //     if (day < 10)
    //         day = '0' + day.toString();

    //     var maxDate = year + '-' + month + '-' + day;

    //     // or instead:
    //     // var maxDate = dtToday.toISOString().substr(0, 10);
    //     $('#start_date').attr('min', maxDate);
    //     $('#end_date').attr('min', maxDate);
    // });

    // function updatedate() {
    //     var firstdate = document.getElementById("start_date").value;
    //     document.getElementById("end_date").value = "";
    //     document.getElementById("end_date").setAttribute("min", firstdate);
    // }

</script>





















<script>
    function populateSubCategory(item){

    
 $.ajax({
            url: "{{ route('get.subcategories') }}",
            method: "GET",
            data: {
                id: item.value,
              

            },
            success: function (data) {
                if (data.status == 1) {
                $("#sub_category_id").removeAttr('disabled');
                $('#sub_category_id').empty()
                  var options=$("#sub_category_id");
                            $.each(data.res, function() {
                options.append(new Option(this.name, this.id));
            });
                   
                } 
                else if (data.status == 2) {
                    errortoast(data.message);
                    
                }
                else {
                    errortoast('something went wrong');
                }
            },
            error: function (error) {
                errortoast('something went wrong');

            }
        });
    }

    function openState(){
        $("#state").removeAttr('disabled');
    }
</script>
@endsection
