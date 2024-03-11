@extends('layouts.admin.app')


@section('content')


<section class="content">
    <div class="container-fluid" id="event1">
  <div class="row">
<br>
      <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
              <!-- /.box-header -->

              <form method="POST" action="#" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="mb-5">View Distribution</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Event Name</label>
                                <input type="text" class="form-control" name="name" value="demo event" disabled="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Event Planner Name</label>
                                <input type="text" class="form-control" name="name" value="david" disabled="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="name" value="mark@gmail.com" disabled="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Distribution %</label>
                                <input type="text" class="form-control" name="name" value="9" disabled="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Total Revenue</label>
                                <input type="text" class="form-control" name="name" value="27.25" disabled="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Comission</label>
                                <input type="text" class="form-control" name="name" value="0" disabled="">
                            </div>
                        </div>
                    </div>
                </div>
            </form>


          </div>

      </div>


  </div>



  </div>

</section>



@endsection