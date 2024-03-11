@extends('layouts.planner.app')


@section('content')


<section class="content">
    <div class="container-fluid" id="create-event">
        <div class="row">

            <div class="col-md-12" id="create_event_form">
                <!-- general form elements -->
                <div class="box box-primary">
                    @include('alerts')
                    <div class="box-header with-border">
                        <h3 class="box-title">Basic Info</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form id="c-event" role="form" method="POST" action="{{ route('user.create.event.post') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="row mb-3">
                            <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEventTitle">Event Title*</label>
                                <input type="text" class="form-control" id="exampleInputEventTitle" required
                                    name="title" value="{{ old('title') }}" placeholder="Be clear and descriptive.">
                            </div>
                            </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Organizer*</label>
                                        <select class="form-control" name="organizer_id" required id="organizer_id">
                                            <option value="" selected disabled hidden>Select Organizer</option>
                                            @foreach (Auth()->user()->getOrganizers as $organizer)
                                                <option value="{{ $organizer->id }}" {{ (old('organizer_id') == $organizer->id) ? 'selected' : '' }}>{{ $organizer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4" id="btn-style-radius">
                                    <a class="btn btn-default mt-4" href="{{ route('user.organizers.create') }}" id="orga123" role="button">Create Organizer</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Type*</label>
                                        <select class="form-control" name="type_id" required id="type_id">
                                            <option selected disabled>Select Type</option>
                                            @foreach ($types as $eventType)
                                            <option value="{{ $eventType->id }}" {{ ($eventType->id == old('type_id')) ? 'selected' : '' }}>{{ $eventType->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Category*</label>
                                        <select class="form-control" name="category_id" required id="category_id" onchange="populateSubCategory(this);">
                                            <option selected disabled>Select Category</option>
                                            @foreach ($categories as $eventCategory)
                                            <option value="{{ $eventCategory->id }}" {{ ($eventCategory->id == old('category_id')) ? 'selected' : '' }}>
                                                {{ htmlspecialchars_decode($eventCategory->name) }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Sub-category*</label>
                                        <select class="form-control" name="sub_category_id" required
                                            id="sub_category_id">
                                            <option selected disabled>Select Sub-category</option>
                                            {{-- @foreach ($eventSubCategories as $eventSubCategory)
                                            <option value="{{ $eventSubCategory->id }}">
                                                {{ $eventSubCategory->name }}
                                            </option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                            </div>
                            {{--
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Select Tags*</label>
                                    <div class="field_wrapper">
                                        @if( old('tags'))
                                            @for($i=0; $i < count(old('tags')); $i++)
                                                @if($i == 0)
                                                    <div>
                                                        <input type="text" name="tags[]" placeholder="Enter Tags" value="{{ old('tags')[$i] }}" required/>
                                                        <a href="javascript:void(0);" class="add_button" title="Add field">
                                                            <img src="{{asset('assets/images/avatar/add-icon.png')}}" />
                                                        </a>
                                                    </div>
                                                @else
                                                    <div>
                                                        <input type="text" name="tags[]" placeholder="Enter Tags" value="{{ old('tags')[$i] }}" required/>
                                                        <a href="javascript:void(0);" class="remove_button" title="Remove field">
                                                            <img src="{{asset('assets/images/avatar/remove-icon.png')}}" />
                                                        </a>
                                                    </div>
                                                @endif
                                            @endfor
                                        @else
                                            <div>
                                                <input type="text" name="tags[]" placeholder="Enter Tags" value="" required/>
                                                <a href="javascript:void(0);" class="add_button" title="Add field">
                                                    <img src="{{asset('assets/images/avatar/add-icon.png')}}" />
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr class="eds-divider__hr eds-bg-color--ui-200 eds-divider--horizontal"
                                data-spec="divider-hr" aria-hidden="true">
                            --}}


                            <h3 class="box-title">Location</h3>
                            <!-- <label>Location</label> -->
                            <p>Help people in the area discover your event and let attendees know where to show up.</p>
                            

                            <div class="nav-tabs-custom">

                                <ul class="nav nav-pills nav-tabs">
                                    <li style="border:unset;" class="nav-item get_location   " data-location="venue">
                                        <a href="#venue" data-toggle="tab" class="nav-link venue_or_online {{ (old('location_get') != null) ? ((old('location_get') == 'venue') ? 'active' : '') : 'active' }}" data-value="venue" aria-expanded="true">Venue</a>
                                        <input type="hidden" name="location_get" class="lclass" value="{{ old('location_get') ?? 'venue' }}">
                                    </li>
                                    <li style="border:unset;" class="nav-item get_location {{ (old('location_get') != null) ? ((old('location_get') == 'online-event') ? 'active' : '') : '' }} " data-location="online-event">
                                        <a href="#online-event" data-toggle="tab" class="nav-link venue_or_online" data-value="online-event" aria-expanded="false">Online event</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane  {{ (old('location_get') != null) ? ((old('location_get') == 'venue') ? 'active' : '') : 'active' }} " id="venue">
                                        <div class="input-group">
                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <label for="">Enter Address*</label>
                                                    <input type="text" name="address" value="{{ old('address') }}" class="form-control"
                                                        placeholder="Enter Address"  {{ (old('location_get') != null) ? ((old('location_get') == 'venue') ? 'required' : '') : 'required' }}>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane mt-3 {{ (old('location_get') != null) ? ((old('location_get') == 'online-event') ? 'active' : '') : '' }} " id="online-event">
                                        Online events have unique event pages where you can add links to livestreams and
                                        more
                                        <div class="input-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="">Enter Event Link*</label>
                                                    <input type="text" name="url" value="{{ old('url') }}" class="form-control"
                                                        placeholder="Enter Event Link" {{ (old('location_get') != null) ? ((old('location_get') == 'online-event') ? 'required' : '') : '' }}>
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
                                    <input type="text" name="venue_name" value="{{ old('venue_name') }}" placeholder="Enter Venue Name" class="form-control" required>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Select Country*</label>
                                    <select name="country" id="country" class="form-control" required>
                                       
                                        @foreach ($countries as $country)
                                        <option value="{{$country->id}}" {{ (old('country') == $country->name) ? 'selected' : '' }}>{{$country->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Select State*</label>
                                    <select name="state" id="state" class="form-control" required>
                                        <option selected disabled>Select State</option>
                                        @foreach ($states as $state )
                                        <option value="{{$state->id}}" {{ (old('state') == $state->name) ? 'selected' : '' }}>{{$state->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="">City*</label>
                                    <input type="text" name="city" value="{{ old('city') }}" placeholder="Enter city" class="form-control" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="">ZipCode*</label>
                                    <input type="number" name="zip" value="{{ old('zip') }}" placeholder="Zip Code" class="form-control" required>
                                </div>
                            </div>
                            <hr class="eds-divider__hr eds-bg-color--ui-200 eds-divider--horizontal"
                                data-spec="divider-hr" aria-hidden="true">
                            <h3 class="box-title">Date and time</h3>
                            <!-- <label>Date and time</label> -->
                            <p>Tell event-goers when your event starts and ends so they can make plans to attend.</p>
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-pills">
                                    <li style="background-color:unset;border:unset;" class="active get_event_type" data-event="single_event">
                                    {{-- <a href="#tab_single_event" data-toggle="tab" aria-expanded="true">Schedule Your Event</a> --}}
                                        <input type="hidden" name="event_type" class="eclass" value="single_event">
                                    </li>
                                    {{-- <li class="get_event_type" data-event="recurring_event"><a href="#tab_recurring_event"
                                            data-toggle="tab" aria-expanded="false">Recurring Event</a></li> --}}
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_single_event">
                                        <p>Single event happens once and can last multiple days</p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Event Starts*</label>
                                                    <div class="input-group date">
                                                        <input type="date" id="start_date"
                                                            class="form-control pull-right" required
                                                            onchange="updatedate();" name="event_start" value="{{ old('event_start') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="bootstrap-timepicker">
                                                    <div class="form-group">
                                                        <label>Start Time*</label>
                                                        <div class="input-group">
                                                            <input type="time" id="start_time" class="form-control"
                                                                required name="start_time" value="{{ old('start_time') }}">
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3 mb-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Event Ends*</label>
                                                    <div class="input-group date">

                                                        <input type="date" id="end_date" class="form-control pull-right"
                                                            required name="event_end" value="{{ old('event_end') }}">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="bootstrap-timepicker">
                                                    <div class="form-group">
                                                        <label>End Time*</label>
                                                        <div class="input-group">
                                                            <input type="time" id="end_time" class="form-control"
                                                                required name="end_time" value="{{ old('end_time') }}">

                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <input type="checkbox" id="start" name="display_start_time" checked
                                                value="1">
                                            <label for="start"> Display start time.</label><br>
                                            <p>The start time of your event will be displayed to attendees.</p>
                                        </div>
                                        <div class="form-group">

                                            <input type="checkbox" id="end" name="display_end_time" checked value="1">
                                            <label for="end"> Display end time.</label><br>
                                            <p>The end time of your event will be displayed to attendees.</p>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="tab_recurring_event">
                                        <p>You’ll be able to set a schedule for your recurring event in the next step.
                                            Event
                                            details and ticket types will apply to all instances.</p>
                                        <div class="form-group">
                                            <input type="checkbox" id="end" name="end" checked value="end">
                                            <label for="end"> Display end time.</label><br>
                                            <p>The end time of your event will be displayed to attendees.</p>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            {{--
                            <div class="form-group" data-select2-id="13">
                                <label>Time Zone*</label>
                                <select aria-labelledby="time-zone-label"
                                    class="form-control select2 select2-hidden-accessible" role="listbox"
                                    style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true"
                                    name="time_zone_id" id="time_zone_id" required>
                                    <option value="" selected disabled hidden>Time Zone</option>
                                    @foreach ($timeZones as $timeZone)
                                        <option value="{{ $timeZone->id }}" {{ (old('time_zone_id') == $timeZone->id) ? 'selected' : '' }}>{{ $timeZone->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            --}}


                        </div>

                </div>
                <div class="box-footer">
                    <button type="submit" class=" pull-right show_detail_btn" id="pop1"><i
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
                $('input[name="url"]').length ? $('input[name="url"]').val('') : '';

                $('input[name="address"]').length ? $('input[name="address"]').attr('required', 'required') : '';
                $('input[name="url"]').length ? $('input[name="url"]').removeAttr('required') : '';
            }
            else if(this_val == 'online-event') {
                $('input[name="address"]').length ? $('input[name="address"]').val('') : '';
                
                $('input[name="url"]').length ? $('input[name="url"]').attr('required', 'required') : '';
                $('input[name="address"]').length ? $('input[name="address"]').removeAttr('required') : '';
            }
        });

        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
           type:'GET',
           url:'{{route("check_organizer")}}',
        //    data:{name:name, password:password, email:email},
           success:function(data){
               if(data.message == 'success') {

               } else {
                    errortoast('Please Create Organizer First!');
                    
                    setTimeout(function(){ 
                        window.location.href = '{{route("user.organizers.create")}}'; 
                    }, 2000);
                   
               }
            //   alert(data.success);
           },
            error: (error) => {
                errortoast('something went wrong!');
            }
        });

    });

    $(function () {
        var dtToday = new Date();
        dtToday.setDate(dtToday.getDate() + 1)
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if (month < 10)
            month = '0' + month.toString();
        if (day < 10)
            day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;

        // or instead:
        // var maxDate = dtToday.toISOString().substr(0, 10);
        $('#start_date').attr('min', maxDate);
        $('#end_date').attr('min', maxDate);
    });

    function updatedate() {
        var firstdate = document.getElementById("start_date").value;
        document.getElementById("end_date").value = "";
        document.getElementById("end_date").setAttribute("min", firstdate);
    }

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

    $('#c-event').submit(function(e){
        if ($('input[name="event_start"]').val() == $('input[name="event_end"]').val()) {
            if ($('input[name="start_time"]').val() > $('input[name="end_time"]').val()) {
                e.preventDefault();
                errortoast('Event start time must be less than end time.');
            }
        }
    });
</script>
@endsection
