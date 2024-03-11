@extends('layouts.admin.app')


@section('content')


<section class="content">
    <div class="container-fluid" id="event1">
        <div class="row">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Types</h3>
                    </div>
                    <!-- /.box-header -->


                    <div class="box-body">
                        <div class="row" id="types0">
                            <div class="col-md-12">
                            <a href="#"><button  type="button" data-bs-toggle="modal" data-bs-target="#myModal12"
                                        class="btn btn-primary pull-right">Add Types</button></a>
                                <br> <br>
                               
                                <table id="example" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Type Name</th>
                                            <th>Actions </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      
                                        <tr>
                                            <td>1</td>
                                            <td>fill</td>
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

</section>








<div class="modal" id="myModal12">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Types</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
            <div class="box box-primary">
                    <div class="box-header with-border">
                        
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <form action="#" method="post">
                            <input type="hidden" name="_token" value="">                                                                                                                <section class="create-category">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Types</label>
                                            <input type="text" class="form-control" placeholder="Enter Type" required="" name="subcategory" value="">
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