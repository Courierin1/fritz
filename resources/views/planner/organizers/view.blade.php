@extends('layouts.planner.app')


@section('content')




<section class="content">
    <div class="container-fluid" id="create-org">
        <div class="row">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    @include('alerts')
                    <div class="box-header with-border">
                        <p>Details that apply across your events and venues</p>
                    </div>
                    <!-- /.box-header -->

                    <form method="POST" action="{{ route('user.organizers.update', $organizer->id) }}" enctype="multipart/form-data">
                        @csrf
                <input type="hidden" name="organizer_id" value="{{$id}}">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2>View Organizer Profile</h2>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name*</label>
                                        <input type="text" class="form-control" name="name" value="{{old('name') ?? $organizer->name}}" disabled
                                            placeholder="e.g. Neabz Careers" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>SSN/Tax ID*</label>
                                        <input type="text" class="form-control" required name="tax_id" disabled
                                            value="{{old('tax_id') ?? $organizer->tax_id}}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="mt-3">Address*</label>
                                        <input type="text" class="form-control" required name="address" disabled
                                            value="{{old('address') ?? $organizer->address}}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="mt-3">Bank Name*</label>
                                        <input type="text" class="form-control" required name="bank_name" disabled
                                            value="{{old('bank_name') ?? $organizer->bank_name}}" placeholder="Bank Name">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="mt-3">Account No*</label>
                                        <input type="text" class="form-control" required name="account_no" disabled
                                            value="{{old('account_no') ?? $organizer->account_no}}" placeholder="Account No">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="mt-3">Routing Nunmber*</label>
                                        <input type="text" class="form-control" required name="routing_number" disabled
                                            value="{{old('routing_number') ?? $organizer->routing_number}}" placeholder="Routing Nunmber">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="mt-3">Account Type*</label>
                                        <input type="text" class="form-control" required name="account_type" disabled
                                            value="{{old('account_type') ?? $organizer->account_type}}" placeholder="Account Type">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="mt-3">Website (Optional)</label>
                                        <input type="text" class="form-control" name="website"
                                            value="{{old('website') ?? $organizer->website}}" disabled
                                            placeholder="e.g: https://www.neabzcareers.com/home">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="mt-3">Organizer profile image*</label>
                                        <br>
                                        @if($organizer->image !=null && file_exists(public_path('storage/organizer_images/'.auth()->id().'/'.$organizer->image)))
                                            <img class="img-rounded" width="150"
                                            src="{{ asset('storage/organizer_images/'.auth()->id().'/'.$organizer->image) }}"
                                            alt="User Avatar">
                                        @else
                                            <img src="{{asset('assets/images/dummy_user.jpg')}}" width="150" class="img-fluid" alt="event image">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Organizer Bio*</label>
                                    <p>Describe who you are, the types of events you host, or your mission. The bio is
                                        displayed on your organizer profile</p>
                                    <textarea cols="80" id="editor1" name="bio" required disabled
                                        rows="10">{{old('bio') ?? $organizer->bio}}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label>Description for event pages (Optional)</label>
                                    <p>Write a short description of this organizer to show on all your event pages</p>
                                    <textarea cols="80" id="editor2" name="description" disabled rows="10"
                                        data-sample-short>{{old('description') ?? $organizer->description}}</textarea>
                                </div>
                            </div>
                        </div>
                        <br>
                    </form>

                </div>

            </div>


        </div>
    </div>




</section>











@endsection