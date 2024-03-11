@extends('layouts.admin.app')


@section('content')

<section class="content">
    <div class="container-fluid" id="sales-report">
        <div class="row">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sales Report</h3>
                    </div>
                    <!-- /.box-header -->


                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="eventname">Event Name</label>
                                <div class="form-group">

                                    <select class="form-control" id="event_name">&gt;
                                        <option value="">Select Event</option>

                                        <option value="1">demo event</option>


                                        <option value="2">Dignissimos quia exe</option>


                                        <option value="3">Unde ipsa omnis ex</option>


                                        <option value="4">Nostrud aut quisquam</option>


                                        <option value="5">Mollit consequuntur</option>

                                    </select>
                                </div>
                            </div>
                            <!--<div class="col-md-6">
                                <div class="csv-export">
                                    <button class="btn btn-danger pull-right">Export</button>
                                </div>
                            </div>-->


                            <div class="col-md-6" id="start101">
                                <div class="form-group">
                                    <label>Ticket Type</label>
                                    <select class="form-control" id="ticket_type">
                                        <option>Select Ticket Type</option>
                                        <option value="Paid">Paid</option>
                                        <option value="Free">Free</option>
                                        <option value="Donation">Donation</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <div class="input-group date">

                                        <input type="date" id="start_date" class="form-control pull-right"
                                            name="event_start">
                                    </div>


                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <div class="input-group date">

                                        <input type="date" id="end_date" class="form-control pull-right"
                                            name="event_end">
                                    </div>

                                </div>
                            </div>

                        </div>


                        <div class="row mt-3" id="paste">
                            <div class="col-md-3">

                                <div class="event-detail"
                                    style="border: 2px solid #2e6da4;margin-inline-end: 264px;padding: 13px;border-radius: 9px;">
                                    <h3>Gross Sales</h3>
                                    <h3>$27.25</h3>
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="event-detail"
                                    style="border: 2px solid #2e6da4;margin-inline-end: 264px;padding: 13px;border-radius: 9px;">
                                    <h3>Net Sales</h3>
                                    <p>Event Planner Profit ($2.4525)</p>
                                    <h3>$24.7975</h3>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="event-detail"
                                    style="border: 2px solid #2e6da4;margin-inline-end: 264px;padding: 13px;border-radius: 9px;">
                                    <h3>Tickets Sold</h3>
                                    <h3>1</h3>
                                </div>

                            </div>

                            <div class="col-md-3">
                                <div class="event-detail"
                                    style="border: 2px solid #2e6da4;margin-inline-end: 264px;padding: 13px;border-radius: 9px;">
                                    <h3>Orders</h3>
                                    <h3>1</h3>
                                </div>
                            </div>
                        </div>

                        <hr class="solid">
                        <div class="row">

                            <!-- <div class="col-md-12">
                                <div id="myPlot"></div>
                            </div> -->


                        </div>


                    </div>
                </div>

            </div>


        </div>
    </div>




</section>

@endsection
