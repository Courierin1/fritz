@extends('layouts.planner.app')


@section('content')


<section class="content">
    <div class="container-fluid" id="org-data">
        <div class="row">
            <div class="col-md-12">
                <div class="box-header with-border">
                    <h3 class="box-title">Organizers <a style="width:15%;float:right;"
                            href="{{ url('createorganizer') }}" class="btn btn-default pull-right" id="orga123"
                            role="button">Create Organizer</a></h3>


                </div>
                <div style="padding-top: 20px;">

                </div>
                <div class="table-responsive" style="margin-top:1%;">
                    <table id="example" class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Followers</th>
                                <th>Image</th>
                                <th>Actions </th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>1</td>
                                <td>name</td>
                                <td>2.3k</td>
                                <td>none</td>
                                <td>
                                    <a href="#"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="#"><i class="fa-solid fa-trash"></i></a>
                                </td>

                            </tr>
                            <tr>
                                <td>1</td>
                                <td>name</td>
                                <td>2.3k</td>
                                <td>none</td>
                                <td>
                                    <a href="#"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="#"><i class="fa-solid fa-trash"></i></a>
                                </td>

                            </tr>
                            <tr>
                                <td>1</td>
                                <td>name</td>
                                <td>2.3k</td>
                                <td>none</td>
                                <td>
                                    <a href="#"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="#"><i class="fa-solid fa-trash"></i></a>
                                </td>

                            </tr>





                        </tbody>

                    </table>
                </div>




            </div>
        </div>
    </div>




</section>


@endsection
