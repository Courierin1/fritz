@extends('layouts.site.app')

@section('title', 'Event Page')

@section('content')
<style>
  a.btn.btn-lg.theme-btn {
    background-color: #f068ed;
    margin: 0 10px;
    color: #fff;
}

section.thank_you {
  background-image: url(../assets/images/contact.png);

}

.innercarption {
    position: absolute;
    top: 30%;
    right: 0;
    left: 0;
    color: #fff;
}
.inner-image img {
    height: 600px !important;
    object-fit: cover;
}
</style>
<!-- Banner Section -->
<section class="innerbanner">
    <div class="inner-image">
        <img src="{{asset ('assets/images/blue-banner.jpg')}}" class="img-fluid w-100" alt="">
    </div>
    <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="innercarption">
        <h2 class="text-center">Your Order Has Been Placed</h2>
        <h3 class="text-center">Thank you for your Order, it’s processing</h3>
        <p class="text-center">You will receive an email with details of your order.</p>
        <center>
          <div class="btn-group" style="margin-top:20px;">
            <a href="{{route('site.user-orders')}}" class="btn btn-lg theme-btn">Orders List</a>
            <a href="{{route('home')}}" class="btn btn-lg theme-btn">Continue</a>
          </div>
        </center>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Banner Section -->

@endsection


@section('js')



@endsection
