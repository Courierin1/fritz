@extends('layouts.admin.app')


@section('content')



<section class="content">
    <div class="container-fluid" id="org-data">
        <div class="row">
            <div class="col-md-12">

                <div class="box-header with-border">
                    <h3 class="box-title">Organizers Profiles</h3>
                </div>
                <div style="padding-top: 20px;">

                </div>

                <div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                   
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example" class="table table-hover dataTable no-footer"
                                aria-describedby="example_info">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Followers</th>
                                        <th>Image</th>
                                        <th>Actions </th>
                                    </tr>
                                </thead>
                                <tbody>








                                    <tr class="odd">
                                        <td class="sorting_1">1</td>
                                        <td>Portia York</td>
                                        <td>0</td>

                                        <td> <img style="width: 10%;" class="img-rounded"
                                                src="https://staging74.yourdesigndemo.net/storage/organizerImages/1/downloadpng_62daed632da75.png"
                                                alt="User Avatar">
                                        </td>
                                        <td>
                                           <a href="{{route('view.organizer')}}"> <i class="fa-solid fa-eye" title="View"></i></a>
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




</section>



@endsection
