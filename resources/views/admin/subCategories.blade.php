@extends('layouts.admin.app')


@section('content')

<section class="content">
    <div class="container-fluid" id="event1">
        <div class="row">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i style="font-size:30px;margin-right:10px;"
                                class="fab fa-first-order icoo"></i>Sub-Categories</h3>
                    </div>
                    <!-- /.box-header -->


                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">

                                <a href="#"><button type="button" data-bs-toggle="modal" data-bs-target="#myModal1"
                                        class="btn btn-primary pull-right">Add Sub-Category</button></a>
                                <br> <br>
                               
                                <div class="table-responsive">
                                    <table id="example" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Sub Category Name</th>
                                                <th>Parent Category</th>
                                                <th>Actions </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
                                            <tr>
                                                <td>1</td>
                                                <td>cat
                                                </td>
                                                <td>new
                                                </td>

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





<div class="modal" id="myModal1">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
            <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create Sub-Category</h3>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <form action="#" method="post">
                            <input type="hidden" name="_token" value="">                                                                                                                <section class="create-category">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Sub-Category Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Your Sub-Category Name" required="" name="subcategory" value="">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Select Parent Category</label>
                                            <select class="form-control" required="" name="category">
                                                                                               <option value="">1</option>
                                                                                               <option value="">1</option>
                                                                                               <option value="">1</option>
                                                                                          </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                </div>
                            </section>
                        </form>

                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>





@endsection
