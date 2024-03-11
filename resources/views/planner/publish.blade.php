@extends('layouts.planner.app')


@section('content')


<section class="content">
    <div class="container-fluid" id="publish">


        <div class="row">

            <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">

                    <div class="tab-content">

                        <h3 class="box-title">Publish Your Event</h3>


                        <div class="row">
                            <div class="col-md-12">
                                <!-- Widget: user widget style 1 -->
                                <div class="box box-widget widget-user">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-aqua-active">
                                        <h3 class="widget-user-username">{{$event->title}}</h3>
                                        <h5 class="widget-user-desc">
                                        {{(Carbon\Carbon::parse($event->sales_start)->toDayDateTimeString())}}
                                        </h5>
                                    </div>

                                    <div class="widget-user-image">
                                        <img  class="img-circle"
                                        src="{{asset($event->image ? $event->image : "assets/images/avatar/avatar.jpg")}}" width="200px" height="200px" alt="User Avatar">
                                    </div>
                                    <div class="box-footer">
                                        <div class="row">
                                            <div class="col-sm-6 border-right">
                                                <div class="description-block">
                                                    <h5 class="description-header">
                                                    {{ ($event->ticket_type != 'paid') ? 'Free' : ('$'.$event->price) }}
                                                    </h5>
                                                    <span class="description-text">Price</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-6 border-right">
                                                <div class="description-block">
                                                    <h5 class="description-header">{{$event->available_quantity}}
                                                    </h5>
                                                    <span class="description-text">Tickets</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <p class="comment-text">
                                            {!! $event->summary !!}
                                            </p>
                                            <!-- /.col -->
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </div>

                                </div>

                                <br>
                                <form action="{{route('user.create.event.publish.post')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" class="public" name="public" id="optionsRadios1"
                                                    value="public" checked>
                                                <span class="eds-text-color--grey-800">Public</span><br>
                                                Shared on {{env('APP_NAME')}} and search engines
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" class="private" name="public" id="optionsRadios2"
                                                    value="draft">
                                                <span class="eds-text-color--grey-800">Draft</span><br>
                                                keep to my self only.
                                            </label>
                                        </div>

                                    </div>


                            </div>
                        </div>

                    </div>
                    <!-- /.tab-content -->
                </div>
                <input type="hidden" name="event_id" value="{{$event->id}}">
                <div class="box-footer">
                    <button type="submit" class="btn btn-default pull-right">Submit</button>
                </div>
                </form>
                <!-- nav-tabs-custom -->
            </div>
        </div>
    </div>
</section>









@endsection