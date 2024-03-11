@extends('layouts.admin.app')


@section('content')


<section class="content">
    <div class="container-fluid" id="event1">
        <div class="row">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Event Planner Distribution</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="https://staging74.yourdesigndemo.net/admin/update_event_planner/distribution" method="post">
                            <input type="hidden" name="_token" value="8QIeKQB78iraoh2mYdZobC6fy1crg8JSbldgmAfY">                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Set Distribution in Percentage</label>
                                        <input type="number" class="form-control mt-3" required="" name="distribution" maxlength="2" value="9" placeholder="Enter your distribution">
                                            <input type="hidden" name="user_id" value="1">
                                    </div>
                                </div>

                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info mt-3">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>


        </div>


    </div>

    </section>



@endsection