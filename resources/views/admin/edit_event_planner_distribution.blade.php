@extends('layouts.admin.app')
@section('title', 'Edit Event Planner')
@section('content')

    <section class="content">
    <div class="container-fluid" id="event1">
        <div class="row">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Event Planner Distribution</h3>
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
                        <form action="{{ route('update_event_planner.distribution') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Set Distribution in Percentage</label>
                                        <input type="number" class="form-control" required name="distribution" maxlength="2" value="{{$dist ?  $dist->distribution : '' }}"
                                            placeholder="Enter your distribution">
                                            <input type="hidden" name="user_id" value="{{$id}}">
                                    </div>
                                </div>

                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>


        </div>


    </div>

    </section>

  



@endsection
