@extends('layouts.admin.app')


@section('content')


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3 class="box-title">Event Planners</h3>
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
                <div class="table-responsive" id="event_plan">
                    <table id="example" class="table table-hover">
                        <thead>
                            <tr>
                                <th colspan="0">ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th> Actions</th>
                            </tr>
                        </thead>

                        <tbody>

            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{Carbon\Carbon::parse($user->created_at)->format('M, d, Y') }}</td>
                    <td>            
                        <a  href="{{route('event_planner_events', $user->id)}}"><i class="fa-solid fa-calendar-check" title="All Events"></i></a>
                        <a  href="{{route('admin.organizers.list', ['planner_id' => $user->id])}}"><i class="fa-solid fa-user-tie" title="All Organizer"></i></a>
                        <a  href="{{route('view_sales', $user->id)}}"><i class="fa-solid fa-envelope-open-text" title="Sales Report"></i></a>
                        <a  href="{{route('edit_event_planner.distribution', $user->id)}}"><i class="fa-solid fa-money-bill-1-wave" title="Set % Commision"></i></a>
                    </tr>
            @endforeach
                </tbody>

                    </table>


                </div>



            </div>


        </div>

    </div>


</section>







@endsection