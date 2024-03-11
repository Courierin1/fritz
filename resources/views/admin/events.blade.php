@extends('layouts.admin.app')


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
                                            @foreach($events as $event)
                                            <tr>

                                            <td>
                                                    <img id="top1img" class="img-square"
                                                    width="150"
                                                        src="{{ asset($event->image) }}"
                                                        alt="User Avatar">

                                                    <div class="event_details" id="admin-event0000">
                                                        <div class="date">

                                                        </div>

                                                        <h4><b><a style="color: #f068ed;" class="event_title"
                                                                    href="javascript:;">{{ ucfirst($event->title) }}</a><b></b></b>
                                                        </h4>
                                                        <p>{{ $event->address }}</p>
                                                        <h6><time>
                                                                {{ Carbon\Carbon::parse($event->event_start)->toDayDateTimeString() }}</time>

                                                    </div>
                                                </td>
                                                <td>{{ $event->user->name }}</td>
                                                <td>{{ $event->organizer->name }}</td>
                                                <td>{{$event->total_quantity}}</td>
                                                <td>{{$event->total_quantity-$event->available_quantity}}</td>
                                                <td>{{ucfirst($event->ticket_type)}}</td>
                                                <td>

                                                    @if ($event->status == 1)
                                                    <i class="fa-solid fa-circle" style="color: green;"></i> Published
                                                    @elseif($event->status == 2)
                                                    <i class="fa-solid fa-circle" style="color: red;"></i> Draft
                                                    @elseif($event->status == 3)
                                                    <i class="fa-solid fa-circle" style="color: yellow;"></i> Past
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{route('admin.event.dashboard', $event->id)}}"><i
                                                            class="fa-solid fa-gauge-high" title="Dashboard"></i></a>
                                                    <a href="{{route('view.event', $event->id)}}"><i
                                                            class="fa-solid fa-eye" title="View"></i></a>
                                                    <a href="{{route('admin.event.orders', $event->id)}}"><i
                                                            class="fa-solid fa-users" title="Show Orders"></i></a>
                                                    <a href="{{route('edit_event_planner.distribution', $event->event_planner_id)}}"><i
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
