@extends('layouts.admin.app')


@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3 class="box-title">Users</h3>
                <div class="table-responsive" id="event_plan">


                    <table id="example" class="table table-hover dataTable no-footer" aria-describedby="example_info">
            <thead>
                <tr>
                    <th colspan="0">ID</th>
                    <th >Name</th>
                    <th >Email</th>
                    <th >Created At</th>
                    <th >Action</th>

                </tr>
            </thead>

            <tbody>

            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{Carbon\Carbon::parse($user->created_at)->format('M, d, Y') }}</td>
                    <td><a href="{{route('admin.user.delete',$user->id)}}" ><i class="fa fa-trash"></i></a></td>
            @endforeach
                </tbody>


                    </table>


                </div>



            </div>


        </div>

    </div>


</section>







@endsection
@section('js')
<script>




</script>
@endsection
