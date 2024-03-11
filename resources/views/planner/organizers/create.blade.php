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

                    <form method="POST" action="{{ route('user.organizers.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2>Add Organizer Profile</h2>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mt-3">
                                     <label for="">Enter Name</label>
                                        <input type="text" class="form-control" name="name" value="{{old('name')}}"
                                            placeholder="Name*" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mt-3">
                                    <label for="">SSN/Tax ID*</label>
                                        <input type="text" placeholder="SSN/Tax ID" class="form-control" required name="tax_id"
                                            value="{{old('tax_id')}}" pattern="^\d*(\.\d{0,2})?$">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mt-3">
                                  <label for="">Address*</label>
                                        <input type="text" placeholder="Address" class="form-control" required name="address"
                                            value="{{old('address')}}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group mt-3">
                                        <label for="">Bank Name*</label>
                                        <input type="text" class="form-control" required name="bank_name"
                                            value="{{old('bank_name')}}" placeholder="Bank Name">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mt-3">
                                      <label for="">Account No*</label>
                                        <input type="text" class="form-control" required name="account_no"
                                            value="{{old('account_no')}}" placeholder="Account No" pattern="^\d*(\.\d{0,2})?$">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mt-3">
                                     <label for="">Routing Nunmber*</label>
                                        <input type="text" class="form-control" required name="routing_number"
                                            value="{{old('routing_number')}}" placeholder="Routing Nunmber" pattern="^\d*(\.\d{0,2})?$">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mt-3">
                                      <label for="">Account Type</label>
                                      
                                         <select class="form-control" name="account_type" id="account_type" required> 
                                            <option value="savings" {{old('account_type')=='savings' ? 'selected' : ''}}>Savings</option>
                                            <option value="current" {{old('account_type')=='current' ? 'selected' : ''}}>Current</option>
                                        </select>  
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mt-3">
                                        <label for="">Website Link</label>
                                        <input type="url" class="form-control" name="website"
                                            value="{{old('website')}}"
                                            placeholder="Website (Optional)">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mt-3">
                                        <label style="width:100%" for="">Organizer profile image</label>
                                        <input type="file" id="img" name="img" required accept="image/*">
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
                                        rows="10">{{old('bio')}}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label>Description for event pages (Optional)</label>
                                    <p>Write a short description of this organizer to show on all your event pages</p>
                                    <textarea placeholder="Write a short description of this organizer to show on all your event pages" cols="80" id="editor2" name="description" rows="10"
                                        data-sample-short>{{old('description')}}</textarea>
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