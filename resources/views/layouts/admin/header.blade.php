<!DOCTYPE html>
<html lang="en">

<head>
    <title>Frimix</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="{{asset ('assets/images/headerlogo.jpg')}}" />


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Oswald:wght@200;300;400;500;600;700&family=Poppins:wght@300;700&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/3f960907f8.js" crossorigin="anonymous"></script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:wght@500&display=swap"
        rel="stylesheet">



    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">














</head>

<body id="admin">
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

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{asset('assets/images/iconhead.png') }}" alt=""> {{Auth::user()->name}}
                        </a>
                        <ul style="left:unset;right:0;" class="dropdown-menu" id="navside2"
                            aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" target="_blank" href="{{route('home')}}"><img
                                        src="{{asset('assets/images/create-event.png') }}" alt="">View website</a></li>

                                        <li class="plans"><a href="{{ URL::route('admin.events') }}"><img src="{{asset('assets/images/dashboard.png') }}"
                        alt="">Events</a></li>


            <li class="plans"><a class="dropdown-item" href="{{ URL::route('admin.event.planners') }}"> <img
                        src="{{asset('assets/images/create-event.png') }}" alt="">Event Planner</a></li>


            <li class="plans"><a class="dropdown-item" href="{{ route('admin.types.list') }}"><img src="{{asset('assets/images/order.png') }}"
                        alt="">Custom Event Types</a></li>
            <li class="plans"><a class="dropdown-item" href="{{ route('admin.categories.list') }}"><img src="{{asset('assets/images/order.png') }}"
                        alt="">Categories</a></li>

            <li class="plans"><a class="dropdown-item" href="{{ URL::route('admin.users') }}"><img src="{{asset('assets/images/manage.png') }}"
                        alt="">user</a></li>


            </li>

            <li class="plans"><a class="dropdown-item" href="{{ route('admin.mass_emailing')}}"><img
                        src="{{asset('assets/images/analytics.png') }}" alt="">Email</a></li>

            <li class="plans"><a class="dropdown-item" href="{{ URL::route('admin.sale.reports')}}"><img
                        src="{{asset('assets/images/calender.png') }}" alt="">Global Sales Report</a></li>

            <li class="plans"><a class="dropdown-item" href="{{ URL::route('admin.orders')}}"><img src="{{asset('assets/images/setting.png') }}"
                        alt="">Order</a></li>

            <li class="plans"><a class="dropdown-item" href="{{route('admin.user-queries.list')}}"><img
                        src="{{asset('assets/images/contact-organizer.png') }}" alt="">User Queries</a></li>

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


            <li class=""><a href="{{ URL::route('admin.events') }}"><img src="{{asset('assets/images/dashboard.png') }}"
                        alt="">Events</a></li>
            <li class=""><a href="{{ URL::route('admin.event.planners') }}"> <img
                        src="{{asset('assets/images/create-event.png') }}" alt="">Event Planner</a></li>


            <li class=""><a href="{{ route('admin.types.list') }}"><img src="{{asset('assets/images/order.png') }}"
                        alt="">Custom Event Types</a></li>
            <li class=""><a href="{{ route('admin.categories.list') }}"><img src="{{asset('assets/images/order.png') }}"
                        alt="">Categories</a></li>

            <li class=""><a href="{{ URL::route('admin.users') }}"><img src="{{asset('assets/images/manage.png') }}"
                        alt="">user</a></li>


            </li>
            <li class=""><a href="{{url('/admin/slider')}}"><img
                src="{{asset('assets/images/setting.png') }}" alt="">Slider</a></li>

            <li class=""><a href="{{ route('admin.mass_emailing')}}"><img
                        src="{{asset('assets/images/analytics.png') }}" alt="">Email</a></li>

            <li class=""><a href="{{ URL::route('admin.sale.reports')}}"><img
                        src="{{asset('assets/images/calender.png') }}" alt="">Global Sales Report</a></li>

            <li class=""><a href="{{ URL::route('admin.orders')}}"><img src="{{asset('assets/images/setting.png') }}"
                        alt="">Order</a></li>

            <li class=""><a href="{{ URL::route('list_admin_refund_requests')}}"><img src="{{asset('assets/images/setting.png') }}"
                        alt="">Refund Requests</a></li>

            <li class=""><a href="{{route('admin.user-queries.list')}}"><img
                        src="{{asset('assets/images/contact-organizer.png') }}" alt="">User Queries</a></li>

            <li class=""><a href="{{ URL::route('admin.edit_password') }}"><img
                        src="{{asset('assets/images/setting.png')}}" alt="">Edit Password</a></li>
        </ul>



    </section>
