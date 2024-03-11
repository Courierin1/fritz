@extends('layouts.admin.app')

@section('css')
<style>
    .event_title,
    .event_title:hover {
        color: #000;
        font-size: 2rem;
        font-weight: 800;
        text-decoration: none;
    }

</style>

@endsection
@section('content')


<section class="content">
    <div class="container-fluid">






        <div class="row">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Events</h3>
                    </div>
                    <!-- /.box-header -->


                    <div class="box-body">
                    <div>
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <p><strong>Opps Something went wrong</strong></p>
                                    <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if(session('success'))
                                <div class="alert alert-success">{{session('success')}}</div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger">{{session('error')}}</div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="example" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Event Planner</th>
                                                <th>Organizer</th>
                                                <th>Total Quantity</th>
                                                <th>Sold</th>
                                                <th>Event Type</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>


                                        </thead>

                                        <tbody>
                                            @foreach($UpComingEvents as $UpComingEvent)
                                            <tr>

                                                <td>
                                                    <img id="top1img" class="img-square"
                                                        width="150"
                                                        src="{{ asset($UpComingEvent->image) }}"
                                                        alt="User Avatar">

                                                    <div class="event_details" id="admin-event0000">
                                                        <div class="date">

                                                        </div>


                                                        <h4><b><a class="event_title"
                                                                    href="javascript:;">{{ ucfirst($UpComingEvent->title) }}</a><b></b></b>
                                                        </h4>
                                                        <p>{{ $UpComingEvent->address }}</p>
                                                        <h6><time>
                                                                {{ Carbon\Carbon::parse($UpComingEvent->event_start)->toDayDateTimeString() }}</time>

                                                    </div>
                                                </td>
                                                <td>{{ $UpComingEvent->user->name }}</td>
                                                <td>{{ $UpComingEvent->organizer->name }}</td>
                                                <td>{{$UpComingEvent->total_quantity}}</td>
                                                <td>{{$UpComingEvent->total_quantity-$UpComingEvent->available_quantity}}</td>
                                                <td>{{ucfirst($UpComingEvent->ticket_type)}}</td>
                                                <td>

                                                    @if ($UpComingEvent->status == 1)
                                                    <i class="fa-solid fa-circle" style="color: green;"></i> Published
                                                    @elseif($UpComingEvent->status == 2)
                                                    <i class="fa-solid fa-circle" style="color: red;"></i> Draft
                                                    @elseif($UpComingEvent->status == 3)
                                                    <i class="fa-solid fa-circle" style="color: yellow;"></i> Past
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{route('user.edit.event', $UpComingEvent->id)}}"><i
                                                            class="fa-solid fa-gauge-high" title="Dashboard"></i></a>
                                                    <a href="{{route('user.edit.event', $UpComingEvent->id)}}"><i
                                                            class="fa-solid fa-eye" title="View"></i></a>
                                                    <a href="{{route('user.edit.event', $UpComingEvent->id)}}"><i
                                                            class="fa-solid fa-users" title="Show Participants"></i></a>
                                                    <a href="{{route('user.edit.event', $UpComingEvent->id)}}"><i
                                                            class="fa-solid fa-money-bill-1"
                                                            title="Show Commission"></i></a>
                                                </td>

                                            </tr>
                                            @endforeach



                                        </tbody>

                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>

    </div>

</section>





@endsection
