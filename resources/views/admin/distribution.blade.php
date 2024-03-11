@extends('layouts.admin.app')
@section('title', 'Distribution List')

@section('content')


<style>
    .view_textarea_styling {
        border: 1px solid #eeeeee;
        border-radius: 5px;
        background-color: #eeeeee;
        padding: 5px;
    }
</style>

<section class="content">
    <div class="container">
  <div class="row">
<br>
      <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
              <!-- /.box-header -->

              <form method="POST" action="{{ route('update_organizer') }}" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>View Distribution</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Event Name</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    name="name" 
                                    value="{{$distribution['events']->title ?? '' }}"
                                    disabled
                                >
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Event Planner Name</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    name="name" 
                                    value="{{$distribution['events']->getUser->name ?? '' }}"
                                    disabled
                                >
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    name="name" 
                                    value="{{$distribution->email ?? '' }}"
                                    disabled
                                >
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Distribution %</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    name="name" 
                                    value="{{ $distribution['events']->getEventPlanner->distribution ?? '' }}"
                                    disabled
                                >
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Total Revenue</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    name="name" 
                                    value="{{$totalRevenue ?? '' }}"
                                    disabled
                                >
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Comission</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    name="name" 
                                    value="{{$adminCommision ?? '' }}"
                                    disabled
                                >
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

