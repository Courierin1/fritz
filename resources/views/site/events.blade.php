@extends('layouts.site.app')


@section('content')

<section id="banner">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./assets/images/eventsban.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block" id="ven">
               
                    <div class="done">

                        <select id="e1" onchange="stateEvents(this)">

                            @foreach($states as $state)
                            <option value="{{$state->id}}" {{$state->id==6 ? 'selected' : ''}}>{{$state->name}}</option>
                            @endforeach
                        </select>

                    </div>
                 

                    <!-- <form class="Signup__form" id="newsletter">
                        <input required="" id="email" type="email" placeholder="Search Your Event">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </form> -->


                </div>


            </div>


        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>




</section>

<section id="upcoming-events">


    <div class="container">
        <div class="row">
            <div class="col-md-12" id="paste">




                <div class="container">
                    <div class="row">


                        <h1 class="mt-5 mb-5">Popular in California</h1>


                        @if(count($events)>0)
                        @foreach($events as $event)
                        <div class="col-md-3">
                            <div class="new123">
                                <a href="{{ route('site.event.details', $event->id) }}"> <img src="{{$event->image}}"
                                        alt=""></a>

                                <div class="img12345">
                                    @if(Auth::check() &&
                                    in_array($event->id,Auth()->user()->likes->pluck('event_id')->toArray()))
                                    <a href="javascript:like({{$event->id}})"><i
                                            class="fa-regular fa-heart bg-danger"></i></a>
                                    @else
                                    <a href="javascript:like({{$event->id}})"><i class="fa-regular fa-heart"></i></a>
                                    @endif
                                    <h5>{{$event->title}}</h5>
                                    <h6>{{ Carbon\Carbon::parse($event->event_start)->format('M, d, Y') }} -
                                        {{ Carbon\Carbon::parse($event->start_time)->format('h:i A') }}</h6>
                                    <p class="online">{{ucfirst($event->location_get)}} {{$event->zipcode}},
                                        {{$event->address}}, {{$event->city}}, {{$event->state->name}},
                                        {{$event->country->name}}</p>
                                    <p class="online" style="font-weight: bold">
                                        {{($event->ticket_type == 'paid') ? '$'.$event->price : 'Free'}} </p>
                                    <p><a
                                            href="{{route('user.profile',\Crypt::encryptString($event->organizer['id']))}}">{{$event->organizer['name']}}</a>
                                    </p>
                                    <p><i class="fa-solid fa-user"></i>{{$event->organizer->followers->count()}}
                                        followers</p>

                                </div>
                            </div>
                        </div>
                        @endforeach

                        @else
                        <div > No Events Found In <span style="color: #f068ed;">California</span>
                        </div>

                        @endif
                    </div>
                </div>


                @if(count($events)>10)
                <button class="more"> <a href="{{ route('site.search') }}">View More Events</a></button>
                @endif

            </div>

        </div>
    </div>






</section>



<section id="upcoming-events">


    <div class="container">
        <div class="row">
            <div class="col-md-12">




                <div class="container">
                    <div class="row">


                        <h1 class="mt-5 mb-5">Online Events</h1>

                        @if(count($online)>0)
                        @foreach($online as $on)
                        <div class="col-md-3">
                            <div class="new123">
                                <a href="{{ route('site.event.details', $on->id) }}"> <img src="{{$on->image}}"
                                        alt=""></a>

                                <div class="img12345">
                                    @if(Auth::check() &&
                                    in_array($on->id,Auth()->user()->likes->pluck('event_id')->toArray()))
                                    <a href="javascript:like({{$on->id}})"><i
                                            class="fa-regular fa-heart bg-danger"></i></a>
                                    @else
                                    <a href="javascript:like({{$on->id}})"><i class="fa-regular fa-heart"></i></a>
                                    @endif
                                    <h5>{{$on->title}}</h5>
                                    <h6>{{ Carbon\Carbon::parse($on->on_start)->format('M, d, Y') }} -
                                        {{ Carbon\Carbon::parse($on->start_time)->format('h:i A') }}</h6>
                                    <p class="online">{{ucfirst($on->location_get)}} {{$on->zipcode}}, {{$on->address}},
                                        {{$on->city}}, {{$on->state->name}}, {{$on->country->name}}</p>
                                    <p class="online" style="font-weight: bold">
                                        {{($on->ticket_type == 'paid') ? '$'.$on->price : 'Free'}} </p>
                                    <p><a
                                            href="{{route('user.profile',\Crypt::encryptString($on->organizer['id']))}}">{{$on->organizer['name']}}</a>
                                    </p>
                                    <p><i class="fa-solid fa-user"></i>{{$on->organizer->followers->count()}} followers
                                    </p>


                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class=""> There Are No <span style="color: #f068ed;">Online</span> Events</div>

                        @endif


                    </div>
                </div>


                @if(count($online)>10)
                <button class="more"> <a href="{{ route('site.search') }}">View More Events</a></button>
                @endif

            </div>

        </div>
    </div>






</section>






<section id="upcoming-events">


    <div class="container">
        <div class="row">
            <div class="col-md-12">




                <div class="container">
                    <div class="row">


                        <h1 class="mt-5 mb-5">Donation & Charity Events

                        </h1>


                        @if(count($donations)>0)
                        @foreach($donations as $donation)
                        <div class="col-md-3">
                            <div class="new123">
                                <a href="{{ route('site.event.details', $donation->id) }}"> <img
                                        src="{{$donation->image}}" alt=""></a>

                                <div class="img12345">
                                    @if(Auth::check() &&
                                    in_array($donation->id,Auth()->user()->likes->pluck('event_id')->toArray()))
                                    <a href="javascript:like({{$donation->id}})"><i
                                            class="fa-regular fa-heart bg-danger"></i></a>
                                    @else
                                    <a href="javascript:like({{$donation->id}})"><i class="fa-regular fa-heart"></i></a>
                                    @endif
                                    <h5>{{$donation->title}}</h5>
                                    <h6>{{ Carbon\Carbon::parse($donation->fre_start)->format('M, d, Y') }} -
                                        {{ Carbon\Carbon::parse($donation->start_time)->format('h:i A') }}</h6>
                                    <p class="online">{{ucfirst($donation->location_get)}} {{$donation->zipcode}},
                                        {{$donation->address}}, {{$donation->city}}, {{$donation->state->name}},
                                        {{$donation->country->name}}</p>
                                    <p class="online" style="font-weight: bold">
                                        {{($donation->ticket_type == 'paid') ? '$'.$donation->price : 'Free'}} </p>
                                    <p><a
                                            href="{{route('user.profile',\Crypt::encryptString($donation->organizer['id']))}}">{{$donation->organizer['name']}}</a>
                                    </p>
                                    <p><i class="fa-solid fa-user"></i>{{$donation->organizer->followers->count()}}
                                        followers</p>

                                </div>
                            </div>
                        </div>
                        @endforeach

                        @else
                        <div > There Are No <span style="color: #f068ed;">Donations & Charity</span>
                            Events</div>

                        @endif
                    </div>
                </div>


                @if(count($donations)>10)
                <button class="more"> <a href="{{ route('site.search') }}">View More Events</a></button>
                @endif


            </div>

        </div>
    </div>






</section>
















<div class="container" id="single">
    <div class="row">
        <div class="col-md-12 mt-5">

            <h1>Featured Organizers</h1>
            <p class="mb-5">Follow the organizers from these events and get notified when they create new ones.</p>

            <section class="regular1" id="mtypo">

                <div class="row">

                    @foreach($organizers as $organizer)
                    <div class="col-md-4">
                        <div class="opq">
                            <div class="new123" id="slipp">
                                <a href="{{route('user.profile',\Crypt::encryptString($organizer->id))}}"> <img
                                        style="margin: 0 auto;"
                                        src="{{ file_exists(asset('storage/organizer_images/'.auth()->id().'/'.$organizer->image)) ? asset('storage/organizer_images/'.auth()->id().'/'.$organizer->image) : './assets/images/mensicons.png' }}"
                                        alt=""></a>


                                <h5 class="lop">{{$organizer->name}}</h5>
                                <p class="num">{{$organizer->followers->count()}} followers</p>

                                <p class="text-center">
                                    <a href="javascript:void(0);" data-auth_check="{{Auth::check()}}"
                                        data-organizer_id="{{ $organizer->id }}" id="following_btn"
                                        class="btn btn-primary">
                                        {{(Auth::check()) ? ((Auth::user()->organizerFollower->where('organizer_id', $organizer->id)->first() != null) ? 'Unfollow' : 'Follow') : 'Follow'}}
                                    </a>
                                </p>
                            </div>
                        </div>


                    </div>

                    @endforeach
                </div>







            </section>
        </div>
    </div>

</div>




<section id="upcoming-events">


    <div class="container">
        <div class="row">
            <div class="col-md-12">




                <div class="container">
                    <div class="row">


                        <h1 class="mt-5 mb-5">Free events

                        </h1>



                        @if(count($free)>0)
                        @foreach($free as $fre)
                        <div class="col-md-3">
                            <div class="new123">
                                <a href="{{ route('site.event.details', $fre->id) }}"> <img src="{{$fre->image}}"
                                        alt=""></a>

                                <div class="img12345">
                                    @if(Auth::check() &&
                                    in_array($fre->id,Auth()->user()->likes->pluck('event_id')->toArray()))
                                    <a href="javascript:like({{$fre->id}})"><i
                                            class="fa-regular fa-heart bg-danger"></i></a>
                                    @else
                                    <a href="javascript:like({{$fre->id}})"><i class="fa-regular fa-heart"></i></a>
                                    @endif
                                    <h5>{{$fre->title}}</h5>
                                    <h6>{{ Carbon\Carbon::parse($fre->event_start)->format('M, d, Y') }} -
                                        {{ Carbon\Carbon::parse($fre->start_time)->format('h:i A') }}</h6>
                                    <p class="online">{{ucfirst($fre->location_get)}} {{$fre->zipcode}},
                                        {{$fre->address}}, {{$fre->city}}, {{$fre->state->name}},
                                        {{$fre->country->name}}</p>
                                    <p class="online" style="font-weight: bold">
                                        {{($fre->ticket_type == 'paid') ? '$'.$fre->price : 'Free'}} </p>
                                    <p><a
                                            href="{{route('user.profile',\Crypt::encryptString($fre->organizer['id']))}}">{{$fre->organizer['name']}}</a>
                                    </p>
                                    <p><i class="fa-solid fa-user"></i>{{$fre->organizer->followers->count()}} followers
                                    </p>

                                </div>
                            </div>
                        </div>
                        @endforeach

                        @else
                        <div class="mb-5"> There Are No <span style="color: #f068ed;">Free</span> Events</div>

                        @endif
                    </div>
                </div>


                @if(count($free)>10)
                <button class="more"> <a href="{{ route('site.search') }}">View More Events</a></button>
                @endif


            </div>

        </div>
    </div>






</section>




@endsection
@section('js')
<script>
function stateEvents(item) {
    $.ajax({
        url: "{{ route('state.events') }}",
        method: "GET",
        data: {
            id: item.value,


        },
        success: function(data) {
            if (data.status == 1) {
                $("#paste").html(data.view);



            }

        },
        error: function(error) {
            errortoast('Something Went Wrong!');

        }
    });
}
</script>
<script>
$(document).ready(function() {
    $(document).on('click', '#following_btn', function(e) {
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
                success: function(data) {
                    // $("#follow-btn").load(window.location.href + " #follow-btn");
                    successtoast(data.message);

                    if (data.following == 1) {
                        $(this_val).html('Unfollow');
                        // $(this_val).removeClass('btn-primary');
                        // $(this_val).addClass('btn-success');
                    } else if (data.following == 0) {
                        $(this_val).html('Follow');
                        // $(this_val).removeClass('btn-success');
                        // $(this_val).addClass('btn-primary');
                    }
                },
                error: function(error) {
                    errortoast("Something went wrong");
                }
            });
        } else {
            errortoast('please login first')
        }



    });

});
</script>
@endsection