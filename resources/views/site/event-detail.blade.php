@extends('layouts.site.app')


@section('content')

<section id="banner">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./assets/images/blue-banner.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block" id="ven">
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<section class="eventSec">
    <div class="container">
        <div class="row p-0">
            <div class="col-md-7 col-sm-7 col-xs-12 p-0">
                <div class="eventImage">
                    <img src="{{asset ('assets/images/evennt-image.jpg')}}" class="img-fluid" alt="">
                </div>
            </div>
            <div class="col-md-5 col-sm-5 col-xs-12 p-0">
                <div class="event-text">
                    <h3>OCT <span>27</span></h3>
                    <h2>Lorem Ipsum is simply dummy text of the printing</h2>
                    <li>by<a href="#">loremipsum.com</a></li>
                    <li>337521 followers <a href="javascript:;" class="follow">Follow</a></li>
                    <li><a href="#" class="free">Free</a></li>
                </div>
            </div>
        </div>
        <div class="row py-4">
            <div class="col-md-7 col-sm-7">
                <li class="list-unstyled"><i class="fa-solid fa-thumbs-up"></i></li>
            </div>
            <div class="col-md-5 col-sm-5 col-xs-12 p-0">
                <div class="register">
                    <form action="">
                        <input type="submit" value="Register" name="register">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="event-schedule">
    <div class="container">
        <div class="row">
            <div class="co-md-12">
                <div class="eventContent">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    <h4 class="text-dark">About this event</h4>
                    <h6>This is an online event.</h6>
                    <a href="#" class="live">CLICK HERE TO WATCH THE BROADCAST LIVE</a>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    <h5><i class="fa-solid fa-calendar-days"></i>Date and time</h5>
                    <ul class="d-flex list-unstyled">
                        <li>Wed, OCT 27, 2022</li>
                        <li>|</li>
                        <li>7:00 PM – 8:00 PM PKT</li>
                    </ul>
                    <h5><i class="fa-solid fa-location-dot"></i>Location</h5>
                    <ul class="d-flex list-unstyled">
                        <li>(ONLINE EVENT)</li>
                        <li>|</li>
                        <li>USA, . 74600</li>
                    </ul>
                    <a href="#">View map</a>
                    <h5>Share with friends</h5>
                    <div class="social">
                        <ul class="">
                            <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection