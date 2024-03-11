<div class="col-md-3">

<div class="event-detail"
    style="border: 2px solid #2e6da4;margin-inline-end: 264px;padding: 13px;border-radius: 9px;">
    <h3>Gross Sales</h3>
    <h3>${{number_format($totalSales,2)}}</h3>
</div>

</div>
<div class="col-md-3">
<div class="event-detail"
    style="border: 2px solid #2e6da4;margin-inline-end: 264px;padding: 13px;border-radius: 9px;">
    <h3>Net Sales</h3>
    <p>Event Planner Profit (${{number_format($profit,2)}})</p>
    <h3>${{$netSales!=0 ? number_format($netSales,2) : number_format($totalSales,2)}}</h3>
</div>
</div>
<div class="col-md-3">
<div class="event-detail"
    style="border: 2px solid #2e6da4;margin-inline-end: 264px;padding: 13px;border-radius: 9px;">
    <h3>Tickets Sold</h3>
    <h3>{{$totaltickets}}</h3>
</div>

</div>

<div class="col-md-3">
<div class="event-detail"
    style="border: 2px solid #2e6da4;margin-inline-end: 264px;padding: 13px;border-radius: 9px;">
    <h3>Orders</h3>
    <h3>{{$totaleventOrders}}</h3>
</div>
</div>

