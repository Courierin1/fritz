@extends('layouts.planner.app')


@section('content')



<section class="content">
    <div class="container-fluid">
    @include('alerts')
    <div class="row">

    <h3 class="box-title mb-3">Events</h3>

<!-- <div class="col-md-4">
    <div class="input-group">

        <input type="text" id="search" name="search" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat">
            </button>
        </span>
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">

        <select class="form-control" name="status" id="status">
            <option >All</option>
            <option value="1">Published</option>
            <option value="2">Draft</option>
            <option value="3">Past</option>
        </select>
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">

        <select class="form-control" name="organizer" id="organizer">
            <option selected="" >Select Organizer</option>
                                                <option value="1">Portia York</option>
                                            </select>
    </div>
</div> -->

</div>




        <div class="row mt-3">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">

                    </div>
                    <!-- /.box-header -->


                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="example001" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Event</th>
                                            <th>Sold</th>

                                            <th>Total Tickets</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>


                                    </thead>

                                    <tbody>
                                    @foreach($events as $event)
                                    <tr>

                                        <td>{{$event->title}}</td>
                                        <td>{{$event->total_quantity-$event->available_quantity}}</td>

                                        <td>{{$event->total_quantity}}</td>
                                        <td>
                                        @if ($event->status == 1)
                                            <i class="fa-solid fa-circle" style="color: green;"></i> Published
                                            @elseif($event->status == 2)
                                            <i class="fa-solid fa-circle" style="color: red;"></i> Draft
                                            @elseif($event->status == 3)
                                            <i class="fa-solid fa-circle" style="color: yellow;"></i> Past
                                            @endif
                                        </td>
                                        <td>
                                        <a href="{{ route('user.view.event', $event->id) }}"><i
                                                            class="fa-solid fa-eye" title="View"></i></a>
                                        <a href="{{route('user.edit.event', $event->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                                           <!-- <a href="#"><i class="fa-solid fa-trash"></i></a>  -->
                                        <a href="javascript:;"
                                            data-id="{{$event->id}}"
                                            data-href="{{route('user.event.destroy')}}"
                                            onclick="destroy(this)"><i class="fa-solid fa-trash"></i></a>
                                            <a href="#" class="makeorder" data-id="{{ $event->id }}" data-name="{{ ucfirst($event->title) }}"
                                            data-org="{{ $event->organizer->name }}" data-able="{{ $event->available_quantity }}"  data-bs-toggle="modal" data-bs-target="#myModal">
                                            <i class="fa-solid fa-users" title="Make Orders"></i></a>
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

@include('makeOrder')

@endsection

@section('js')
<script>

(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
})
function destroy(item) {
    // e.preventDefault();
    var href = $(item).attr('data-href');
    var id = $(item).attr('data-id');
    // let this_ev = this;

    $.ajax({
        type: 'POST',
        url: href,
        data: {
            id: id
        },
        success: function (data) {
            // console.log(data);
            if (data.code == '200'){
                successtoast(data.success);
                $(item).closest('tr').remove();
            }
            else {
                errortoast(data.success);
            }
        }
    });
}

</script>
@endsection
