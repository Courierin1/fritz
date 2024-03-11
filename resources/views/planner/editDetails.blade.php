@extends('layouts.planner.app')


@section('content')

<section class="content">
    <div class="container-fluid" id="create-org">
        <div class="row">
            @include('alerts')
            <!-- left column -->
            <div class="col-md-12">
                <form id="details" method="POST" action="{{ route('user.edit.event.details.post')}}" enctype="multipart/form-data">
                    @csrf
                    <h3 class="box-title">Details</h3>
                    <div class="form-group">
                        <label>Main Event Image(*)</label>
                        <p>This is the first image attendees will see at the top of your listing. Use a high quality
                            image: 2160x1080px (2:1 ratio).</p>
                        <div class="drop-zone"> <span class="drop-zone__prompt">Drop file here or click to upload</span>
                            <input type="file" name="image" class="drop-zone__input">
                            <br><br>
                            @php 
                                $img1 =  ($event->image != null) ? (explode('storage/', $event->image)[1]) : '';
                            @endphp
                            @if($event->image !=null && file_exists(public_path('storage/'.$img1)))
                                <img src="{{ asset($event->image) }}" class="img-fluid" alt="event image">
                            @else
                                <img src="{{asset('assets/images/dummy.png')}}" class="img-fluid" alt="event image">
                            @endif
                        </div>
                    </div>
                    <br />
                    <div class="form-group">
                        <label for="">Write a short event summary to get attendees excited*</label>
                        <textarea class="form-control" rows="5" col="5" name="summary" required
                            placeholder="Write a short event summary to get attendees excited">{{old('summary',$event->summary)}}</textarea>
                    </div>
                    <div class="form-group mt-3">
                        <label for="">Add more details to your event like your schedule, sponsors, or featured guests*</label>
                        <textarea cols="80" id="editor1" placeholder="Add more details to your event like your schedule, sponsors, or featured guests" name="details" rows="10" data-sample-short
                            required>{{old('details',$event->details)}}</textarea>
                    </div>
                    <input type="hidden" name="event_id" value="{{$event->id}}">
                    <div class="box-footer">
                        <button style="margin-top:3%;" type="submit" class="mt-5 pull-right" id="pop1"><i
                                class="fa-solid fa-arrow-right"></i></button>
                        <!-- <a href="#" style="margin-top:3%;" type="submit"
                            class="mt-5 pull-left" id="pop1"><i class="fa-solid fa-arrow-left"></i></a> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>





@endsection