@extends('layouts.admin.app')


@section('content')




<section class="content">
    <div class="container-fluid" id="create-org">
        <div class="row">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    @include('alerts')
                    <!-- /.box-header -->

                    <form method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2>View User Query</h2>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="mt-3">Name</label>
                                        <input type="text" class="form-control" name="name" value="{{old('name') ?? $user_query->name}}" disabled
                                            placeholder="e.g. Neabz Careers" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="mt-3">Email</label>
                                        <input type="text" class="form-control" name="email" value="{{old('email') ?? $user_query->email}}" disabled
                                            placeholder="e.g. Neabz Careers" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="mt-3">Phone No</label>
                                        <input type="text" class="form-control" name="phone" value="{{old('phone') ?? $user_query->phone}}" disabled
                                            placeholder="e.g. Neabz Careers" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="mt-3">Interest</label>
                                        <input type="text" class="form-control" name="interest" value="{{old('interest') ?? $user_query->interest}}" disabled
                                            placeholder="e.g. Neabz Careers" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="mt-3">Message</label>
                                        <textarea cols="80" id="editor1" name="message" required disabled
                                            rows="10">{{old('message') ?? $user_query->message}}</textarea>
                                    </div>
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