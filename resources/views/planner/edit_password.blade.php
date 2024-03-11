@extends('layouts.planner.app')


@section('content')

<section class="content">
   <div class="container-fluid" id="account-setting">
      <div class="row">

      <form method="POST" action="{{ route('update_password') }}" class="ltn__form-box contact-form-box needs-validation"  enctype="multipart/form-data" novalidate>
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
                  <button type="submit" class="btn btn-default">Update</button>
               </div>
            </div>
         </form>
      </div>
   </div>

</section>












@endsection
