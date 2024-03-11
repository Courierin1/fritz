@extends('layouts.planner.app')


@section('content')


<section class="content">
    <div class="container-fluid" id="org-data">
        <div class="row">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">User Queries</h3>

                    </div>
                    <!-- /.box-header -->


                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="example001" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Contact Reason</th>
                                                <th>Message</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($contactOrganizers as $contactOrganizer)
                                            <tr>
                                                <td>{{ $contactOrganizer->id }}</td>
                                                <td>{{ $contactOrganizer->name }}</td>
                                                <td>{{ $contactOrganizer->email }}</td>
                                                <td>{{ $contactOrganizer->reason }}</td>
                                                <td>{{ $contactOrganizer->message }}</td>
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
