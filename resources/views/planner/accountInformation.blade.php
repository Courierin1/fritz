@extends('layouts.planner.app')


@section('content')

<section class="content">
   <div class="container-fluid" id="account-setting">
      <div class="row">
         <form action="{{ route('insert_event_account_settings') }}" method="post" enctype="multipart/form-data">
            @csrf
            @if (session()->has('message'))
            <div class="alert alert-success">
               {{ session()->get('message') }}
            </div>
            @endif
            @if (session()->has('error'))
            <div class="alert alert-warning">
               {{ session()->get('error') }}
            </div>
            @endif
            <div class="col-md-12">
               <!-- general form elements -->
               <div class="box box-primary">
                  <div class="box-header with-border">
                     <h3 class="box-title">Account Information</h3>
                     <hr class="solid">
                  </div>
                  <!-- /.box-header -->
                  @if(isset($user_details))
                  <div class="box-body">
                     <section class="account-info">
                        <div class="form-group">
                           <label>Profile Photo</label>
                           <br>

                           <img class="img-square" src="{{ asset(($user_details->img) ? $user_details->img : 'assets/images/iconhead.png') }}" style="width: auto; height: 86px;     border-radius: 50%;" alt="User Avatar">
                           <br><br>
                           <input type="file" id="img" name="img" accept="image/*">


                        </div>
                     </section>
                     <section class="contact-info">
                        <h3>Contact Information</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Prefix*</label>
                                    <select class="form-control" required name="prefix" required>
                                    <option value="" disabled selected>Select Prefix</option>

                                        <option value="Mr." {{ $user_details->prefix=="Mr." ? 'selected' : '' }}>Mr.</option>
                                        <option value="Mrs." {{ $user_details->prefix=="Mrs." ? 'selected' : '' }}>Mrs.</option>
                                        <option value="Miss" {{ $user_details->prefix=="Miss." ? 'selected' : '' }}>Miss</option>
                                        <option value="Mx." {{ $user_details->prefix=="Mx." ? 'selected' : '' }}>Mx.</option>
                                        <option value="Dr." {{ $user_details->prefix=="Dr." ? 'selected' : '' }}>Dr.</option>
                                        <option value="Prof." {{ $user_details->prefix=="Prof." ? 'selected' : '' }}>Prof.</option>
                                        <option value="Rev." {{ $user_details->prefix=="Rev." ? 'selected' : '' }}>Rev.</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                   <label>Date Of Birth*</label>
                                   <input type="date" class="form-control" placeholder="Enter Your Date Of Birth" name="dob" required value="{{ $user_details->dob }}">
                                </div>
                             </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>First Name*</label>
                                 <input type="text" class="form-control" placeholder="Enter Your First Name" name="first_name" required value="{{ $user_details->first_name }}">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Last Name*</label>
                                 <input type="text" class="form-control" placeholder="Enter Your Last Name" name="last_name" required value="{{ $user_details->last_name }}">
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="mt-3">Suffix (Optional)</label>
                           <input type="text" class="form-control" name="suffix" placeholder="John Doe Jr." value="{{ $user_details->suffix }}">
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="mt-3">Home Phone*</label>
                                 <input type="text" class="form-control" name="home_phone" placeholder="+447419543367" required value="{{ $user_details->home_phone }}">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="mt-3">Cell Phone*</label>
                                 <input type="text" class="form-control" name="cell_phone" placeholder="+14844458417" required value="{{ $user_details->cell_phone }}">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="mt-3">Job Title (Optional)</label>
                                 <input type="text" class="form-control" name="job_title" placeholder="Senior Executive Manager" value="{{ $user_details->job_title }}">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="mt-3">Company / Organization (Optional)</label>
                                 <input type="text" class="form-control" name="company" placeholder="Enter Your Company" value="{{ $user_details->company }}">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="mt-3">Website (Optional)</label>
                                 <input type="text" class="form-control" name="website" placeholder="https://www.neabz.com"  value="{{ $user_details->website }}">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="mt-3">Blog (Optional)</label>
                                 <input type="text" class="form-control" name="blog" placeholder="https://www.neabz.com/blog" value="{{ $user_details->blog }}">
                              </div>
                           </div>
                        </div>
                     </section>
                     <section class="home-address">
                        <h3>Home Address</h3>
                        <div class="form-group">
                           <label>Address 1 (Optional)</label>
                           <input type="text" class="form-control" name="home_address_one" placeholder="Enter Your First Address" value="{{ $user_details->home_address_one }}">
                        </div>
                        <div class="form-group">
                           <label>Address 2 (Optional)</label>
                           <input type="text" class="form-control" name="home_address_two" placeholder="Enter Your Second Address"  value="{{ $user_details->home_address_two }}">
                        </div>
                        <div class="form-group">
                           <label>City (Optional)</label>
                           <input type="text" class="form-control" name="home_address_city" placeholder="Enter Your City Name" value="{{ $user_details->home_address_city }}">
                        </div>
                        <div class="form-group">
                           <label for="country">Country (Optional)</label>
                           <select class="form-control" name="home_address_country">
                              <option value="" disabled selected>Select Country</option>
                              @foreach ($countries as $country)
                              <option value="{{ $country->id }}" {{((old('home_address_country') ?? $user_details->home_address_country) == $country->id) ? 'selected' : '' }}>{{ $country->name }}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Zip/Postal Code (Optional)</label>
                                 <input type="text" class="form-control" name="home_address_zip_code" placeholder="0663814" value="{{ $user_details->home_address_zip_code }}">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>State (Optional)</label>
                                 <select class="form-control" name="home_address_state">
                                    <option value="" disabled selected>Select State</option>
                                    @foreach ($states as $state)
                                    <option value="{{ $state->id }}" {{((old('home_address_state') ?? $user_details->home_address_state) == $state->id) ? 'selected' : '' }}>{{ $state->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                        </div>
                     </section>
                     <section class="billing-address">
                        <h3>Billing Address</h3>
                        <div class="form-group">
                           <label>Address 1 (Optional)</label>
                           <input type="text" class="form-control" name="billing_address_one" placeholder="Enter Your First Address" value="{{ $user_details->billing_address_one }}">
                        </div>
                        <div class="form-group">
                           <label>Address 2 (Optional)</label>
                           <input type="text" class="form-control" name="billing_address_two" placeholder="Enter Your Second Address" value="{{ $user_details->billing_address_two }}">
                        </div>
                        <div class="form-group">
                           <label>City (Optional)</label>
                           <input type="text" class="form-control" name="billing_address_city" placeholder="Enter Your City" value="{{ $user_details->billing_address_city }}">
                        </div>
                        <div class="form-group">
                           <label for="country">Country (Optional)</label>
                           <select class="form-control" name="billing_address_country" >
                              <option value="" disabled selected>Select Country</option>
                              @foreach ($countries as $country)
                                 <option value="{{ $country->id }}" {{((old('billing_address_country') ??$user_details->billing_address_country) == $country->id) ? 'selected' : '' }}>{{ $country->name }}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Zip/Postal Code (Optional)</label>
                                 <input type="text" class="form-control" name="billing_address_zip" placeholder="0663814" value="{{ $user_details->billing_address_zip }}">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>State (Optional)</label>
                                 <select class="form-control" name="billing_address_state">
                                    <option value="" disabled selected>Select State</option>
                                    @foreach ($states as $state)
                                    <option value="{{ $state->id }}" {{((old('billing_address_state') ?? $user_details->billing_address_state) == $state->id) ? 'selected' : '' }}>{{ $state->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                        </div>
                     </section>
                     <section class="shipping-address">
                        <h3>Shipping Address</h3>
                        <div class="form-group">
                           <label>Address 1 (Optional)</label>
                           <input type="text" class="form-control" name="shipping_address_one" placeholder="Enter Your First Address" value="{{ $user_details->shipping_address_one }}">
                        </div>
                        <div class="form-group">
                           <label>Address 2 (Optional)</label>
                           <input type="text" class="form-control" name="shipping_address_two" placeholder="Enter Your Second Address" value="{{ $user_details->shipping_address_two }}">
                        </div>
                        <div class="form-group">
                           <label>City (Optional)</label>
                           <input type="text" class="form-control" name="shipping_address_city" placeholder="Enter Your City" value="{{ $user_details->shipping_address_city }}">
                        </div>
                        <div class="form-group">
                           <label for="country">Country (Optional)</label>
                           <select class="form-control" name="shipping_address_country">
                              <option value="" disabled selected>Select Country</option>
                              @foreach ($countries as $country)
                                 <option value="{{ $country->id }}" {{((old('shipping_address_country') ?? $user_details->shipping_address_country) == $country->id) ? 'selected' : '' }}>{{ $country->name }}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Zip/Postal Code (Optional)</label>
                                 <input type="text" class="form-control" name="shipping_address_zip" placeholder="0663814" value="{{ $user_details->shipping_address_zip }}">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>State (Optional)</label>
                                 <select class="form-control" name="shipping_address_state">
                                    <option value="" disabled selected>Select State</option>
                                    @foreach ($states as $state)
                                    <option value="{{ $state->id }}" {{((old('shipping_address_state') ?? $user_details->shipping_address_state) == $state->id) ? 'selected' : '' }}>{{ $state->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                        </div>
                     </section>
                     <section class="work-address">
                        <h3>Work Address</h3>
                        <div class="form-group">
                           <label>Address 1 (Optional)</label>
                           <input type="text" class="form-control" name="work_address_one" placeholder="Enter Your First Address" value="{{ $user_details->work_address_one }}">
                        </div>
                        <div class="form-group">
                           <label>Address 2 (Optional)</label>
                           <input type="text" class="form-control" name="work_address_two" placeholder="Enter Your Second Address" value="{{ $user_details->work_address_two }}">
                        </div>
                        <div class="form-group">
                           <label>City (Optional)</label>
                           <input type="text" class="form-control" name="work_address_city" placeholder="Enter Your City" value="{{ $user_details->work_address_city }}">
                        </div>
                        <div class="form-group">
                           <label for="country">Country (Optional)</label>
                           <select class="form-control" name="work_address_country">
                              <option value="" disabled selected>Select Country</option>
                              @foreach ($countries as $country)
                              <option value="{{ $country->id }}" {{((old('work_address_country') ?? $user_details->work_address_country) == $country->id) ? 'selected' : '' }}>{{ $country->name }}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Zip/Postal Code (Optional)</label>
                                 <input type="text" class="form-control" name="work_address_zip" placeholder="0663814" value="{{ $user_details->work_address_zip }}">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>State (Optional)</label>
                                 <select class="form-control" name="work_address_state">
                                    <option value="" disabled selected>Select State</option>
                                    @foreach ($states as $state)
                                    <option value="{{ $state->id }}" {{((old('work_address_state') ?? $user_details->work_address_state) == $state->id) ? 'selected' : '' }}>{{ $state->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                        </div>
                     </section>
                  </div>
                  @else
                  <div class="box-body">
                     <section class="account-info">
                        <div class="form-group">
                           <label>Profile Photo</label>
                           <br>
                           <img class="img-square" src="{{ asset('assets/dist/img/user1-128x128.jpg') }}" style="width: auto; height: 86px;" alt="User Avatar">
                           <br><br>
                           <input type="file" id="img" name="img" accept="image/*">
                        </div>
                     </section>
                     <section class="contact-info">
                        <h3>Contact Information</h3>
                        <div class="form-group">
                           <label>Prefix*</label>
                           <select class="form-control" required name="prefix" required>
                              <option value="Mr.">Mr.</option>
                              <option value="Mrs.">Mrs.</option>
                              <option value="Miss">Miss</option>
                              <option value="Mx.">Mx.</option>
                              <option value="Dr.">Dr.</option>
                              <option value="Prof.">Prof.</option>
                              <option value="Rev.">Rev.</option>
                           </select>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>First Name*</label>
                                 <input type="text" class="form-control" placeholder="Enter Your First Name" name="first_name" required>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Last Name*</label>
                                 <input type="text" class="form-control" placeholder="Enter Your Last Name" name="last_name" required>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label>Suffix</label>
                           <input type="text" class="form-control" name="suffix" placeholder="John Doe Jr.">
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Home Phone (Optional)</label>
                                 <input type="text" class="form-control" name="home_phone" placeholder="+447419543367">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Cell Phone (Optional)</label>
                                 <input type="text" class="form-control" name="cell_phone" placeholder="+14844458417">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Job Title (Optional)</label>
                                 <input type="text" class="form-control" name="job_title" placeholder="Senior Executive Manager">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Company / Organization (Optional)</label>
                                 <input type="text" class="form-control" name="company"  placeholder="Enter Your Company">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Website (Optional)</label>
                                 <input type="text" class="form-control" name="website" placeholder="https://www.neabz.com">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Blog (Optional)</label>
                                 <input type="text" class="form-control" name="blog" placeholder="https://www.neabz.com/blog">
                              </div>
                           </div>
                        </div>
                     </section>
                     <section class="home-address">
                        <h3>Home Address</h3>
                        <div class="form-group">
                           <label>Address 1 (Optional)</label>
                           <input type="text" class="form-control" name="home_address_one" placeholder="Enter Your First Address">
                        </div>
                        <div class="form-group">
                           <label>Address 2 (Optional)</label>
                           <input type="text" class="form-control" name="home_address_two" placeholder="Enter Your Second Address">
                        </div>
                        <div class="form-group">
                           <label>City (Optional)</label>
                           <input type="text" class="form-control" name="home_address_city" placeholder="Enter Your City Name">
                        </div>
                        <div class="form-group">
                           <label for="country">Country (Optional)</label>
                           <select class="form-control" name="home_address_country">
                              @foreach ($countries as $country)
                              <option value="{{ $country->id }}">{{ $country->name }}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Zip/Postal Code (Optional)</label>
                                 <input type="text" class="form-control" name="home_address_zip_code" placeholder="0663814">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>State (Optional)</label>
                                 <select class="form-control" name="home_address_state">
                                    @foreach ($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                        </div>
                     </section>
                     <section class="billing-address">
                        <h3>Billing Address</h3>
                        <div class="form-group">
                           <label>Address 1 (Optional)</label>
                           <input type="text" class="form-control" placeholder="Enter Your First Address" name="billing_address_one">
                        </div>
                        <div class="form-group">
                           <label>Address 2 (Optional)</label>
                           <input type="text" class="form-control"  placeholder="Enter Your Second  Address" name="billing_address_two" required>
                        </div>
                        <div class="form-group">
                           <label>City (Optional)</label>
                           <input type="text" class="form-control" name="billing_address_city"  placeholder="Enter Your City Name">
                        </div>
                        <div class="form-group">
                           <label for="country">Country (Optional)</label>
                           <select class="form-control" name="billing_address_country">
                              @foreach ($countries as $country)
                              <option value="{{ $country->id }}">{{ $country->name }}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Zip/Postal Code (Optional)</label>
                                 <input type="text" class="form-control" name="billing_address_zip" placeholder="0663814">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>State (Optional)</label>
                                 <select class="form-control" name="billing_address_state">
                                    @foreach ($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                        </div>
                     </section>
                     <section class="shipping-address">
                        <h3>Shipping Address</h3>
                        <div class="form-group">
                           <label>Address 1 (Optional)</label>
                           <input type="text" class="form-control" name="shipping_address_one" placeholder="Enter Your First Address">
                        </div>
                        <div class="form-group">
                           <label>Address 2 (Optional)</label>
                           <input type="text" class="form-control" name="shipping_address_two" placeholder="Enter Your Second Address">
                        </div>
                        <div class="form-group">
                           <label>City (Optional)</label>
                           <input type="text" class="form-control" name="shipping_address_city" placeholder="Enter Your City Name">
                        </div>
                        <div class="form-group">
                           <label for="country">Country (Optional)</label>
                           <select class="form-control" name="shipping_address_country">
                              @foreach ($countries as $country)
                              <option value="{{ $country->id }}">{{ $country->name }}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Zip/Postal Code (Optional)</label>
                                 <input type="text" class="form-control" name="shipping_address_zip" placeholder="0663814">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>State (Optional)</label>
                                 <select class="form-control" name="shipping_address_state">
                                    @foreach ($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                        </div>
                     </section>
                     <section class="work-address">
                        <h3>Work Address</h3>
                        <div class="form-group">
                           <label>Address 1 (Optional)</label>
                           <input type="text" class="form-control" name="work_address_one" placeholder="Enter Your First Address" >
                        </div>
                        <div class="form-group">
                           <label>Address 2 (Optional)</label>
                           <input type="text" class="form-control" name="work_address_two" placeholder="Enter Your Second Address" >
                        </div>
                        <div class="form-group">
                           <label>City (Optional)</label>
                           <input type="text" class="form-control" name="work_address_city" placeholder="Enter Your City Name" >
                        </div>
                        <div class="form-group">
                           <label for="country">Country (Optional)</label>
                           <select class="form-control" name="work_address_country">
                              @foreach ($countries as $country)
                              <option value="{{ $country->id }}">{{ $country->name }}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Zip/Postal Code (Optional)</label>
                                 <input type="text" class="form-control" name="work_address_zip" placeholder="0663814">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>State (Optional)</label>
                                 <select class="form-control" name="work_address_state">
                                    @foreach ($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                        </div>
                     </section>
                  </div>
                  @endif
               </div>
               <div class="box-footer">
                  <button type="submit" class="btn btn-default">Save</button>
               </div>
            </div>
         </form>
      </div>
   </div>

</section>












@endsection
