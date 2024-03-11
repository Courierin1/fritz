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
                                    <h2>Update Organizer Profile</h2>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name*</label>
                                        <input type="text" class="form-control" name="name" value="{{old('name') ?? $organizer->name}}"
                                            placeholder="e.g. Frimix Careers" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>SSN/Tax ID*</label>
                                        <input placeholder="Enter SSN/Tax ID" type="text" class="form-control" required name="tax_id"
                                            value="{{old('tax_id') ?? $organizer->tax_id}}" pattern="^\d*(\.\d{0,2})?$">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="mt-3">Address*</label>
                                        <input placeholder="Enter Address" type="text" class="form-control" required name="address"
                                            value="{{old('address') ?? $organizer->address}}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="mt-3">Bank Name*</label>
                                        <input type="text" class="form-control" required name="bank_name"
                                            value="{{old('bank_name') ?? $organizer->bank_name}}" placeholder="Bank Name">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="mt-3">Account No*</label>
                                        <input type="text" class="form-control" required name="account_no" pattern="^\d*(\.\d{0,2})?$"
                                            value="{{old('account_no') ?? $organizer->account_no}}" placeholder="Account No">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="mt-3">Routing Number*</label>
                                        <input type="text" class="form-control" required name="routing_number" pattern="^\d*(\.\d{0,2})?$"
                                            value="{{old('routing_number') ?? $organizer->routing_number}}" placeholder="Routing Number">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="mt-3">Account Type*</label>
                                      

                                            <select class="form-control" name="account_type" id="account_type" required> 
                                            <option value="savings" {{old('account_type',$organizer->account_type)=='savings' ? 'selected' : ''}}>Savings</option>
                                            <option value="current" {{old('account_type',$organizer->account_type)=='current' ? 'selected' : ''}}>Current</option>
                                        </select> 
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="mt-3">Website (Optional)</label>
                                        <input type="url" class="form-control" name="website"
                                            value="{{old('website') ?? $organizer->website}}"
                                            placeholder="e.g: https://www.google.com/">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="mt-3">Organizer profile image*</label>
                                        <br>

                                        <input type="file" id="img" name="img" accept="image/*">
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
                                    <textarea placeholder="Describe who you are, the types of events you host, or your mission. The bio is displayed on your organizer profile" cols="80" id="editor1" name="bio" required
                                        rows="10">{{old('bio') ?? $organizer->bio}}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label>Description for event pages (Optional)</label>
                                    <p>Write a short description of this organizer to show on all your event pages</p>
                                    <textarea placeholder="Write a short description of this organizer to show on all your event pages" cols="80" id="editor2" name="description" rows="10"
                                        data-sample-short>{{old('description') ?? $organizer->description}}</textarea>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-default">Submit<br></button>
                        </div>
                    </form>

                </div>

            </div>


        </div>
    </div>




</section>











@endsection

@section('js')
<script>
    
    $(document).on('keydown', 'input[pattern]', function(e) {
            var input = $(this);
            var oldVal = input.val();
            var regex = new RegExp(input.attr('pattern'), 'g');
            setTimeout(function() {
                var newVal = input.val();
                if (!regex.test(newVal)) {
                    input.val(oldVal);
                }
            }, 0);
        });
</script>
@endsection