<!DOCTYPE html>
<html>
<head>
<title>Ticket</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<style>
div#tic00 {
    border: 1px solid #ddd;
    padding: 20px 30px;
}
div#tic00 strong {
    color: #f068ed;
}

.image {
    margin: 15px;
    max-width: 100%;
    width: 170px;
    height: 170px;
    object-fit: cover;
}

.qr{
    text-align: center;
    margin: 30px 0px;
    width: 100%;
}

#card00 {
width: 50%;
margin: 25px;
border: 1px solid black;
}
section.ticket-sec h2 {
    text-transform: capitalize;
    font-weight: bold;
    color: #f068ed;
}
section.ticket-sec h4.order {
    color: #777;
    font-size: 20px;
}
</style>

</head>
<body>
    @foreach ($order->orderTickets as $order_ticket)
        @for($i=0;$i<=$order_ticket->no_of_tickets-1;$i++)

            <section class="ticket-sec">
            <div class="container" id="tic00">
                <div class="row">
                    <div class="col-md-9">
                        <h2>{{$order_ticket->event->title}}</h2>
                        <br>
                        <h4 class="font-weight-bold">{{ htmlspecialchars_decode($order_ticket->event->eventCategory->name) ?? '' }} ,</h4><h5>{{htmlspecialchars_decode($order_ticket->event->eventSubCategory->name) ?? '' }}</h5>
                        <br>
                        <h4><strong class="text-uppercase">{{ $order_ticket->event->venue_name ?? '' }}</strong></h4>
                        <p><strong class="text-uppercase">{{ $order_ticket->event->location_type ?? '' }}</strong>&nbsp;,
                        @if($order_ticket->event->address)
                        {{$order_ticket->event->address ?? '' }}, 
                        @endif
                        {{$order_ticket->event->country->name ?? '' }}, {{$order_ticket->event->state->name ?? '' }}, {{$order_ticket->event->zipcode ?? ''}}</p>
                        @if($order_ticket->event->link!=null){
                            <p>{{$order_ticket->event->link ?? '' }}</p>
                        }
                        @endif
                        <p><strong>From: {{ Carbon\Carbon::parse($order_ticket->event->event_start)->format('M, d, Y') }}
                                                    {{ ($order_ticket->event->display_start_time == 1) ? ' - ' . Carbon\Carbon::parse($order_ticket->event->start_time)->format('h:i a') : '' }}</strong> - <strong>To: {{ Carbon\Carbon::parse($order_ticket->event->event_end)->format('M, d, Y') }}
                                                    {{ ($order_ticket->event->display_end_time == 1) ? ' - ' . Carbon\Carbon::parse($order_ticket->event->end_time)->format('h:i a') : '' }}
                                                    </strong></p>

                        <h4 class="order">Order Information</h4>
        <p>Order <strong>#{{$order_ticket->order_number}}</strong>. Ordered by <strong>{{$order_ticket->first_name}} {{$order_ticket->last_name}}</strong> on {{date('M d,Y h:i A',strtotime($order_ticket->created_at))}}</p>
        <div class="qr">
                            @php
                                $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
                            @endphp

                            <img width='800' height="50" src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode(route('site.event.details',$order_ticket->event_id ?? '' ), $generatorPNG::TYPE_CODE_128)) }}">

                    </div>

                        </div>

                        <div class="col-md-3">


                        <img class="image" src="{{asset($order_ticket->event->image)}}">
                        <br>
                        
                        </div>
                </div>
                <div style="text-align: center">
        <small><strong>Ticket# {{$i+1}} of {{$order_ticket->no_of_tickets}}</strong></small> </div>
            </div>
            </section>

            <br/>
        @endfor
        @endforeach

<script>
    window.print();
</script>

</body>
</html>