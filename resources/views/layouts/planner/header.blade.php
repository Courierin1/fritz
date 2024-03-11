<!DOCTYPE html>
<html lang="en">

<head>
    <title>Frimix</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="icon" href="{{asset ('assets/images/headerlogo.jpg')}}" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Oswald:wght@200;300;400;500;600;700&family=Poppins:wght@300;700&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/3f960907f8.js" crossorigin="anonymous"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:wght@500&display=swap"
        rel="stylesheet">



    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">



    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">














</head>

<body id="planner">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img style="max-width:30%!important;" src="{{asset ('assets/images/headerlogo.jpg')}}" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <!-- <form class="d-flex">
                <i class="fa-solid fa-magnifying-glass"></i>   <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">

                </form> -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">


                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                          <img src="{{asset('assets/images/iconhead.png') }}" alt=""> Welcome . {{Auth()->user()->name}}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="post1">
                            <li><a class="dropdown-item" href="#"><img src="{{asset('assets/images/create-event.png')}}" alt="">Switch to attending</a></li>
                            <li><a class="dropdown-item" href="#"><img src="{{asset('assets/images/setting.png')}}" alt="">Account Settings</a></li>
                           
                           
                            <li >
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                                    <img src="{{asset('assets/images/contact-organizer.png')}}" alt="">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li> -->


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset((Auth()->user()->userDetail->img) ? Auth()->user()->userDetail->img : 'assets/images/iconhead.png') }}" style="width: auto; height: 46px;     border-radius: 50%;" alt=""><span class="name1">
                                {{Auth()->user()->name}} </span>
                        </a>
                        <ul style="left:unset;right:0;" class="dropdown-menu" id="navside2"
                            aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{route('home')}}"><img
                                        src="{{asset('assets/images/create-event.png') }}" alt="">Switch to
                                    attending</a></li>
                                    <li><a class="dropdown-item" href="{{route('event_planner.account.information')}}"><img
                                        src="{{asset('assets/images/create-event.png') }}" alt="">Account Information</a></li>
                                 
                                        


                            
            <li class="need"><a class="dropdown-item" href="{{ route('user.dashboard') }}"><img src="{{asset('assets/images/dashboard.png')}}"
                        alt="">dashboard</a></li>

            <li class="need"><a class="dropdown-item" href="{{ route('user.create.event') }}"> <img
                        src="{{asset('assets/images/create-event.png')}}" alt="">Create Events</a></li>
            <li class="need"><a class="dropdown-item" href="{{route('user.events') }}"><img src="{{asset('assets/images/manage.png')}}"
                        alt="">Manage Events</a></li>

            <li class="need"><a class="dropdown-item" href="{{ route('user.orders') }}"><img src="{{asset('assets/images/order.png')}}"
                        alt="">Event Orders</a></li>

            <li class="need"><a class="dropdown-item" href="{{ route('user.organizers.list') }}"> <img
                        src="{{asset('assets/images/organizer.png')}}" alt="">Organizers</a></li>


            <li class="need"><a class="dropdown-item" href="{{ route('user.contact.organizer') }}"><img
                        src="{{asset('assets/images/contact-organizer.png')}}" alt="">Contact Organizers</a></li>

            <li class="need"><a class="dropdown-item" href="{{ URL::route('sales.report') }}"><img
                        src="{{asset('assets/images/salesreport.png')}}" alt="">Sales Report</a></li>

            <li class="need"><a class="dropdown-item" href="{{ URL::route('analytics') }}"><img src="{{asset('assets/images/analytics.png')}}"
                        alt="">Analytics</a></li>


            <li class="need"><a class="dropdown-item" href="{{ URL::route('event.calendar') }}"><img src="{{asset('assets/images/calender.png')}}"
                        alt="">Event Calendar</a></li>

            <li class="need"><a class="dropdown-item" href="{{ URL::route('event_planner.account.information') }}"><img
                        src="{{asset('assets/images/setting.png')}}" alt="">Account Information</a></li>








                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    <img src="{{asset('assets/images/contact-organizer.png')}}" alt="">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <section class="content-header">

        <h1>Hi, {{Auth()->user()->name}}</h1>

        <ul class="list-inline">
            <li class=""><a href="{{ route('user.dashboard') }}"><img src="{{asset('assets/images/dashboard.png')}}"
                        alt="">dashboard</a></li>

            <li class=""><a href="{{ route('user.create.event') }}"> <img
                        src="{{asset('assets/images/create-event.png')}}" alt="">Create Events</a></li>
            <li class=""><a href="{{route('user.events') }}"><img src="{{asset('assets/images/manage.png')}}"
                        alt="">Manage Events</a></li>

            <li class=""><a href="{{ route('user.orders') }}"><img src="{{asset('assets/images/order.png')}}"
                        alt="">Event Orders</a></li>

            <li class=""><a href="{{ route('list_refund_requests') }}"><img src="{{asset('assets/images/order.png')}}"
                        alt="">Refund Requests</a></li>

            <li class=""><a href="{{ route('user.organizers.list') }}"> <img
                        src="{{asset('assets/images/organizer.png')}}" alt="">Organizers</a></li>


            <li class=""><a href="{{ route('user.contact.organizer') }}"><img
                        src="{{asset('assets/images/contact-organizer.png')}}" alt="">Contact Organizers</a></li>

            <li class=""><a href="{{ URL::route('sales.report') }}"><img
                        src="{{asset('assets/images/salesreport.png')}}" alt="">Sales Report</a></li>

            <li class=""><a href="{{ URL::route('analytics') }}"><img src="{{asset('assets/images/analytics.png')}}"
                        alt="">Analytics</a></li>
            <li class=""><a href="{{ URL::route('event.calendar') }}"><img src="{{asset('assets/images/calender.png')}}"
                        alt="">Event Calendar</a></li>

            <li class=""><a href="{{ URL::route('event_planner.account.information') }}"><img
                        src="{{asset('assets/images/setting.png')}}" alt="">Account Information</a></li>

            <li class=""><a href="{{ URL::route('planner.edit_password') }}"><img
                        src="{{asset('assets/images/setting.png')}}" alt="">Edit Password</a></li>
        </ul>



    </section>