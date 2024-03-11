
                <div class="container">
                    <div class="row">


                    <h1 class="mt-5 mb-5">Popular in {{ucfirst($state->name)}}</h1>

                    @if(count($events)>0)
                                        @foreach($events as $event)
                                            <div class="col-md-3">
                                                <div class="new123">
                                                    <a href="{{ route('site.event.details', $event->id) }}"> <img src="{{$event->image}}" alt=""></a>

                                                    <div class="img12345">
                                                    @if(Auth::check() && in_array($event->id,Auth()->user()->likes->pluck('event_id')->toArray()))
                                            <a href="javascript:like({{$event->id}})"><i class="fa-regular fa-heart bg-danger"></i></a>
                                            @else
                                            <a href="javascript:like({{$event->id}})"><i class="fa-regular fa-heart"></i></a>
                                            @endif
                                                                <h5>{{$event->title}}</h5>
                                                                <h6>{{ Carbon\Carbon::parse($event->event_start)->format('M, d, Y') }} - {{ Carbon\Carbon::parse($event->start_time)->format('h:i A') }}</h6>
                                                                <p class="online">{{ucfirst($event->location_get)}} {{$event->zipcode}}, {{$event->address}}, {{$event->city}}, {{$event->state->name}}, {{$event->country->name}}</p>
                                                                <p class="online" style="font-weight: bold">{{($event->ticket_type == 'paid') ? '$'.$event->price : 'Free'}} </p>
                                                                <p><a href="{{route('user.profile',\Crypt::encryptString($event->organizer['id']))}}">{{$event->organizer['name']}}</a></p>
                                                                <p><i class="fa-solid fa-user"></i>{{$event->organizer->followers->count()}} followers</p> 

                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach

                     @else  
                     <div> No Events Found In <span style="color: #f068ed;">{{ucfirst($state->name)}}</span></div>
                     
                     @endif

                    </div>
                </div>


                @if(count($events)>10)
                <button class="more"> <a href="{{route('search')}}">View More Events</a></button>
                @endif