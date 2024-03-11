@extends('layouts.site.app')


@section('content')



<section id="userprofile">

    <div class="container">
        <div class="row">

            <div class="col-md-12">

                <h1>Organizer</h1>






            </div>




        </div>



    </div>



</section>

<section id="userprofiles" class="mb-5">

    <div class="container">

        <div class="row mt-5">
            <div class="col-md-4">
            <img style="width:68%;" src="./assets/images/usericon.jpg" alt="">

<h1>{{$user->name}}</h1>
<p style="font-size: 18px;">
<i class="fa-solid fa-location-dot"></i>{{$user->address}}
          

</p>
<h4>{{$user->followers->count()}} Followers</h4>

<button href="javascript:void(0);" data-auth_check="{{Auth::check()}}" data-organizer_id="{{ $user->id }}" id="following_btn" class="btn btn-primary" >
                    {{(Auth::check()) ? ((Auth::user()->organizerFollower->where('organizer_id', $user->id)->first() != null) ? 'Unfollow' : 'Follow') : 'Follow'}}
                    </button>


            </div>
            <div class="col-md-8" id="userpost">

                <div class="row">
                @foreach(\App\Event::whereOrganizerId($user->id)->get() as $event)
                    <div class="col-md-6">
                        <a href="{{ route('site.event.details', $event->id) }}"> <img class="img-fluid" width="500" src="{{$event->image}}"
                                alt="event-image"></a>
                        <h5>{{$event->title}}</h5>
                        <h6>{{ Carbon\Carbon::parse($event->event_start)->format('M, d, Y') }} - {{ Carbon\Carbon::parse($event->start_time)->format('h:i A') }}</h6>
                        <p>{{$event->details}}</p>
                        <!-- <a href="">read more ></a> -->


                    </div>
                    @endforeach
                   
                   
                </div>


               

              




            </div>

        </div>

    </div>


</section>



<section id="follower">

<div class="container">
<div class="row">
<div class="col-md-12">
<h1>Followers</h1>

</div>

<div class="row">


<div class="col-md-1">
<img  id="arrow" style="width: 50%;" src="./assets/images/left.png"  alt="">

</div>

@foreach($user->followers as $follower)
<div class="col-md-2">

<img style="width: 100%;" src="{{ file_exists(asset('storage/'.$follower->user->userDetail['img'])) ? asset('storage/'.$follower->user->userDetail['img']) : '/assets/images/icons123.png'}}"  alt="">
<p>{{$follower->user['name']}}</p>
</div>
@endforeach


<div class="col-md-1">
<img id="arrow" style="width: 50%;" src="./assets/images/right.png"  alt="">

</div>

</div>

</div>


</section>




@endsection

@section('js')

<script>
    $(document).ready(function () {
        $(document).on('click', '#following_btn', function (e) {
            let auth_check = $(this).attr('data-auth_check');
            let organizer_id = $(this).attr('data-organizer_id');
            let this_val = this;

            if (auth_check == 1) {
                $.ajax({
                    type: 'post',
                    url: "{{ route('user.organizers.check_follow')}}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "organizer_id": organizer_id
                    },
                    success: function (data) {
                        // $("#follow-btn").load(window.location.href + " #follow-btn");
                        successtoast(data.message);

                        if (data.following == 1){
                            $(this_val).html('Unfollow');
                            // $(this_val).removeClass('btn-primary');
                            // $(this_val).addClass('btn-success');
                        } 
                        else if (data.following == 0){
                            $(this_val).html('Follow');
                            // $(this_val).removeClass('btn-success');
                            // $(this_val).addClass('btn-primary');
                        } 
                    },
                    error: function (error) {
                        errortoast("Something went wrong");
                    }
                });
            } else {
                errortoast('please login first')
            }
            


        });

    });

</script>
@endsection
