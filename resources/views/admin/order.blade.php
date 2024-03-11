@extends('layouts.admin.app')


@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Orders</h3>
                    </div>
                    <!-- /.box-header -->


                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4 ">
                                <select  class="form-select status mb-2"   id="ticket_sel">
                                <option value="">Select Ticket ID for Filter</option>
                                @foreach ( $users as $user )
                                    <option value="{{$user->ticket_id}}">{{$user->ticket_id}}</option>
                                @endforeach
                                </select>
                             </div>
                             <div class="col-md-3 ">
                                 <select  class="form-select status mb-2"   id="order_sel">
                                 <option value="">Select Order no for Filter</option>
                                 @foreach ( $orders as $order )
                                     <option value="{{$order->order_number}}">{{$order->order_number}}</option>
                                 @endforeach
                                 </select>
                              </div>
                              <div class="col-md-3 ">
                                  <select  class="form-select status mb-2"   id="payment_sel">
                                    <option value="">Select Payment for Filter</option>
                                    <option value="Manual">Manual</option>
                                    <option value="paypal">paypal</option>
                                  </select>
                               </div>

                              <div class="col-md-2 ">
                                <button class="btn btn-default mt-2" id="reset_btn" >Reset</button>
                             </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="example" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>User Ticket ID</th>
                                                <th>User Name</th>
                                                <th>User Email</th>
                                                <th>Payment Type</th>
                                                <th>Payment Status</th>
                                                <th>Subtotal</th>
                                                <th>Total</th>
                                                <th>Actions</th>
                                            </tr>

                                        </thead>


                                        <tbody>
                                            @foreach ( $orders as $order )
                                            <tr>
                                                <td>{{$order->order_number}}</td>
                                                <td>{{$order->user->ticket_id}}</td>
                                                <td>{{$order->first_name}} {{$order->last_name}}</td>
                                                <td>{{$order->email}}</td>
                                                <td>{{ucfirst($order->payment_method)}}</td>
                                                <td>{{($order->payment_status == 1) ? 'Paid' : 'UnPaid'}}</td>
                                                <td>{{number_format($order->total_ticket_price - $order->total_ticket_fee,2)}}</td>
                                                <td>{{number_format($order->total_ticket_price,2)}}</td>
                                                <td>
                                                    <a href="{{route('admin.order.detail',$order->id)}}"><i class="fa-solid fa-eye" title="View"></i></a>
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
    $(document).ready(function () {
 var oTable = $('#example').dataTable();

     $('select#payment_sel').change( function () {  oTable.fnFilter( this.value, 4 );  } );
     $('select#order_sel').change( function () {  oTable.fnFilter( this.value, 0 );  } );
     $('select#ticket_sel').change( function () {  oTable.fnFilter( this.value, 1 );  } );
//  $('#reset_btn').on("click", function () {
//     // Destroy the DataTable
//     oTable
//     .clear()
//     .draw();
// });
$('#reset_btn').on("click", function () {
    var oTable = $('#example').DataTable();
    oTable.search('').columns().search('').draw();
    // Clear the DataTable by removing all rows
    $('select#payment_sel').val('')
    $('select#order_sel').val('')
    $('select#ticket_sel').val('')
    // oTable.rows().remove().draw();
});
});

</script>
@endsection
@section("custom-js")
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
    $(function () {
        $('.toggle-class').change(function () {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var user_id = $(this).data('id');

            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/admin/accounts_status',
                data: {
                    'status': status,
                    'user_id': user_id
                },
                success: function (data) {
                    console.log(data.success)
                }
            });
        })
    })

</script>
@endsection
