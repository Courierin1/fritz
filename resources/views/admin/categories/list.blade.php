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
                                <h3 class="box-title">Event Categories</h3>

                            </div>
                            <div class="col-md-6">

                            <a id="org120"  href="javascript:void(0)" data-bs-toggle="modal"
                                    data-bs-target="#myModal" class="btn btn-default float-right add_category ml-2 notpol"
                                    data-href="{{ route('admin.categories.store') }}">Add Category</a>

                                <a id="org120"  href="javascript:void(0)" data-bs-toggle="modal"
                                    data-bs-target="#myModal" class="btn btn-default float-right add_sub_category"
                                    data-href="{{ route('admin.categories.store') }}">Add Sub Category</a>
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
                                                <th>Parent</th>
                                                <th>Actions </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categories as $key => $category)
                                            <tr>
                                                <td>{{ $category->id }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->parent->name ?? 'No Parent' }}</td>
                                                <td>


                                                    <a class="edit_category" data-id="{{$category->id}}"
                                                        data-parent_id="{{($category->parent_id != null ? $category->parent_id : 0)}}"
                                                        data-name="{{$category->name}}"
                                                        href="{{ route('admin.categories.update', $category->id) }}"><i
                                                            class="fa-solid fa-edit" title="Edit"></i></a>
                                                    <!-- <div class="dropdown">
                                                    <button class="dropdown-toggle" type="button" id="dropdownMenu1"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">

                                                        <li>
                                                            <a href="{{ route('admin.categories.update', $category->id) }}" 
                                                                class="edit_category"
                                                                data-id="{{$category->id}}"
                                                                data-parent_id="{{$category->parent_id}}"
                                                                data-name="{{$category->name}}"
                                                                >Edit</a>
                                                        </li>
                                                    </ul>
                                                </div> -->
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
                <h4 class="modal-title">Add Category</h4>
                <button type="button" class="btn-close close_modal" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <section class="create-category">
                    <form id="category_form" action="{{ route('admin.categories.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="parent_id_div">
                                        <label>Category Parent</label>
                                        <select name="parent_id" class="form-control" id="parent_id">
                                        <option value="0">No Parent</option>
                                        @foreach($parent_categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>

                                    </div>
                                    <label>Category Name</label>
                                    <input style="width:100%" type="text" class="form-control" required
                                        placeholder="Enter Your Category Name" name="name" value="">
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
                <button type="button" class="btn btn-danger close_modal" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script>
$(document).ready(function() {
    // alert('hjelosdf');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

$(".add_category").click(function(e) {
    var href = $(this).attr('data-href');

    $('input[name="id"]').val("");
    $('select[name="parent_id"]').val("0");
    $('input[name="name"]').val("");
    $('#category_form').attr('action', href);
    $('.modal-title').text('Add Category');
    $('.parent_id_div').hide();
});

$(".add_sub_category").click(function(e) {
    var href = $(this).attr('data-href');

    $('input[name="id"]').val("");
    $('select[name="parent_id"]').val("0");
    $('input[name="name"]').val("");
    $('#category_form').attr('action', href);
    $('.modal-title').text('Add Sub Category');
    $('.parent_id_div').show();
});

    $(".delete_category").click(function(e) {
        e.preventDefault();
        var href = $(this).attr('href');
        var id = $(this).attr('data-id');

        $.ajax({
            type: 'POST',
            url: href,
            data: {
                id: id
            },
            success: function(data) {
                successtoast(data.success);
            }
        });
    });

    $(".edit_category").click(function(e) {
        e.preventDefault();
        var href = $(this).attr('href');
        var id = $(this).attr('data-id');
        var parent_id = $(this).attr('data-parent_id');
        var name = $(this).attr('data-name');
        $('.modal-title').text('Edit Category');

        $('input[name="id"]').val(id);
        $('select[name="parent_id"]').val(parent_id);
        // $('select option[value=8272]').attr('selected', '');
        $('input[name="name"]').val(name);
        $('#category_form').attr('action', href);
        $('#myModal').show();
    });

    $(".close_modal").click(function(e) {
        $('#myModal').hide();
    });
    // $(document).on("submit","#category_form",function(e) {
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