@extends('layouts.admin.app')


@section('content')



<section class="content">
    <div class="container-fluid">

        <div class="row">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    @include('alerts')
                    <div class="box-header with-border">
                        <h3 class="box-title">User Queries</h3>
                    </div>
                    <!-- /.box-header -->


                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="example" class="table table-hover mt-3">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Actions </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user_queries as $key => $user_query)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $user_query->name }}</td>
                                            <td>{{ $user_query->email }}</td>
                                            <td>{{ $user_query->phone }}</td>
                                            <td>
                                                    
                                            <a href="{{ route('admin.user-queries.view', $user_query->id) }}"><i class="fa-solid fa-eye" title="View"></i></a>
                                                  
                                        </td>
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
