@extends('layouts.admin.app')


@section('content')

<section class="content">
    <div class="container-fluid" id="evt-desh">
        <div class="row">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">

                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="box-title mb-5">Dashboard</h3>

                            </div>

                        </div>
                        <!-- /.box-header -->


                        <div class="box-body">
                           


                            <div class="row" id="admin-dash123">
                                <div class="col-md-3">

                                    <div class="event-detail">
                                        <img src="./assets/images/totalevents.png" alt="">
                                        <div class="det">
                                        <h3>Total Events</h3>
                                        <h4>656</h4>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="event-detail">
                                    <img src="./assets/images/PastEvents.png" alt="">
                                    <div class="det">
                                        <h3>Past Events</h3>
                                        <h4>656</h4>
                                        </div>
                                     
                                    </div>
                                </div>
                                <div class="col-md-3 cent">
                                    <div class="event-detail">
                                    <img src="./assets/images/current.png" alt="">
                                    <div class="det">
                                        <h3>Current Events</h3>
                                        <h4>656</h4>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-3">
                                    <div class="event-detail">
                                    <img src="./assets/images/Orders.png" alt="">
                                    <div class="det">
                                        <h3>Total Orders</h3>
                                     <h4>656</h4>
                                     </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <h3>Ticket Info</h3>
                                    <div class="table-responsive">
                                        <table id="example001" class="table table-hover">
                                            <thead>
                                                <tr class="round">
                                                    <th>Ticket Name</th>
                                                    <th>Ticket Type</th>
                                                    <th>Price</th>
                                                    <th>Sold</th>
                                                    <th>Status</th>
                                                    <th>End Sales</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <tbody>
                                
                                                                        
                                                                        
                                <tr class="odd">
<td class="sorting_1">
    <p> bizacow@mailinator.com </p>
</td>
<td>
    <p> paid </p>
</td>
<td>
    <p> $828.00 </p>
</td>
<td>
    <p> 0/747 </p>
</td>
<td>
    <p>On Sale</p>
</td>
<td>
    <p>Tue, Jul 26, 2022 11:54 PM</p>
</td>

</tr><tr class="even">
<td class="sorting_1">
    <p> ticket33 </p>
</td>
<td>
    <p> paid </p>
</td>
<td>
    <p> $25.00 </p>
</td>
<td>
    <p> 1/570 </p>
</td>
<td>
    <p>On Sale</p>
</td>
<td>
    <p>Wed, Jul 27, 2022 11:36 PM</p>
</td>

</tr></tbody>
                                              
                                            </tbody>






                                        </table>
                                    </div>
                                </div>
                            </div>


                           
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <h3>Recent Orders</h3>
                                    <div class="table-responsive">
                                        <table id="example00" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Order ID</th>
                                                    <th>Event Name</th>
                                                    <th>User Name</th>
                                                    <th>User Email</th>
                                                    <th>Tickets</th>
                                                    <th>Ticket Type</th>
                                                    <th>Payment Status</th>
                                                    <th>Subtotal</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            <tr class="odd">
                                            <td class="sorting_1">2000</td>
                                            <td>demo event</td>
                                            <td>mark wood</td>
                                            <td>mark@gmail.com</td>
                                            <td><i class="fa-solid fa-ticket"></i> 1</td>
                                            <td>paid</td>
                                            <td>paid</td>
                                            <td>$27</td>
                                            <td>$27</td>
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

@endsection