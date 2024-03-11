<!DOCTYPE html>
<html lang="en">

<head>
    <title>Frimix</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="icon" href="{{asset ('assets/images/headerlogo.jpg')}}" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>



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

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css" rel="stylesheet" /> --}}
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">



    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


</head>

<body id="site">


    <Header>


        <div class="topnav">

            <p class="text-center"><img src="./assets/images/one1.png" alt=""> No more ticket With FRIMIX Your ID is your ticket
                <a href="#">here</a>
            </p>
        </div>


        <nav class="navbar navbar-expand-sm">
            <div class="container">
                <a class="navbar-brand" href="{{route ('home')}}"> <img src="{{ asset('assets/images/headerlogo.jpg')}}"
                        alt=""> </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav" id="site-top">


                        @guest



                        <li>
                            <div class="dropdown">
                                <button id="barsite" type="button" style="background-color: unset;" class="dropdown-toggle" data-bs-toggle="dropdown">
                                    <a style="color:white;" class="nav-link" href="#">
                                    <i  style="font-size:40px!important;" class="fa fa-bars" aria-hidden="true"></i></a>
                                </button>
                                <ul style="padding-left:0px;" class="dropdown-menu">




                                    <li class="nav-item">   <a style="margin-right:unset;" class="nav-link" href="{{route('user.create.event')}}"><i
                                    class="fa-solid fa-plus"></i>Create Event</a> </li>


                                    <li class="nav-item">

                                    <a class="nav-link" href="{{route('login')}}"><i style="color: black!important;position: relative;right: 7px;" id="canada" class="fa fa-user" aria-hidden="true"></i>Log in</a>

                                        </li>

                                        @if (Route::has('register'))
                                    <li class="nav-item"> <a class="nav-link" href="{{route('register')}}"><i class="fa-solid fa-user-plus"></i>Sign
                                up</a> </li>



                                </ul>
                            </div>
                        </li>

                        <!-- <li id="create" class="nav-item">
                            <a style="margin-right:unset;" class="nav-link" href="{{route('user.create.event')}}"><i
                                    class="fa-solid fa-plus"></i>Create Event</a>
                        </li>

                        <li id="create" class="nav-item">
                            <a class="nav-link" href="{{route('login')}}"><i
                                    class="fa-solid fa-right-to-bracket"></i>Log in</a>
                        </li> -->



                        <!-- <li id="log" class="nav-item">
                            <a class="nav-link" href="{{route('register')}}"><i class="fa-solid fa-user-plus"></i>Sign
                                up</a>
                        </li> -->




                        @endif
                        @else
                        <i class="fa-solid fa-cart-shopping"></i>
                        <a href="{{ route('cart') }}"
                            style="position:relative;right:15px; color: #f068ed;font-size: 19px; text-decoration: none;">
                            <i style="color:white;" class="fa-solid fa-cart-shopping"></i>
                            <span
                                class="cart_quantity">{{\Cart::session(Auth()->user()->id)->getTotalQuantity()}}</span></a>

                        <li>
                            <div class="dropdown">
                                <button type="button" class="dropdown-toggle" data-bs-toggle="dropdown">
                                    <a style="color:white;" class="nav-link" href="{{route('user.dashboard')}}"><i
                                            class="fa-solid fa-right-to-bracket"></i>{{Auth()->user()->name}}</a>
                                </button>
                                <ul style="padding-left:0px;" class="dropdown-menu">



                                    @if (Auth()->user()->hasRole('admin'))
                                        <li class="nav-item"> <a class="nav-link" href="{{  url('/admin/dashboard') }}"><i class="fa-solid fa-people-roof"></i> Dashboard</a> </li>
                                    @else
                                    <li class="nav-item"> <a class="nav-link" href="#"><i class="fa-solid fa-ticket"></i> ID : {{ Auth()->user()->ticket_id }}</a> </li>
                                    <li class="nav-item"> <a class="nav-link" href="{{  route('user.events') }}"><i class="fa-solid fa-people-roof"></i> Manage my events</a> </li>
                                    @endif
                                   <li class="nav-item"> <a class="nav-link" href="{{ route('user.account.information')}}"><i class="fa-solid fa-id-card"></i> User Profile</a> </li>
                                    <li class="nav-item"> <a class="nav-link" href="{{ route('user.edit_password')}}"><i class="fa-solid fa-id-card"></i> Edit Password</a> </li>
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ route('site.orders')}}"><i class="fa-solid fa-border-all"></i> Orders</a> </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                           <i class="fa-solid fa-anchor"></i> {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>



                                    </li>

                                </ul>
                            </div>
                        </li>






                        @endguest


                    </ul>


                </div>
            </div>
        </nav>








    </Header>
