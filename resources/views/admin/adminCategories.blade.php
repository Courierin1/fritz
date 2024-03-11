@extends('layouts.admin.app')


@section('content')


<section class="content">
    <div class="container-fluid" >
        <div class="row">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Categories</h3>
                    </div>
                    <!-- /.box-header -->


                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="#"><button type="button" data-bs-toggle="modal" data-bs-target="#myModal"
                                        class="btn btn-primary pull-right">Add Category</button></a>
                                <br> <br>

                                <div class="table-responsive">
                                    <table id="example" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Category Name</th>
                                                <th>Actions </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>1</td>
                                                <td>name</td>
                                                <td>
                                                 <a href="#"><i class="fa-solid fa-pen-to-square" title="Edit"></i></a> 
                                             <a href="#"><i class="fa-solid fa-trash" title="Delete"></i></a>
                                                </td>
                                            </tr>


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
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <section class="create-category">
                    <form action="#" method="post">
                        <div class="row">
                            <input type="hidden" name="_token" value="">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Category Name</label>
                                    <input style="width:100%" type="text" class="form-control" required=""
                                        placeholder="Enter Your Category Name" name="category" value="">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info">Submit</button>
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




@endsection
