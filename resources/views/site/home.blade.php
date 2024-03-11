@extends('layouts.site.app')

@section('css')
    <style>
        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid blue;
            border-right: 16px solid green;
            border-bottom: 16px solid red;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
            text-align: center;
            margin: 0 auto;
            display: none;
        }

        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 767px) {

            #merge {
                width: 100% !important;
            }

        }
    </style>
@endsection
@section('content')
{{-- @php
use App\Helper\Helper;
@endphp --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

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
                    <img src="./assets/images/Banner2.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="one">Now</h1>
                        <p>IS YOUR</p>
                        <h1>Time</h1>
                        <form class="Signup__form" id="newsletter">
                            <input required="" id="email" class="search_event" type="text" placeholder="Search"
                                autocomplete="off">

                            <a href="{{ url('search') }}"><i class="fa-solid fa-arrow-right"></i></a>

                        </form>
                        <div class="ul_body">
                        </div>
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

            <h1> Upcoming Events</h1>

        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <ul class="nav nav-pills" id="myTab" role="tablist">
                        <div class="owl_1 owl-carousel owl-theme">
                            <div class="item">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                        data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                                        aria-selected="true" onclick="getEvents('event')">Events</button>
                                </li>

                            </div>
                            <div class="item">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                        type="button" role="tab" aria-controls="profile" aria-selected="false"
                                        onclick="getEvents('you')">For You
                                    </button>
                                    <div class="eds-badge__content eds-fx--pop eds-badge__content--text eds-bg-color--success"
                                        data-spec="eds-badge__content">New</div>
                                </li>
                            </div>
                            <div class="item">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                        type="button" role="tab" aria-controls="profile" aria-selected="false"
                                        onclick="getEvents('online')">Online</button>
                                </li>
                            </div>
                            <div class="item">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                                        aria-selected="false" onclick="getEvents('today')">Today</button>
                                </li>
                            </div>
                            <div class="item">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                                        aria-selected="false" onclick="getEvents('week')">This Weekend</button>
                                </li>
                            </div>

                            <div class="item">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                                        aria-selected="false" onclick="getEvents('free')">Free</button>
                                </li>
                            </div>


                            @if (isset($categories))
                                @foreach ($categories as $category)
                                    <div class="item">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                                data-bs-target="#profile" type="button" role="tab"
                                                aria-controls="profile" aria-selected="false"
                                                onclick="getEvent({{ $category->id }})">{{ $category->name }}</button>
                                        </li>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                    </ul>



                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel"
                            aria-labelledby="home-tab">

                            <div class="container">
                                <div class="row ">

                                    @foreach ($events as $event)
                                        <div class="col-md-3" id="eventfull">
                                            <div class="new123">
                                                <a href="{{ route('site.event.details', $event->id) }}">
                                                    @php
                                                        $img1 = $event->image != null ? explode('storage/', $event->image)[1] : '';
                                                    @endphp
                                                    @if ($event->image != null && file_exists(public_path('storage/' . $img1)))
                                                        <img src="{{ $event->image }}" alt="">
                                                    @else
                                                        <img src="{{ asset('assets/images/dummy.png') }}" height="200"
                                                            alt="">
                                                    @endif
                                                </a>
                                                <div class="img12345">
                                                    @if (Auth::check() &&
                                                            in_array(
                                                                $event->id,
                                                                Auth()->user()->likes->pluck('event_id')->toArray()))
                                                        <a href="javascript:like({{ $event->id }})"><i
                                                                class="fa-regular fa-heart bg-danger"></i></a>
                                                    @else
                                                        <a href="javascript:like({{ $event->id }})"><i
                                                                class="fa-regular fa-heart"></i></a>
                                                    @endif
                                                    <a href="{{ route('site.event.details', $event->id) }}">
                                                        <h5>{{ $event->title }}</h5>
                                                    </a>
                                                    <h6>{{ Carbon\Carbon::parse($event->event_start)->format('M, d, Y') }}
                                                        - {{ Carbon\Carbon::parse($event->start_time)->format('h:i A') }}
                                                    </h6>
                                                    <p class="online">{{ ucfirst($event->location_get) }}
                                                        {{ $event->zipcode }}, {{ $event->address }},
                                                        {{ $event->city }}, {{ $event->state->name }},
                                                        {{ $event->country->name }}</p>
                                                    <p class="online" style="font-weight: bold">
                                                        {{ $event->ticket_type == 'paid' ? '$' . $event->price : 'Free' }}
                                                    </p>
                                                    <p><a
                                                            href="{{ route('user.profile', \Crypt::encryptString($event->organizer['id'])) }}">{{ $event->organizer['name'] }}</a>
                                                    </p>
                                                    <p><i
                                                            class="fa-solid fa-user"></i>{{ $event->organizer->followers->count() }}
                                                        followers</p>


                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    @if (count($events) > 8)
                                        <button class="more"> <a href="{{ route('site.search') }}">View More
                                                Events</a></button>
                                    @endif





                                </div>
                            </div>




                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="loader"></div>
                            No more Events
                        </div>
                    </div>

                </div>
            </div>
        </div>



    </section>

    <br><br>

    <section id="upcoming-events mb-5">


        <div class="container">
            <div class="col-md-12">
                <h2>Check out trending Events</h1>
            </div>

            <section class="regular" id="mtypo">
                @if (count($trending) > 0)
                    @foreach ($trending as $trend)
                        <a href="{{ route('site.event.details', $trend->id) }}">
                            <div class="opq" id="merge" style="width:33%;display: inline-block;">
                                @php
                                    $img1 = $trend->image != null ? explode('storage/', $trend->image)[1] : '';
                                @endphp
                                @if ($trend->image != null && file_exists(public_path('storage/' . $img1)))
                                    <img class="image" style="padding: 4%;" src="{{ $trend->image }}" alt="">
                                @else
                                    <img class="image" style="padding: 4%;"
                                        src="{{ asset('assets/images/dummy.png') }}" height="200" alt="">
                                @endif
                                <div class="overlay">
                                    <div class="text">{{ $trend->title }}</div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <div class="opq">
                        <h4 class="text-center">No Trending Event Found</h4>
                    </div>
                @endif


            </section>
        </div>
    </section>
    <br><br><br>
    <section id="about" class="mt-5">
        <div class="container pt-5 pb-5">
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-1"></div>
                <div class="col-md-5">
                    <h1>About Frimix</h1>
                    <p>Frimix has the drive and experience to make every event a smashing success. We bring unrivaled
                        knowledge to the table with years of experience of hands-on experience in music and celebrity
                        booking.
                        <br> At Frimix, we offer a unique simple step-by-step process that is user-friendly. Our team
                        members are diligent, providing quick services 24/7/365 days. You can use our platform for free! No
                        hidden charges here.
                    </p>
                    <!-- <a href="{{ route('site.about') }}">  <button class="btn btn-primary">Read More</button></a> -->


                </div>
            </div>
        </div>
    </section>

    <section class="image-about">

        <div class="container">
            <div class="row">
                <div class="col-md-6">

                    <img id="img-about" src="./assets/images/about-img.png" style="width: 100%;" alt="">
                </div>

                <div class="col-md-6"> </div>
    </section>

    <section class="videoSlider mx-2 mx-md-5">
        @foreach ($sliders as $slider)
            <div class="wrap p-3">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ App\Helper\Helper::getKeyEmbedCode($slider->u_link) ?? null }}" ></iframe>
                </div>
            </div>
        @endforeach

    </section>
    <script>$(".videoSlider").slick({
        slidesToShow:3,
        autoplay:true
    })</script>


    <section id="dom" class="mt-5 mb-5">
        <div class="container pt-5 pb-5">
            <div class="row">
                <h1 style="color:white;" class="text-center">Frimix</h1>
                <p style="color:white;" class="text-center">Our team members are diligent, providing quick services
                    24/7/365 days..</p>
                <button class="btn btn-primary" id="scroll">Contact Us</button>

            </div>
        </div>
    </section>

    <section id="gallery">
        <div class="container">
            <div class="row">



                <div class="col-md-6" id="newimg2">
                    <img src="./assets/images/e1.png" class="img-responsive" alt="">
                </div>

                <div class="col-md-3" id="newimg3">
                    <h1>Foods Events</h1>
                    <p>The food always wins no matter how enjoyable or entertaining the other events' activities are. We
                        provide our visitors with the best experience with deals and offers! You won’t get disappointed. .
                    </p>
                </div>


                <div class="col-md-3" id="newimg5">
                    <img src="./assets/images/e2.png" class="img-responsive" alt="">
                </div>


                <div class="col-md-6" id="newimg7">

                    <h1>Live Events 1+ million </h1>
                    <p>Frimix ensures that whatever the event, let us handle the logistics of lodging, transportation,
                        booking negotiations, and production. We bring fantastic performers, dancers, musicians, DJs, and so
                        much more. Frimix believes in keeping the party going!.</p>


                </div>


                <div class="col-md-3" id="newimg9">
                    <img src="./assets/images/e3.png" class="img-responsive" alt="">
                </div>


                <div class="col-md-3" id="newimg20">

                    <h1>Music Events</h1>
                    <p>Frimix offers exceptional, professional, and unrivaled disc jockey entertainment and lighting
                        services. Book your tickets for the most happening music festivals, concerts, and events.

                    </p>
                </div>




            </div>
        </div>
    </section>


    <section id="contact">
        <div class="container pt-5 pb-5">
            <div class="row">

                <div class="col-md-4">
                    <h1>
                        Contact Us
                    </h1>
                    <p>
                        Corporate events, speaking engagements, and music festivals are among our specialties. Frimix
                        strives toward 100% customer satisfaction.
                        <br><br> Book your tickets for upcoming events and get amazing discounts!

                    </p>

                </div>

                <div class="col-md-4">
                    <input type="text" name="name" id="name" placeholder="Name" required>
                    <input type="email" name="email" id="email" placeholder="Email" required>
                    <input type="phone" name="phone" id="phone" placeholder="Phone" required>
                    <input type="text" name="inter" id="inter" placeholder="I Am Interested In" required>


                </div>
                <div class="col-md-4">
                    <textarea name="message" id="message" cols="30" rows="10" placeholder="Leave Your Message" required></textarea>

                    <button class="btn-btn-primary" onclick="contact()">Send</button>


                </div>
            </div>
    </section>


@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"
        integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            function convertToEmbed(youtubeLinklink) {
             // const youtubeLink = document.getElementById('youtubeLink').value;
              const videoId = youtubeLink.match(/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/);

              if (videoId) {
                const embedUrl = `https://www.youtube.com/embed/${videoId[1]}`;
                document.getElementById('embedContainer').innerHTML = `<iframe width="560" height="315" src="${embedUrl}" frameborder="0" allowfullscreen></iframe>`;
              } else {
                alert('Invalid YouTube link. Please enter a valid link.');
              }
            }
          </script>

    <script>
        $(document).ready(function() {

            $(document).on('focusout', '.search_event', function(e) {
                $(this).val('');
                setTimeout(function() {
                    $(".ul_body").html('');
                }, 1000);

            });

            $(document).on('keyup change', '.search_event', function(e) {
                let ser_text = $(this).val();

                $.ajax({
                    url: "{{ route('user.event.search') }}",
                    method: "GET",
                    data: {
                        ser_text: ser_text,
                    },
                    success: function(data) {
                        // alert('helsdf');
                        $(".ul_body").html(data.view);
                    },
                    error: function(error) {
                        alert('something went wrong');

                    }
                });

            });
        });


        function contact() {
            $.ajax({
                url: "{{ route('contact.post') }}",
                method: "POST",
                data: {
                    name: document.getElementById('name').value,
                    email: $('input[name="email"]').val(),
                    phone: document.getElementById('phone').value,
                    interest: document.getElementById('inter').value,
                    message: document.getElementById('message').value,
                    _token: '{{ csrf_token() }}'


                },
                success: function(data) {
                    if (data.status == 1) {

                        successtoast(data.message);
                        document.getElementById('name').value = "";
                        $('input[name="email"]').val('');
                        document.getElementById('phone').value = "";
                        document.getElementById('inter').value = "";
                        document.getElementById('message').value = "";
                    } else if (data.status == 2) {
                        errortoast('something went wrong');

                    } else {
                        errortoast('something went wrong');
                    }
                },
                error: function(error) {
                    errortoast('something went wrong');

                }
            });
        }

        $("#scroll").click(function() {
            $('html,body').animate({
                    scrollTop: $("#contact").offset().top
                },
                'slow');
        });

        jQuery(document).ready(function() {
            $('.owl_1').owlCarousel({
                loop: false,

                responsiveClass: true,
                autoplayHoverPause: true,
                autoplay: false,
                dots: false,
                slideSpeed: 400,
                paginationSpeed: 400,
                autoplayTimeout: 3000,
                responsive: {
                    0: {
                        items: 2,
                        nav: true,
                        loop: false

                    },
                    600: {
                        items: 2,
                        nav: true,
                        loop: false
                    },
                    1000: {
                        items: 4,
                        nav: true,
                        loop: false
                    }
                }
            });
        });

        $(document).ready(function() {
            var li = $(".owl-item li");
            $(".nav-link").click(function() {

                $(".nav-link").not($(this)).removeClass('active');
            });
        });


        function getEvent(id) {
            $(".loader").css("display", "block");
            $.ajax({
                url: "{{ route('ajax.get.events') }}",
                method: "GET",
                data: {
                    id: id

                },
                success: function(data) {
                    $(".loader").css("display", "none");
                    if (data.status == 1) {

                        $('#profile').html(data.view);
                    } else {
                        errortoast('something went wrong');
                    }
                },
                error: function(error) {
                    errortoast('something went wrong');

                }
            });


        }

        function getEvents(key) {
            $(".loader").css("display", "block");
            $.ajax({
                url: "{{ route('ajax.get.events') }}",
                method: "GET",
                data: {
                    key: key

                },
                success: function(data) {
                    $(".loader").css("display", "none");
                    if (data.status == 1) {

                        $('#profile').html(data.view);
                    } else {
                        errortoast('something went wrong');
                    }
                },
                error: function(error) {
                    errortoast('something went wrong');

                }
            });
        }
    </script>
@endsection


