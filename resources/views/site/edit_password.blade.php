@extends('layouts.site.app')


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
                <img src="../assets/images/userprofile.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block" id="ven">


               



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



<section id="inner-row">

<div class="container" id="account-setting">
        <div class="row" id="siteuserprofile">
        <form action="{{ route('update_password') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-md-12">
               <!-- general form elements -->
               <div class="box box-primary">
                  <div class="box-header with-border">
                     <h3 class="box-title">Edit Password</h3>
                     <hr class="solid">
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                  <div class="row">
                           <div class="mb-3">
                              <label >Current Password</label>
                              <input type="password"
                              placeholder="Current Password" class="form-control" 
                              name="old_password" required>
                           </div>
                           <div class="mb-3">
                              <label >New Password</label>
                              <input type="password"
                              placeholder="New Password" class="form-control" 
                              name="new_password" required>
                           </div>
                           <div class="mb-3">
                              <label >Confirm Password</label>
                              <input type="password"
                              placeholder="Confirm Password" class="form-control" 
                              name="confirm_password" required>
                           </div>
                        </div>
                  </div>
               </div>
               <div class="box-footer">
                  <button type="submit" class="btn btn-default mb-5">Save</button>
               </div>
            </div>
         </form>
        </div>
    </div>




</section>






@endsection























