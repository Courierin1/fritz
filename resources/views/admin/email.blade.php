@extends('layouts.admin.app')

@section('css')

<style>
    #cke_editor2 {
        width: 100% !important;
    }
</style>

@endsection

@section('content')

<section class="content">
    <div class="container-fluid" id="event1">
        <div class="row">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Mass Emailing System</h3>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                    <div>
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <p><strong>Opps Something went wrong</strong></p>
                                    <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if(session('success'))
                                <div class="alert alert-success">{{session('success')}}</div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger">{{session('error')}}</div>
                            @endif
                        </div>
                       

                        <form method="POST" action="{{ route('admin.submit_mass_emailing') }}">
                            @csrf
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Your Name" value="{{ old('name') }}" required>
                            </div>

                            <div class="form-group">
                                <label>Reply-To Email</label>
                                <input type="email" class="form-control" name="reply_to" placeholder="Enter Your Email" value="{{ old('reply_to') }}" required>
                            </div>

                            <div class="form-group">
                                <label>To</label>
                                <select class="form-control" name="send_to" value="{{ old('send_to') }}" required>
                                    <option value="all_organizers">All Event Planners</option>
                                    <option value="all_users">All Users</option>
                                    {{--<option value="all_organizers">All Attendees</option>
                                    <option value="specific_users">Specific Users</option>--}}
                                </select>
                            </div>
                            {{--<div class="specific_users_search">
                                <div class="input-group">
                                    <input type="text" id="search" name="search" class="form-control"
                                        placeholder="Search..." required>
                                    <span class="input-group-btn">
                                        <button type="submit" name="search" id="search-btn"
                                            class="btn btn-flat"><i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>--}}

                            <div class="form-group">
                                <label>Subject</label>
                                <input type="text" class="form-control" name="subject" value="{{ old('subject') }}" placeholder="Enter Your Email Subject" value="Event has been postponed" required>
                            </div>

                            <div class="form-group">
                                <label>Message</label>
                                <textarea placeholder="Message" cols="100%" id="editor2" name="message" rows="10" required>{{ old('message') }}</textarea>
                            </div>

                            <div class="box-footer mt-5" id="postpone-btn">
                                <button style="margin-bottom:3%;" type="submit" class="btn btn-info">Send Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('js')

{{-- CKEditor --}}
    <script src="https://cdn.ckeditor.com/4.17.2/standard-all/ckeditor.js"></script>

    {{-- CKEditor --}}
    <script>
        CKEDITOR.replace('message', {
            height: 260,
            width: 700,
            removeButtons: 'PasteFromWord'
        });
    </script>
    <script>
        // $(document).ready(function() {
        //     $('.specific_users_search').hide();
        //     $('.send-to').on('click', function() {
        //         var send_to = $('.send-to').val();
        //         if (send_to == "specific_users") {
        //             $('.specific_users_search').show();
        //         } else {
        //             $('.specific_users_search').hide();
        //         }


        //     });


        // });
    </script>

@endsection