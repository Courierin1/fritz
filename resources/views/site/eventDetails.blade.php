@extends('layouts.site.app')


@section('content')



<Section id="eventdetailspage">
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <h1>Event Details</h1>

            </div>




        </div>

    </div>
</Section>




<Section id="eventcontent">

    <div class="container">
        <div class="row mt-5 mb-5">

            <div class="col-md-12">
            @php 
                $img1 =  ($event->image != null) ? (explode('storage/', $event->image)[1]) : '';
            @endphp
            @if($event->image !=null && file_exists(public_path('storage/'.$img1)))
                <img src="{{ asset($event->image) }}" class="img-fluid event-img" alt="...">
            @else
                <img src="{{asset('assets/images/dummy.png')}}" class="img-fluid event-img" height="300" alt="">
            @endif

            </div>




        </div>


        <div class="row mt-5 mb-5">

            <div class="col-md-8">

                <div>

                    <p>{{ Carbon\Carbon::parse($event->event_start)->format('M, d, Y') }} </p>
                    <h2>{{ $event->title }}</h2>

                    <p>by <span style="color:#f068ed;font-weight:700;">{{ $event->organizer->name }}</span></p>

                    <a href="javascript:void(0);" data-auth_check="{{Auth::check()}}" data-organizer_id="{{ $event->organizer_id }}" id="following_btn" class="btn btn-primary" >
                    {{(Auth::check()) ? ((Auth::user()->organizerFollower->where('organizer_id', $event->organizer_id)->first() != null) ? 'Unfollow' : 'Follow') : 'Follow'}}
                    </a>
                </div>



                <div id="ent-top">


                    <h2>Tickets Available From</h2>
                    <p>Starting From:</p>
                    <p>
                        {{ Carbon\Carbon::parse($event->sale_start)->format('M, d, Y') }} - {{ Carbon\Carbon::parse($event->sale_start_time)->format('h:i A') }} 
                        <span style="color:#f068ed;font-weight:700;">To</span>
                        {{ Carbon\Carbon::parse($event->sale_end)->format('M, d, Y') }} - {{ Carbon\Carbon::parse($event->sale_end_time)->format('h:i A') }} 
                    </p>



                </div>



                <div id="ent-top">


                    <h2>Tickets Price</h2>
                    <p><b> {{($event->ticket_type == 'paid') ? 'Starts at $'.$event->price : 'Free'}}</b></p>
                    <!-- <button data-bs-toggle="modal" data-bs-target="#ticket" class="btn btn-primary">Ticket</button> -->
                    
                    @if(Auth::check() && Auth::id() == $event->event_planner_id)
                        <!-- show noting -->
                    @else
                    
                        <button 
                            type="button" 
                            class="btn btn-primary ticket_modal" 
                            data-target="#ticket" 
                            data-event_id="{{ $event->id }}"
                            @if($event->remaining_tickets == '0')
                                disabled>Tickets Out of Stock
                            @elseif (\Carbon\Carbon::parse($event->sale_end . ' ' . $event->sale_end_time) < \Carbon\Carbon::now())
                                disabled>Ticket Purchasing Time Passed
                            @elseif (\Carbon\Carbon::parse($event->sale_start . ' ' . $event->sale_start_time) > \Carbon\Carbon::now())
                                disabled>Ticket will be available soon
                            @else
                                >Get Ticket
                            @endif
                        </button>
                    @endif

                </div>



                <div id="ent-top">


                    <h2>Event Date and Time</h2>

                    <p>Starting From</p>
                    <p>
                        {{ Carbon\Carbon::parse($event->event_start)->format('M, d, Y') }} - {{ Carbon\Carbon::parse($event->start_time)->format('h:i A') }} 
                        <span style="color:#f068ed;font-weight:700;">To</span>
                        {{ Carbon\Carbon::parse($event->event_end)->format('M, d, Y') }} - {{ Carbon\Carbon::parse($event->end_time)->format('h:i A') }} 
                    </p>
                </div>


                <div id="ent-top">


                    <h2>Event Type</h2>

                    <p>{{$event->location_type}}</p>


                </div>


                <div id="ent-top">


                    <h2>Event Location Details</h2>
                    @if($event->location_type == 'venue')
                    <p>{{$event->zipcode}}, {{$event->address}}, {{$event->city}}, {{$event->state->name}}, {{$event->country->name}}</p>

                    @else
                        <a href="#">Event Link</a>
                    @endif


                </div>



                <div id="ent-top">


                    <h2>Event Summary</h2>

                    <p>{{$event->summary}}</p>

                </div>




                <div id="ent-top">


                    <h2>Event Detail</h2>

                    <p>{{ $event->details }}</p>
                </div>

            </div>

            <?php $suggestions=\App\Event::whereCategoryId($event->category_id)->get()->except($event->id); ?>

            @if(isset($suggestions))
            <div class="col-md-4">
                <h1>Interest Suggestions</h1>
        
                @foreach($suggestions as $suggest)
                <a href="{{ route('site.event.details', $suggest->id) }}"> <img src="{{ $suggest->image }}" alt=""></a>
                <h5>{{$suggest->title}}</h5>
                <h6>{{ Carbon\Carbon::parse($suggest->event_start)->format('M, d, Y') }} - {{ Carbon\Carbon::parse($suggest->start_time)->format('h:i A') }}</h6>
                <p>{!! $suggest->summary !!}</p>
                @endforeach


<!-- 
                <a href="{{route('site.events')}}"> <img src="{{ asset('assets/images/event2.png') }}" alt=""></a>
                <h5>Lorem ipsum dummy text</h5>
                <h6>Tue, Jun 28, 8:00 PM + 177 more events</h6>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt ut
                    labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus
                    commodo viverra
                    maecenas accumsan lacus vel facilisis. </p>
                <a href="">read more ></a>


                <a href="{{route('site.events')}}"> <img src="{{ asset('assets/images/event3.png') }}" alt=""></a>
                <h5>Lorem ipsum dummy text</h5>
                <h6>Tue, Jun 28, 8:00 PM + 177 more events</h6>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt ut
                    labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus
                    commodo viverra
                    maecenas accumsan lacus vel facilisis. </p>
                <a href="">read more ></a>


 -->




            </div>
            @endif



        </div>



    </div>

</Section>



<Section id="eventcontact">
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <h1 class="text-center">Frimix</h1>
                <p class="text-center">Ven pro Nosso Arraia will be in Boston for the first time.</p>

                <button style="background-color: black;" data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-default">Contact Us</button>

            </div>




        </div>

    </div>
</Section>


<div class="modal" id="myModal">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Contact The Organizer</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="contactOrganizer">
                <!-- Modal body -->
                <div class="modal-body">

                    <div class="row">


                        <div class="col-md-6">
                            <label for="">Your Name*</label>

                            <input type="text" placeholder="Name" id="name" name="name">
                            <input type="hidden" id="organizer_id" name="organizer_id" value="{{$event->organizer_id}}">

                        </div>
                        <div class="col-md-6">
                            <label for="">Email*</label>

                            <input style="border-bottom: 2px solid #999999;" type="text" placeholder="Email" id="email" name="email">

                        </div>
                        <div class="col-md-12 mt-4">
                            <label for="">Reason *</label>
                            <select class="form-select" aria-label="Default select example" id="reason" name="reason">
                                <option value="" selected disabled>Select Reason</option>
                                <option value="Question About Event">Question About Event</option>
                                <option value="Question About Ticket">Question About Ticket</option>
                                
                            </select>

                        </div>
                        <div class="col-md-12 mt-4">

                            <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                            <textarea class="form-control" rows="7"
                                placeholder="Message" name="query" id="query"></textarea>

                        </div>

                    </div>




                </div>

                <!-- Modal footer -->
                <div class="modal-footer">

                    <button type="button" class="btn btn-primary" id="new" data-bs-dismiss="modal">Close</button>


                    <button type="submit" class="btn btn-danger">Submit</button>





                </div>

            </form>

        </div>
    </div>
</div>








<!-- The Modal -->
<div class="modal" id="ticket">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Vem Pro Nosso Arraia</h4>

            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p class="text-center">Sat, Oct 8, 2022 12:00 AM <span> | </span> Remaining Tickets: 599</p>

                <div class="row">
                    <div class="col-md-6">
                        <h2>No of Tickets:</h2>
                    </div>
                    <div class="col-md-6">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>1</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>

                    </div>
                </div>

                <h1>$75.00</h1>
                <h3>Sales end on Sat, Oct 8, 2022 8:33 PM</h3>


            </div>

            <!-- Modal footer -->
            <div class="modal-footer">

                <button type="button" class="btn btn-primary" id="new" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Get Tickets</button>
            </div>

        </div>
    </div>
</div>


@endsection

@section('js')

<script>
    $(document).ready(function () {

        $('.ticket_modal').on('click', function () {
            <?php if( Auth::check() ){?>
                // $('#ticket').modal('show');
                let event_id = $(this).attr('data-event_id');
                $.ajax({
                method: "POST",
                url: "{{ route('add_to_cart') }}",

                data: {
                    "_token": "{{ csrf_token() }}",
                    'event_id': event_id,
                    'qty': 1,
                },
                success: function (response) {
                if (response.code == 200) {
                    successtoast(response.message);
                    // window.open("/user/invoice/"+response.id+"/print", '_blank');
                    // window.location.reload();
                    $(".cart_quantity").html(response.quantity);
                    // window.location.href = "URL::to('/cart') }}";
                } else {
                    errortoast(response.message);
                }
                },
                error: function (error) {
                    alert("something went wrong");
                    console.log(error);
                }
            });
            <?php   } else{ ?> 
                // alert('Please Login First');
                window.location.href = '{{route("login")}}';
            <?php } ?>
        });







        $(document).on('click', '#following_btn', function (e) {
            let auth_check = $(this).attr('data-auth_check');
            let organizer_id = $(this).attr('data-organizer_id');
            let this_val = this;

            if (auth_check == 1) {
                $.ajax({
                    type: 'post',
                    url: "{{ route('user.organizers.check_follow')}}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "organizer_id": organizer_id
                    },
                    success: function (data) {
                        // $("#follow-btn").load(window.location.href + " #follow-btn");
                        successtoast(data.message);

                        if (data.following == 1){
                            $(this_val).html('Unfollow');
                            // $(this_val).removeClass('btn-primary');
                            // $(this_val).addClass('btn-success');
                        } 
                        else if (data.following == 0){
                            $(this_val).html('Follow');
                            // $(this_val).removeClass('btn-success');
                            // $(this_val).addClass('btn-primary');
                        } 
                    },
                    error: function (error) {
                        errortoast("Something went wrong");
                    }
                });
            } else {
                errortoast('please login first')
            }
            


        });

    });

    $("#contactOrganizer").submit(function (e) {
        e.preventDefault();
    var name= document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var message = document.getElementById("query").value;
    var reason = document.getElementById("reason").value;
    if(name=="" || email=="" || message=="" || reason==""){
        errortoast("Please Fill All Fields");
    }
    else{
        $.ajax({
                    type: 'POST',
                    url: "{{ route('site.contact.organizer')}}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        name: name,
                        email:email,
                        message:message,
                        reason:reason,
                        organizer_id: document.getElementById("organizer_id").value,
                        
                    },
                    success: function (data) {
                        if (data.status == 1){
                            $('#myModal').modal('hide');
                        successtoast(data.message);
                        }
                        else{
                            errortoast("Something went wrong");
                        }
                     
                    },
                    error: function (error) {
                        errortoast("Something went wrong");
                    }
                });
    }
    });

</script>



@endsection