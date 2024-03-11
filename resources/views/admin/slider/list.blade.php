@extends('layouts.admin.app')


@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    @include('alerts')
                    <div class="box-header with-border">

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h3 class="box-title">Sliders</h3>
                            </div>
                            <div class="col-md-6">
                                <a id="org120" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-default float-right add_type" data-href="{{ url('/admin/slider/store') }}">Add Slide</a>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="example" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Order #</th>
                                                <th>Link</th>
                                                <th>Status</th>
                                                <th>Actions </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sliders as $key => $slider)
                                            <tr>
                                                <td>{{ $slider->order_no }}</td>
                                                <td><a href="{{ $slider->u_link }}" target="_blank" rel="noopener noreferrer">{{ $slider->u_link }}</a></td>
                                                <td>{!! $slider->status==1 ? '<div class="badge bg-success">Active</div>' : '<div class="badge bg-danger">Inactive</div>' !!}</td>
                                                </td>
                                                <td>
                                                    <a class="edit_type" data-id="{{$slider->id}}"
                                                        data-u_link="{{$slider->u_link}}"
                                                        data-order="{{$slider->order_no}}"
                                                        data-status="{{$slider->status}}"
                                                        href="{{ url('/admin/slider/'.$slider->id.'/update') }}"><i
                                                            class="fa-solid fa-edit" title="Edit"></i></a>

                                                            <a href="{{ url('/admin/slider/'.$slider->id.'/destroy') }}"><i class="fa-solid fa-trash" title="Delete"></i></a>

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

<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Slide</h4>
                <button type="button" class="btn-close close_modal" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <section class="create-type">
                    <form id="type_form" action="{{ url('/admin/slider/store') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Video Link</label>
                                    <input style="width:100%" type="text" class="form-control" required
                                        placeholder="Enter Your Slide Name" name="u_link" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Order No</label>
                                    <input style="width:100%" type="number" class="form-control" required
                                        placeholder="For order in front" name="order_no" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Status</label>
                                   <select name="status" class="form-control" required id="status">
                                    <option value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                   </select>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="submit" class="btn btn-info" value="Submit">
                        </div>
                    </form>
                </section>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

$(document).on('change', '.change_status', function (e) {
 // e.preventDefault();
    var href = $(this).attr('data-href');
    var id = $(this).attr('data-id');

    $.ajax({
        type: 'POST',
        url: href,
        data: {
            id: id,
            _token: $("meta[name='csrf-token']").attr("content"),
        },
        success: function (data) {
            // console.log(data);
            if (data.code == '200')
                successtoast(data.message);
            else {
                errortoast(data.message);
            }
        }
    });
});

</script>
<script>
    $(document).ready(function () {
        // alert('hjelosdf');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".add_type").click(function(e){
            var href = $(this).attr('data-href');

            $('input[name="id"]').val("");
            $('input[name="u_link"]').val("");
            $('input[name="order_no"]').val("");
            $('select[name="status"]').val("");
            $('#type_form').attr('action', href);
            $('.modal-title').text('Add Slide');
        });
        $(".delete_type").click(function (e) {
            e.preventDefault();
            var href = $(this).attr('href');
            var id = $(this).attr('data-id');

            $.ajax({
                type: 'POST',
                url: href,
                data: {
                    id: id
                },
                success: function (data) {
                    successtoast(data.success);
                }
            });
        });
        $(".edit_type").click(function (e) {
            e.preventDefault();
            var href = $(this).attr('href');
            var id = $(this).attr('data-id');
            var u_link = $(this).attr('data-u_link');
            var status = $(this).attr('data-status');
            var order_no = $(this).attr('data-order');
            $('.modal-title').text('Edit Slide');
            $('input[name="id"]').val(id);
            $('input[name="u_link"]').val(u_link);
            $('input[name="order_no"]').val(order_no);
            $('select[name="status"]').val(status);
            $('#type_form').attr('action', href);
            $('#myModal').show();
        });

        $(".close_modal").click(function (e) {
            $('#myModal').hide();
        });
    });

</script>


@endsection
