@extends('layouts.planner.app')


@section('content')



<section class="content">
    <div class="container-fluid">

        <div class="row">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    @include('alerts')
                    <div class="box-header with-border">

                        <div class="row mt-3 mb-3">
                            <div class="col-md-6">
                                <h3 class="box-title">Event Organizers</h3>
                            </div>

                            <div class="col-md-6">
                                <a id="org120" class="btn btn-default float-right"
                                    href="{{ route('user.organizers.create') }}">Create Organizer</a> <br>
                            </div>


                        </div>




                    </div>
                    <!-- /.box-header -->


                    <div class="box-body">
                        <div class="row">

                            <!-- <div class="col-md-4">
                                <div class="input-group">

                                    <input type="text" id="search" name="search" class="form-control"
                                        placeholder="Search...">
                                    <span class="input-group-btn">
                                        <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">

                                    <select class="form-control" name="status" id="status">
                                        <option value="">All</option>
                                        <option value="1">Published</option>
                                        <option value="2">Draft</option>
                                        <option value="3">Past</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">

                                    <select class="form-control" name="organizer" id="organizer">
                                        <option selected="" value="">Select Organizer</option>
                                        <option value="1">Portia York</option>
                                    </select>
                                </div>
                            </div> -->
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="example001" class="table table-hover mt-3">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Status</th>
                                                <th>Actions </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($organizers as $key => $organizer)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $organizer->name }}</td>

                                                <td> 
                                                    @if($organizer->image !=null && file_exists(public_path('storage/organizer_images/'.auth()->id().'/'.$organizer->image)))
                                                        <img class="img-rounded" width="150"
                                                        src="{{ asset('storage/organizer_images/'.auth()->id().'/'.$organizer->image) }}"
                                                        alt="User Avatar">
                                                    @else
                                                        <img src="{{asset('assets/images/dummy_user.jpg')}}" width="150" class="img-fluid" alt="event image">
                                                    @endif
                                                <!-- <td>{{ ($organizer->status) ? 'Active' : "Inactive" }}</td>
                                                </td> -->
                                                <!-- <td>
                                                <div class="dropdown">
                                                    <button class="dropdown-toggle" type="button" id="dropdownMenu1"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">

                                                        <li><a href="{{ route('user.organizers.view', $organizer->id) }}">View</a>
                                                        </li>
                                                        <li><a href="{{ route('user.organizers.edit', $organizer->id) }}">Edit</a>
                                                        </li>

                                                        <li>
                                                            <a 
                                                                href="{{ route('user.organizers.destroy', $organizer->id) }}" 
                                                                class="delete_organizer" 
                                                                data-id="{{$organizer->id}}"
                                                            >{{$organizer->status ? 'Inactive' : 'Active'}}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td> -->

                                            <!-- <td> -->
                                            <!-- <td><label class="switch">
                                                    <input type="checkbox" class="delete_organizer" data-id="{{$organizer->id}}" 
                                                    data-href="{{ route('user.organizers.destroy', $organizer->id) }}"
                                                    onchange="destroy(this)"
                                                    {{$organizer->status==1? 'checked' : '' }}
                                                        >
                                                    <span class="slider round"></span>
                                                </label></td>
                                            </td> -->


                                            <td>
                                            <div class="form-check form-switch " style="display:flex; justify-content:center;">
                                                <input class="form-check-input delete_organizer" type="checkbox" id="mySwitch" name="darkmode" 
                                                value="yes" 
                                                data-id="{{$organizer->id}}"
                                                data-href="{{ route('user.organizers.destroy', $organizer->id) }}"
                                                onchange="destroy(this)"
                                                {{$organizer->status==1? 'checked' : '' }}
                                                >
      
    </div>
                                            </td>
                                            </td>

                                                <td>

                                                    <a href="{{ route('user.organizers.view', $organizer->id) }}"><i
                                                            class="fa-solid fa-eye" title="View"></i></a>

                                                    <a href="{{ route('user.organizers.edit', $organizer->id) }}"><i
                                                            class="fa-solid fa-pen-to-square" title="Edit"></i></a>
                                                    
                                                </td>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>

    </div>

</section>



@endsection

@section('js')


<script>
    function destroy(item) {
            // e.preventDefault();
            var href = $(item).attr('data-href');
            var id = $(item).attr('data-id');

            $.ajax({
                type: 'POST',
                url: href,
                data: {
                    id: id
                },
                success: function (data) {
                    // console.log(data);
                    if (data.code == '200')
                        successtoast(data.success);
                    else {
                        errortoast(data.success);
                    }
                }
            });
        }
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
       
    });

</script>

@endsection