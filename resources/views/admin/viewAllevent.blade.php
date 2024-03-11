@extends('layouts.admin.app')


@section('content')

<section class="content">
    <div class="container-fluit" id="event1">
        <div class="row">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    
                    <!-- /.box-header -->


                    <div class="box-body">

                        




                        <h3 class="box-title">Events</h3>
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-pills">
                                <li class="active"><a href="#upcomming-events" data-toggle="tab" aria-expanded="true">Upcomming</a>
                                </li>
                                <li><a href="#past-events" data-toggle="tab" aria-expanded="false">Past</a></li>

                                
                            </ul>
                            <div class="tab-content mt-3">
                                <div class="tab-pane active" id="upcomming-events">

                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table id="example" class="table dataTable no-footer">
                                                <thead>
                                                    <tr>
                                                        <th>Event</th>
                                                        <th>Sold</th>
                                                        <th>Event Type</th>
                                                        <th>Gross</th>
                                                        <th>Status</th>
                                                        <th>Participants</th>

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                        <tr>
                                                        <td>Events </td>
                                                        <td>Events </td>
                                                        <td>Events </td>
                                                        <td>Events </td>
                                                        <td>Events </td>
                                                        <td>Events </td>
                                                           
                                                       
                                                    </tr>
                                                    
                                                </tbody>

                                            </table>
                                        </div>

                                    </div>

                                </div>

                                <div class="tab-pane" id="past-events">

                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table id="example" class="table dataTable no-footer">
                                            <thead>
                                                    <tr>
                                                        <th>Event</th>
                                                        <th>Sold</th>
                                                        <th>Event Type</th>
                                                        <th>Gross</th>
                                                        <th>Status</th>
                                                        <th>Participants</th>

                                                    </tr>

</thead>

                                                    <tbody>
                                                    <tr>
                                                        <td>Events </td>
                                                        <td>Events </td>
                                                        <td>Events </td>
                                                        <td>Events </td>
                                                        <td>Events </td>
                                                        <td>Events </td>
                                                           
                                                       
                                                    </tr>
                                                       
                                           
                                                    
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


        </div>

    </div>

</section>



@endsection