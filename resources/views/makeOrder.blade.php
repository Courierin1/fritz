
<div class="modal" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Event Order </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <h4 >Event name: <span id="event_title"></span></h4>
                <p class="text-danger" id="error_msg"></p>
                <section class="create-category">
                    <form action="{{ route('mannual_order') }}" method="post">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="event_id" id="event_id" >
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Available Quantity</label>
                                    <input type="text" class="form-control" readonly  id="remain" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="number" class="form-control qty" required=""
                                        placeholder="Enter Quantity" name="qty"  id="qty" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input  type="text" class="form-control" required=""
                                        placeholder="Enter Your First Name" name="fname" id="fname" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input  type="text" class="form-control" required=""
                                        placeholder="Enter Your Last Name" name="lname" id="lname" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input  type="text" class="form-control" required=""
                                        placeholder="Enter Your Email" name="email" id="email" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone no</label>
                                    <input  type="text" class="form-control" required=""
                                        placeholder="Enter Your Phone no" name="phone" id="phone" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date of Birth</label>
                                    <input  type="date" class="form-control" placeholder="Enter Your DOB"    name="dob" id="dob_data" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input  type="text" class="form-control" required=""
                                        placeholder="Enter Your Address" name="address"  id="address" >
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
@section('js')
<script>
// html button
{{--
//  <a href="javascript:;"data-id="{{$event->id}}"
//     data-href="{{route('user.event.destroy')}}"
//     onclick="destroy(this)"><i class="fa-solid fa-trash"></i></a>
//     <a href="#" class="makeorder" data-id="{{ $event->id }}" data-name="{{ ucfirst($event->title) }}"
//     data-org="{{ $event->organizer->name }}" data-able="{{ $event->available_quantity }}"  data-bs-toggle="modal" data-bs-target="#myModal">
//     <i class="fa-solid fa-users" title="Make Orders"></i></a>
--}}

    $(document).ready(function () {
        document.getElementById('dob_data').max = new Date(new Date().getTime() - new Date().getTimezoneOffset() * 60000).toISOString().split("T")[0];

    $('.makeorder').on('click', function () {
                let id = $(this).data("id");
                let name = $(this).data("name");
                let org = $(this).data("org");
                let able = $(this).data("able");
                $("#event_id").val(id);
                $("#event_title").html(name);
                $("#remain").val(able);
                });
        $('#qty').on('keyup', function () {
            let val = parseInt($(this).val());
            let able = parseInt($("#remain").val());
            console.log(able>=val,able,val);
            if (able>=val) {

            } else {
                $("#qty").val(null);
                $("#error_msg").html("Limited ticket are available! So kindly check available quantity");
            }
        });
});
</script>
@endsection
