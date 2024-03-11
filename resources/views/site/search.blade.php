@extends('layouts.site.app')

@section('css')
<style>


div#sear input[type=text] {
    height: 35px;
}
div#sear input[type=date] {
    height: 35px;
}
div#sear select {
    height: 35px;
}
div#sear select.form-select {
    padding: 1%!important;
    width: 100%;
    border: 1px solid #ffffff;
    background-color: #ffffff;
}

div#serach1 label {
    width: 100%;
    margin-top: 4%!important;
    margin-bottom: 2%!important;
    color: #f068ed;
}
input#from_date {
    padding: 4%;
    width: 100%;
    border: 1px solid #cfc3c3;
    background-color: #ffffff;
}
input#to_date {
    padding: 4%;
    width: 100%;
    border: 1px solid #cfc3c3;
    background-color: #ffffff;
}
input#price {
    padding: 4%;
    width: 100%;
    border: 1px solid #cfc3c3;
    background-color: #ffffff;
}
select.form-select {
    padding: 4%;
    width: 100%;
    border: 1px solid #cfc3c3!important;
    background-color: #ffffff;
}
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid blue;
  border-right: 16px solid green;
  border-bottom: 16px solid red;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
  text-align: center;
    margin: 0 auto;
    display:none;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
@endsection
@section('content')


<section id="banner">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./assets/images/eventsban.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block" id="ven">




                    <h1 class="mt-5">Search</h1>


                </div>


            </div>


        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>




</section>

<div class="container-fluid" id="serach1">

    <div class="row">
        <div class="col-md-2" id="sear">
            <h1>Filters</h1>
            <label for="">From Date</label>
            <input type="date" id="from_date" name="from_date" onchange="searchs()">
            <label for="">To Date</label>
            <input type="date" id="to_date" name="to_date" onchange="searchs()">
            <label for="customRange2" class="form-label">Price range</label>
            <input type="range" class="form-range" min="{{$min_event_price}}" max="{{$max_event_price}}" step="1" id="price_range" onchange="searchs()">
            <input type="text" id="price" name="price" readonly disabled placeholder="$ 0.00">

            
            <label for="">Event Type</label>
            <select class="form-select" name="event_type" id="event_type" onchange="searchs()">
                <option selected disabled value="">Select Event Type</option>
                @foreach($event_types as $event_type)
                <option value="{{$event_type->id}}">{{$event_type->name}}</option>
                @endforeach
            </select>

            <label for="">Category</label>
            <select class="form-select" aria-label="Default select example" name="category" id="category">
                <option selected disabled value="">Category</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>

            <label for="">Sub Category</label>
            <div class="sub_category_ajax">
                <select class="form-select" name="sub_category" id="sub_category" onchange="searchs()" disabled>
                    <option selected disabled value="">Sub Category</option>
                </select>
            </div>
            
            <label for="">Ticket Type</label>
            <!-- <select class="form-select" name="ticket_type" id="ticket_type" onchange="searchs()">
                <option selected disabled value="">Select Type</option>
                <option value="paid">Paid</option>
                <option value="free">Free</option>
            </select> -->
            <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="ticket_type" id="inlineRadio1" value="paid" onchange="searchs()">
  <label class="form-check-label" for="inlineRadio1">Paid</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="ticket_type" id="inlineRadio2" value="free" onchange="searchs()">
  <label class="form-check-label" for="inlineRadio2">Free</label>
</div>

        </div>

        <div class="col-md-10" id="find">
       
            <section id="upcoming-events">


                <div class="">
                    <div class="row">
                        <div class="col-md-12" id="paste">




                            <div class="sepo">
                                <div class="row">


                                   
                                    <div class="Signup__form" id="oper">
                                        <input required="" id="email" type="text" name="search" placeholder="Search Event Name...">
                                        <a href="javascript:;"><button class="btn btn-debault" onclick="search()">Search</button></a>
</div>

<div class="loader"></div>
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

                                  

                                

                                </div>
                            </div>


                           
                        </div>

                    </div>
                </div>






            </section>
        </div>

    </div>

</div>



@endsection
@section('js')
<script>
function search(){
   
    if(document.getElementById('email').value.length <3){
        errortoast('Please enter a valid event name');
        return false;
    }
    else{
        $(".loader").css("display", "block");
    $.ajax({
        
            url: "{{ route('ajax.search.events') }}",
            method: "GET",
            data: {
                name:document.getElementById('email').value

            },
            success: function(data) {
                $(".loader").css("display", "none");
                if (data.status == 1) {
                    
                $('#paste').html(data.view);
                }
                    
                 else {
                    errortoast('something went wrong');
                }
            },
            error: function(error) {
                errortoast('something went wrong');

            }
        });
    }
}

$(document).on('change', 'select[name="category"]', function(event) {
    $.ajax({
        url: "{{ route('sub_category_ajax') }}",
        method: "GET",
        data: {
            category_id:document.getElementById('category').value,
        },
        success: function(data) {
            if (data.status == 1) {
                $('.sub_category_ajax').html(data.view);
            }
            else {
                errortoast('something went wrong');
            }
        },
        error: function(error) {
            errortoast('something went wrong');

        }
    });
    searchs();
});

function searchs(){
    $(".loader").css("display", "block");
    
    $("#price").val('$'+$("#price_range").val());
    $.ajax({
            url: "{{ route('ajax.search.events') }}",
            method: "GET",
            data: {
                price:document.getElementById('price_range').value,
                from_date:document.getElementById('from_date').value,
                to_date:document.getElementById('to_date').value,
                category:document.getElementById('category').value,
                sub_category:document.getElementById('sub_category').value,
                event_type:document.getElementById('event_type').value,
                ticket_type:$('input[name="ticket_type"]:checked').val()
            },
            success: function(data) {
                $(".loader").css("display", "none");
                if (data.status == 1) {

                $('#paste').html(data.view);
                }
                    
                 else {
                    errortoast('something went wrong');
                }
            },
            error: function(error) {
                errortoast('something went wrong');

            }
        });
}
</script>
@endsection