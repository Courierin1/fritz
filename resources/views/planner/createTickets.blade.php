@extends('layouts.planner.app')


@section('content')
<style>
    .d_none{
        display: none !important;
    }

</style>
<section class="content">

    <div class="container-fluid" id="ticket">
        <div class="row">


            <div class="col-md-12">
                @include('alerts')
                <form id="ticket"  method="POST" action="{{ route('user.create.event.tickets.post') }}">
                    @csrf
                    <div class="nav-tabs-custom">

                    <h3 class="box-title">Tickets</h3>

                        <ul class="nav nav-pills">
                            <li class="get_ticket_type {{old('ticket_type') ? ((old('ticket_type') == 'paid') ? 'active' : '') : 'active'}}" data-ticket="paid">
                                <a href="#paid" data-toggle="tab"
                                    aria-expanded="true">Paid</a>
                                <input type="hidden" name="ticket_type" class="tclass" value="{{old('ticket_type') ? old('ticket_type') : 'paid' }}">
                            </li>
                            <li class="get_ticket_type {{(old('ticket_type') == 'free') ? 'active' : ''}}" data-ticket="free"><a href="#free" data-toggle="tab"
                                    aria-expanded="false">Free</a></li>
                            <li class="get_ticket_type {{(old('ticket_type') == 'donation') ? 'active' : ''}}" data-ticket="donation"><a href="#donation" data-toggle="tab"
                                    aria-expanded="false">Donation</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="paid">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name*</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="name"
                                        value="{{ old('name') }}" placeholder="Ticket Name" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Available Quantity*</label>
                                    <input type="number" placeholder="Enter Quantity" name="available_quantity" min="1" required class="form-control"
                                        value="{{ old('available_quantity') }}" id="available_quantity" id="exampleInputEmail1">
                                </div>

                                <div class="form-group price {{ old('ticket_type') ? ((old('ticket_type') != 'paid') ? 'd_none' : '') : ''}}">
                                    <label for="exampleInputEmail1">Price*</label>
                                    <input type="text" class="form-control" name="price" id="price" step="1" min="1" pattern="^\d*(\.\d{0,2})?$"
                                        value="{{ old('price') }}" placeholder="$ 0.00">
                                </div>

                                <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label>Sale Starts*</label>
                                          <div class="input-group date">
                                              <input type="date" id="sale_start"
                                                  class="form-control pull-right" required
                                                  onchange="updatedate();"
                                                  min="{{date('Y-m-d')}}"
                                                  max="{{date('Y-m-d', strtotime($event->event_start))}}"
                                                  name="sale_start"
                                                  value="{{ old('sale_start') ?? date('m\d\Y') }}">
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="bootstrap-timepicker">
                                          <div class="form-group">
                                              <label>Start Time*</label>
                                              <div class="input-group">
                                                  <input type="time" id="sale_start_time" class="form-control"
                                                      required name="sale_start_time"
                                                      value="{{ old('sale_start_time') }}">
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                </div>
                                <div class="row mt-3 mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Sale Ends*</label>
                                            <div class="input-group date">

                                                <input type="date" id="sale_end" class="form-control pull-right"
                                                    required name="sale_end"
                                                    min="{{date('Y-m-d')}}"
                                                    max="{{date('Y-m-d', strtotime($event->event_start))}}"
                                                    value="{{ old('sale_end') }}">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="bootstrap-timepicker">
                                            <div class="form-group">
                                                <label>End Time*</label>
                                                <div class="input-group">
                                                    <input type="time" id="sale_end_time" class="form-control"
                                                        required name="sale_end_time"
                                                        value="{{ old('sale_end_time') }}">

                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" rows="3" name="description"
                                        placeholder="Tell attendees more about this ticket.">{{ old('description') }}</textarea>
                                </div>

                                <div class="form-group maxticket {{(old('ticket_type') == 'donation') ? 'd_none' : ''}}">
                                    <label for="exampleInputEmail1">Max Tickets Per Order(*)</label>
                                    <input type="number" class="form-control"
                                        min="1" placeholder="Max Tickets (10)"
                                        value="{{ old('max_ticket') }}"
                                        name="max_ticket" id="max_ticket">
                                </div>

                                <div class="form-group minticket {{(old('ticket_type') == 'donation') ? 'd_none' : ''}}">
                                    <label for="exampleInputEmail1">Min Tickets Per Order(*)</label>
                                    <input type="number" min="1" class="form-control"
                                        placeholder="Min Tickets(1)"
                                        value="{{ old('min_ticket') }}"
                                        name="min_ticket" id="min_ticket">
                                </div>
                                {{-- Available Quantity --}}
                            </div>

                        </div>
                        <!-- /.tab-content -->
                    </div>

                    <input type="hidden" name="event_id" value="{{ $event->id }}">

                    <div class="box-footer">
                        <button style="margin-top:3%;" type="submit" class="mt-5 pull-right" id="pop1"><i
                                class="fa-solid fa-arrow-right"></i></button>
                        <!-- <a href="{{route('user.edit.event.details', ['id' => $event->id])}}" style="margin-top:3%;" type="submit" class="mt-5 pull-left" id="pop1"><i class="fa-solid fa-arrow-left"></i></a> -->
                    </div>
                </form>
            </div>

        </div>

    </div>

    </div>
</section>

@endsection
@section('js')
<script>
    $(document).ready(function () {
        $(".ticket_show").removeAttr("disabled");
    });
</script>

<script>
    // function updatedate_start() {
    //     var firstdate = document.getElementById("start_date").value;
    //     document.getElementById("sale_start").value = "";
    //     document.getElementById("sale_start").setAttribute("max", firstdate);
    //     document.getElementById("sale_end_date_time").value = "";
    //     document.getElementById("sale_end_date_time").setAttribute("max", firstdate);
    // }
    // updatedate_start();


    function updatedate() {
        var firstdate = document.getElementById("sale_start").value;
        document.getElementById("sale_end").value = "";
        document.getElementById("sale_end").setAttribute("min", firstdate);
    }

    $(document).ready(function () {
        var val = "paid";
        $('.get_ticket_type').on('click', function () {
                $('.get_ticket_type').removeClass('active');
                $(this).addClass('active');
            var val = $(this).attr('data-ticket');
            $('.tclass').val(val);
            if (val == "free") {
                $('.price').addClass('d_none');
                $('.maxticket').removeClass('d_none');
                $('.minticket').removeClass('d_none');
                $('.saleschannel').removeClass('d_none');
            } else if (val == "donation") {
                $('.price').addClass('d_none');
                $('.maxticket').addClass('d_none');
                $('.minticket').addClass('d_none');
                $('.saleschannel').addClass('d_none');
            } else if (val == "paid") {
                $('.price').removeClass('d_none');
                $('.maxticket').removeClass('d_none');
                $('.minticket').removeClass('d_none');
                $('.saleschannel').removeClass('d_none');
            }
        });
    });
    $(document).on('keydown', 'input[pattern]', function(e) {
        var input = $(this);
        var oldVal = input.val();
        var regex = new RegExp(input.attr('pattern'), 'g');
        setTimeout(function() {
            var newVal = input.val();
            if (!regex.test(newVal)) {
                input.val(oldVal);
            }
        }, 0);
    });
    $(document).ready(function () {

        // $("input#max_ticket").keyup(function(){
        //     var minTicket = ($('#min_ticket').val() > 0)? parseInt($('#min_ticket').val()):1;
        //     var maxTicket = ($(this).val() > 0)? parseInt($(this).val()):1;
        //     var qty = ($('#available_quantity').val() > 0) ? parseInt($('#available_quantity').val()) : 1;
        //     if(maxTicket > qty){
        //         $('#pop1').prop('disabled', true);
        //         errortoast('Maximun Tickets can not be more than Available Tickets');
        //         console.log('Maximun Tickets can not be more than Available Tickets');
        //     }
        //     else if(minTicket > maxTicket){
        //         $('#pop1').prop('disabled', true);
        //         errortoast('Minimum Tickets can not be more than Maximun Tickets');
        //         console.log('Minimum Tickets can not be more than Maximun Tickets');
        //     }
        //     else{
        //         $('#pop1').prop('disabled', false);
        //         console.log('Minimum Tickets can not be more than Maximun Tickets');
        //     }
        // });
        // $("input#min_ticket").keyup(function(){
        //     var maxTicket = ($('#max_ticket').val() > 0)? parseInt($('#max_ticket').val()):1;
        //     var minTicket = ($(this).val() > 0)? parseInt($(this).val()):1;
        //     var qty = ($('#available_quantity').val() > 0) ? parseInt($('#available_quantity').val()) : 1;
        //     if(maxTicket > qty){
        //         $('#pop1').prop('disabled', true);
        //         errortoast('Maximun Tickets can not be more than Available Tickets');
        //         console.log('Maximun Tickets can not be more than Available Tickets');
        //     }
        //     else if(minTicket > maxTicket){
        //         $('#pop1').prop('disabled', true);
        //         errortoast('Minimum Tickets can not be more than Maximun Tickets');
        //         console.log('Minimum Tickets can not be more than Maximun Tickets');
        //     }
        //     else{
        //         $('#pop1').prop('disabled', false);
        //         console.log('Maximun Tickets can not be more than Available Tickets');
        //     }
        // });

        // var frst = document.querySelector("#available_quantity");
        // var secnd = document.querySelector("#max_ticket");
        // var para = document.createElement("p");
        // function blr() {
        //     var ab = frst.value;
        //     var vc = secnd.value;


        //     // if (ab == "" && vc == "") {
        //     //     para.textContent = "Please enter value in both.";
        //     //     document.body.appendChild(para);
        //     // }
        //     // if (vc >= ab) {
        //     //     alert('Maximun Tickets can not be greater than Available Tickets');
        //     // }
        // }
        // secnd.addEventListener("blur", blr);


        // $(function () {
        //     var dtToday = new Date();
        //     var month = dtToday.getMonth() + 1;
        //     var day = dtToday.getDate();
        //     var year = dtToday.getFullYear();
        //     if (month < 10)
        //         month = '0' + month.toString();
        //     if (day < 10)
        //         day = '0' + day.toString();

        //     var maxDate = year + '-' + month + '-' + day;

        //     // or instead:
        //     // var maxDate = dtToday.toISOString().substr(0, 10);
        //     $('#sales_start_date_time').attr('min', maxDate);
        //     $('#sale_end_date_time').attr('min', maxDate);
        // });
    });




    $('#ticket').submit(function(e){
        let ticket_type = $('input[name="ticket_type"]').val();
        let available_qty = parseInt($('input[name="available_quantity"]').val());
        let max_ticket = parseInt($('input[name="max_ticket"]').val());
        let min_ticket = parseInt($('input[name="min_ticket"]').val());

        if ($('input[name="sale_start"]').val() == $('input[name="sale_end"]').val()) {
            if ($('input[name="sale_start_time"]').val() > $('input[name="sale_end_time"]').val()) {
                e.preventDefault();
                errortoast('Sale start time must be less than sale end time.');
            }
        }
        else if (available_qty < 0 ) {
            e.preventDefault();
            errortoast('Invalid Available Quantity.');
            // console.log(available_qty);
        }
        else if (ticket_type != 'donation') {
            if (max_ticket < 0) {
                e.preventDefault();
                errortoast('Invalid Max Ticket.');
            }
            else if (min_ticket < 0) {
                e.preventDefault();
                errortoast('Invalid Min Ticket.');
            }
            else if (available_qty < max_ticket) {
                e.preventDefault();
                errortoast('Max ticket cannot be greater than available quantity.');
            }
            else if (max_ticket < min_ticket) {
                e.preventDefault();
                errortoast('Min ticket cannot be greater than Max Ticket.');
            }
        }
        // else if (ticket_type != 'donation') {
        //     if ( max_ticket < 1 ) {
        //         e.preventDefault();
        //         errortoast('Invalid Max Ticket.');
        //     }
        //     else if ( min_ticket < 1 ) {
        //         e.preventDefault();
        //         errortoast('Invalid Min Ticket.');
        //     }
        //     else if (available_qty < max_ticket) {
        //         e.preventDefault();
        //         errortoast('Max ticket cannot be greater than available quantity.');
        //     }
        //     else if (max_ticket < min_ticket) {
        //         e.preventDefault();
        //         errortoast('Min ticket cannot be greater than Max Ticket.');
        //     }
        // }
        // else if (available_qty > 50 || available_qty < 1 ) {
        //     e.preventDefault();
        //     errortoast('Invalid Available Quantity.');
        // }
        // else if (ticket_type != 'donation') {
        //     if (max_ticket > 50 || max_ticket < 1 ) {
        //         e.preventDefault();
        //         errortoast('Invalid Max Ticket.');
        //     }
        //     else if (min_ticket > 50 || min_ticket < 1 ) {
        //         e.preventDefault();
        //         errortoast('Invalid Min Ticket.');
        //     }
        //     else if (available_qty < max_ticket) {
        //         e.preventDefault();
        //         errortoast('Max ticket cannot be greater than available quantity.');
        //     }
        //     else if (max_ticket < min_ticket) {
        //         e.preventDefault();
        //         errortoast('Min ticket cannot be greater than Max Ticket.');
        //     }
        // }
    });

</script>


{{--

<script>
    $(document).ready(function () {
        $(".ticket_show").removeAttr("disabled");
    });
</script>

<script>


    function updatedate_start() {
        var firstdate = document.getElementById("start_date").value;
        document.getElementById("sales_start_date_time").value = "";
        document.getElementById("sales_start_date_time").setAttribute("max", firstdate);
        document.getElementById("sale_end_date_time").value = "";
        document.getElementById("sale_end_date_time").setAttribute("max", firstdate);
    }
    updatedate_start();

    function updatedate() {
        var firstdate = document.getElementById("sales_start_date_time").value;
        document.getElementById("sale_end_date_time").value = "";
        document.getElementById("sale_end_date_time").setAttribute("min", firstdate);
    }

    $(document).ready(function () {
        var val = "paid";
        $('.get_ticket_type').on('click', function () {
            var val = $(this).attr('data-ticket');
            $('.tclass').val(val);
            if (val == "free") {
                $('.price').addClass('d_none');
                $('.maxticket').removeClass('d_none');
                $('.minticket').removeClass('d_none');
                $('.saleschannel').removeClass('d_none');
            } else if (val == "donation") {
                $('.price').addClass('d_none');
                $('.maxticket').addClass('d_none');
                $('.minticket').addClass('d_none');
                $('.saleschannel').addClass('d_none');
            } else if (val == "paid") {
                $('.price').removeClass('d_none');
                $('.maxticket').removeClass('d_none');
                $('.minticket').removeClass('d_none');
                $('.saleschannel').removeClass('d_none');
            }
        });
    });
    $(document).on('keydown', 'input[pattern]', function(e) {
        var input = $(this);
        var oldVal = input.val();
        var regex = new RegExp(input.attr('pattern'), 'g');
        setTimeout(function() {
            var newVal = input.val();
            if (!regex.test(newVal)) {
                input.val(oldVal);
            }
        }, 0);
    });

    $(document).ready(function () {

        $("input#max_ticket").keyup(function(){
            var minTicket = ($('#min_ticket').val() > 0)? parseInt($('#min_ticket').val()):1;
            var maxTicket = ($(this).val() > 0)? parseInt($(this).val()):1;
            var qty = ($('#available_quantity').val() > 0) ? parseInt($('#available_quantity').val()) : 1;
            if(maxTicket > qty){
                $('#pop1').prop('disabled', true);
                errortoast('Maximun Tickets can not be more than Available Tickets');
                console.log('Maximun Tickets can not be more than Available Tickets');
            }
            else if(minTicket > maxTicket){
                $('#pop1').prop('disabled', true);
                errortoast('Minimum Tickets can not be more than Maximun Tickets');
                console.log('Minimum Tickets can not be more than Maximun Tickets');
            }
            else{
                $('#pop1').prop('disabled', false);
                console.log('Minimum Tickets can not be more than Maximun Tickets');
            }
        });
        $("input#min_ticket").keyup(function(){
            var maxTicket = ($('#max_ticket').val() > 0)? parseInt($('#max_ticket').val()):1;
            var minTicket = ($(this).val() > 0)? parseInt($(this).val()):1;
            var qty = ($('#available_quantity').val() > 0) ? parseInt($('#available_quantity').val()) : 1;
            if(maxTicket > qty){
                $('#pop1').prop('disabled', true);
                errortoast('Maximun Tickets can not be more than Available Tickets');
                console.log('Maximun Tickets can not be more than Available Tickets');
            }
            else if(minTicket > maxTicket){
                $('#pop1').prop('disabled', true);
                errortoast('Minimum Tickets can not be more than Maximun Tickets');
                console.log('Minimum Tickets can not be more than Maximun Tickets');
            }
            else{
                $('#pop1').prop('disabled', false);
                console.log('Maximun Tickets can not be more than Available Tickets');
            }
        });

    });
</script> --}}

@endsection
