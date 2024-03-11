
<div class="row m-0">
                        <div class="col-md-6 col-xs-12 event-search">
@if($events->count()>0)
@foreach ($events as $event) 
    <a href="{{ route('site.event.details', $event->id) }}" target='_blank'><div class="row">
        
        <div class="col-md-3">
            <img src="{{ ($event->image) }}" class="img-fluid" alt="">
        </div>
        <div class="col-md-9">
            <div class="event-text">
                <h5>{{ $event->title }}</h5>
                <h6>{{Carbon\Carbon::parse($event->event_start)->format('M, d, Y') }} <span class="time">{{Carbon\Carbon::parse($event->start_time)->format('h:i A') }}</span></h6>
            </div>
            </div>
    </div>
</a>
@endforeach
@else
<div class="error">
<h5 class=" text-center" style="color: #f068ed;">&#9785; Seems like you searched something wrong!</h5>
<br/>
<a href="{{route('site.events')}}"><small style="color: #f068ed;" class="text-center d-block">Click me! I have something for you.</small></a>
</div>
@endif

</div>
    </div>