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
                            <h3 class="box-title">Event Types</h3>

                            </div>
                            <div class="col-md-6">
                            <a id="org120" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-default float-right add_type" data-href="{{ route('admin.types.store') }}">Add Type</a>
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
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Actions </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($types as $key => $type)
                                            <tr>
                                                <td>{{ $type->id }}</td>
                                                <td>{{ $type->name }}</td>
                                                </td>
                                                <td>
                                                    <a class="edit_type" data-id="{{$type->id}}"
                                                        data-name="{{$type->name}}"
                                                        href="{{ route('admin.types.update', $type->id) }}"><i
                                                            class="fa-solid fa-edit" title="Edit"></i></a>

                                                            <a href="{{ route('admin.types.destroy', $type->id) }}"><i class="fa-solid fa-trash" title="Delete"></i></a>

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
                <h4 class="modal-title">Add Type</h4>
                <button type="button" class="btn-close close_modal" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <section class="create-type">
                    <form id="type_form" action="{{ route('admin.types.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Type Name</label>
                                    <input style="width:100%" type="text" class="form-control" required
                                        placeholder="Enter Your Type Name" name="name" value="">
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
            $('input[name="name"]').val("");
            $('#type_form').attr('action', href);
            $('.modal-title').text('Add Type');
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
            var name = $(this).attr('data-name');
            $('.modal-title').text('Edit Type');

            $('input[name="id"]').val(id);
            $('input[name="name"]').val(name);
            $('#type_form').attr('action', href);
            $('#myModal').show();
        });

        $(".close_modal").click(function (e) {
            $('#myModal').hide();
        });
        // $(document).on("submit","#type_form",function(e) {
        //     e.preventDefault();
        //     var name = $('input[name="name"]').val();
        //     var parent_id = $('select[name="parent_id"] option:selected').val();
        //     var href = $(this).attr('action');

        //     $.ajax({
        //     type:'POST',
        //     url:href,
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        //     },
        //     data:{
        //         _token: "{{ csrf_token() }}",
        //         name:name, 
        //         parent_id:parent_id
        //     },
        //     success:function(data){
        //         alert(data.message);
        //     }
        //     });
        // });
    });

</script>


@endsection
