<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\{User, OrganizerFollower,UserDetail, EventCategory,Event,EventType,Order,RefundRequest,ContactOrganizer, OrderTicket, CompanySetting, Country,State,EventOrganizer,EventLike,EventTraffic};
use Auth;
use Crypt;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Traits\CompanySettingTrait;

use Session;

use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Stripe\Checkout\Session  as Stripe_Session;

use Srmklive\PayPal\Services\ExpressCheckout;

class UserController extends Controller
{
    use CompanySettingTrait;

    public $provider;

    public function __construct()
    {
        // $this->middleware('auth');

        $this->provider = new  ExpressCheckout;
    }

    public function index(){
        $dt = Carbon::now()->toDateString();
        $totalEvents=Event::where('event_planner_id', Auth::user()->id)->where('status',1)->count();
        $UpComingEvents = DB::table('events')
        ->where('status', 1)
        ->where('event_planner_id', Auth::user()->id)
        ->where('event_end','>=', $dt)
        ->count();

        $pastEvents = DB::table('events')
        ->where('status', 1)
        ->where('event_planner_id', Auth::user()->id)
        ->where('event_end','<', $dt)
        ->count();

        $eventOrders=OrderTicket::whereHas('event', function ($query){
            $query->where('event_planner_id', Auth::user()->id);
           })
           ->groupBy('order_id')
           ->get();
        $totalOrders=$eventOrders->count();

        $tickets= DB::table('events')
        ->where('event_planner_id', Auth::user()->id)
        ->get();

        foreach( $tickets as  $key => $ticket)
        {
            $tickets[$key]=$ticket;
            $tickets[$key]->ticketsPurchased= OrderTicket::where('event_id', $ticket->id)->sum('no_of_tickets');
        }

        return view('planner.dashboard', compact('totalEvents','UpComingEvents','pastEvents','eventOrders','totalOrders','tickets'));
    }

    public function order(){
        $orders = Order::with(['orderTickets'])->Join('order_tickets', 'order_tickets.order_id', '=', 'orders.id')
        ->Join('events', function($q) {
            $q->on('order_tickets.event_id', '=', 'events.id')
            ->where('events.event_planner_id', Auth()->user()->id);
        })
        ->where('orders.payment_status', 1)
        ->where('orders.order_status', 1)
        ->orderBy('orders.order_number','DESC')
        ->select('orders.*')
        ->groupBy('orders.id')
        ->get();
        $users = User::whereHas('roles', function($q) {
            $q->where('name', "User");
        })->get();
        return view('planner.eventOrders', compact('orders','users'));
    }

    public function ListRefundRequest() {
        $user = Auth::user();
        $eventOrders=Order::with(['refundRequest'])
        ->Join('order_tickets', 'order_tickets.order_id', '=', 'orders.id')
        ->Join('events', function($join) use($user) {
            $join->on('events.id', '=', 'order_tickets.event_id')
            ->where('events.event_planner_id', $user->id);
        })
        ->Join('refund_requests', function($join) {
            $join->on('refund_requests.order_id', '=', 'orders.id');
        })
        ->select('orders.*')
        ->groupBy('orders.id')
        ->get();

        return view('planner.refund_requests', compact('eventOrders'));
    }

    public function UpdateRefundRequest(Request $request, $id) {
        DB::beginTransaction();
        try {
            $request_refund = RefundRequest::find($id);
            $order_ticket = Order::with(['orderTickets'])->find($request_refund->order_id);

            $is_refunded = 0;
            $refund_status = -1;
            $ticket_refunded = $request_refund->ticket_refunded;

            // if ($request_refund->accept_by_admin == -1 || $request_refund->accept_by_planner == -1) {
            //     $is_refunded = 0;
            //     $refund_status = -1;
            // }
            // elseif ($request_refund->accept_by_admin == 1 && $request_refund->accept_by_planner == 1) {
            //     $is_refunded = 1;
            //     $refund_status = 1;
            // }
            // elseif ($request_refund->accept_by_admin == 0 && $request_refund->accept_by_planner == 0) {
            //     $is_refunded = 0;
            //     $refund_status = 0;
            // }
            // elseif ($request_refund->accept_by_admin != -1 && $request_refund->accept_by_planner != -1) {
            //     $is_refunded = 0;
            //     $refund_status = 0;
            // }

            if ($request->status == -1) {
                $is_refunded = 0;
                $refund_status = -1;

                if ($ticket_refunded == 1) {
                    foreach($order_ticket->orderTickets as $order_event) {
                        $event = Event::find($order_event->event_id);
                        $event->update([
                            'available_quantity' => $event->available_quantity - $order_event->no_of_tickets
                        ]);
                    }
                    $ticket_refunded = 0;
                }
            }
            elseif ($request->status == 1) {
                $is_refunded = 1;
                $refund_status = 1;

                if ($ticket_refunded == 0) {
                    foreach($order_ticket->orderTickets as $order_event) {
                        $event = Event::find($order_event->event_id);
                        $event->update([
                            'available_quantity' => $event->available_quantity + $order_event->no_of_tickets
                        ]);
                    }
                    $ticket_refunded = 1;
                }
            }
            elseif ($request->status == 0) {
                $is_refunded = 0;
                $refund_status = 0;

                if ($ticket_refunded == 1) {
                    foreach($order_ticket->orderTickets as $order_event) {
                        $event = Event::find($order_event->event_id);
                        $event->update([
                            'available_quantity' => $event->available_quantity - $order_event->no_of_tickets
                        ]);
                    }
                    $ticket_refunded = 0;
                }
            }

            $order_ticket->update([
                'is_refunded' => $is_refunded,
                'refund_status' => $refund_status,
            ]);

            $request_refund->update([
                'accept_by_planner' => $request->status,
                'ticket_refunded' => $ticket_refunded,
            ]);

            DB::commit();

            return response()->json(['message'=> 'success', 'code' => 200 ]);

        }catch  (\Exception $e) {
            DB::rollback();
            return response()->json(['message'=> 'error' , 'code' => 400 ]);
        }
    }



    public function printInvoice(Request $request, $id) {

        $order = Order::findOrFail($id);

        // if ($order->getEvent->getEventTickets->eticket == 0) {
        //     abort(404);
        // }

        // return PDF::loadView('user.print_invoice', ['order' => $order])->inline('ticket.pdf');

        return view('site.print_invoice', ['order' => $order]);
    }


    public function userOrders()
    {
        $orders=Order::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('site.orders', compact('orders'));
    }

    // create
    public function createEvent(){
        $categories= EventCategory::whereNull('parent_id')->get();
        $types= EventType::all();
        $countries=Country::all();
        $states=State::all();
        return view('planner.createEvent',compact('categories', 'types' , 'countries', 'states'));
    }

    public function createEventDetails($id){
        $event=Event::find($id);
        return view('planner.details',compact('event'));

    }

    public function createEventTickets($id){
        $event=Event::find($id);
        return view('planner.createTickets',compact('event'));
    }

    public function publishEvent($id){
        $event=Event::find($id);
        return view('planner.publish',compact('event'));
    }

//update

public function updateEvent($id){
    $categories= EventCategory::whereNull('parent_id')->get();
    $sub_categories= EventCategory::whereNotNull('parent_id')->get();
    $types= EventType::all();
    $countries=Country::all();
    $states=State::all();
    $event=Event::find($id);
    return view('planner.editEvent',compact('categories', 'sub_categories', 'types' , 'countries', 'states','event'));
}

public function updateEventDetails($id){
    $event=Event::find($id);
    return view('planner.editDetails',compact('event'));

}

public function updateEventTickets($id){
    $event=Event::find($id);
    return view('planner.editTickets',compact('event'));
}

public function updatepublishEvent($id){
    $event=Event::find($id);
    return view('planner.editPublish',compact('event'));
}

    public function events(){
        $events=Event::where('event_planner_id',Auth()->user()->id)->get();
        return view('planner.events',compact('events'));
    }
    public function contactOrganizer(){
        return view('planner.contactOrganizers');
    }
    public function plannerAccountInformation(){
        $user_details=UserDetail::where('user_id', Auth::user()->id)->first();
        $countries=Country::all();
        $states=State::all();

        return view('planner.accountInformation', compact('countries','states','user_details'));
    }
    public function userAccountInformation(){
        $user_details=UserDetail::where('user_id', Auth::user()->id)->first();
        $countries=Country::all();
        $states=State::all();

        return view('site.profile', compact('countries','states','user_details'));
    }


    public function insertAccountSettings(Request $request)
    {
        try{
            $user_detail= UserDetail::where('user_id', Auth::user()->id)->first();
            $user_detail->user_id=Auth::user()->id;
            $user_detail->prefix=$request->prefix ?? null;
            $user_detail->first_name=$request->first_name ?? null;
            $user_detail->last_name=$request->last_name ?? null;
            $user_detail->suffix=$request->suffix ?? null;
            $user_detail->home_phone=$request->home_phone ?? null;
            $user_detail->cell_phone=$request->cell_phone ?? null;
            $user_detail->dob=$request->dob ?? null;
            $user_detail->job_title=$request->job_title ?? null;
            $user_detail->company=$request->company ?? null;
            $user_detail->website=$request->website ?? null;
            $user_detail->blog=$request->blog ?? null;
            $user_detail->home_address_one=$request->home_address_one ?? null;
            $user_detail->home_address_two=$request->home_address_two ?? null;
            $user_detail->home_address_city=$request->home_address_city ?? null;
            $user_detail->home_address_country=$request->home_address_country ?? null;
            $user_detail->home_address_zip_code=$request->home_address_zip_code ?? null;
            $user_detail->home_address_state=$request->home_address_state ?? null;
            $user_detail->billing_address_one=$request->billing_address_one ?? null;
            $user_detail->billing_address_two=$request->billing_address_two ?? null;
            $user_detail->billing_address_city=$request->billing_address_city ?? null;
            $user_detail->billing_address_country=$request->billing_address_country ?? null;
            $user_detail->billing_address_zip=$request->billing_address_zip ?? null;
            $user_detail->billing_address_state=$request->billing_address_state ?? null;
            $user_detail->shipping_address_one=$request->shipping_address_one ?? null;
            $user_detail->shipping_address_two=$request->shipping_address_two ?? null;
            $user_detail->shipping_address_city=$request->shipping_address_city ?? null;
            $user_detail->shipping_address_country=$request->shipping_address_country ?? null;
            $user_detail->shipping_address_zip=$request->shipping_address_zip ?? null;
            $user_detail->shipping_address_state=$request->shipping_address_state ?? null;
            $user_detail->work_address_one=$request->work_address_one ?? null;
            $user_detail->work_address_two=$request->work_address_two ?? null;
            $user_detail->work_address_city=$request->work_address_city ?? null;
            $user_detail->work_address_country=$request->work_address_country ?? null;
            $user_detail->work_address_zip=$request->work_address_zip ?? null;
            $user_detail->work_address_state=$request->work_address_state ?? null;
            if ($request->has('img')) {
                $image = $request->img;
                if ($image) {
                    $file_name = Auth::user()->id . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('assets/images/eventProfile'), $file_name);
                    $user_detail->img = 'assets/images/eventProfile/' . $file_name;
                }
            }
            $user_detail->save();
            return redirect()->back()->with('message', 'Profile has been updated!');
        }
        catch (\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function salesReport(){
        $grossSales=0;
        $netSales=0;
        $profit=0;

        $totaleventOrders = OrderTicket::Join('events', function ($query) {
                                $query->on('events.id', '=', 'order_tickets.event_id')
                                ->where('events.event_planner_id',Auth()->user()->id);
                            })
                            ->Join('orders', function ($query) {
                                $query->on('orders.id', '=', 'order_tickets.order_id')
                                ->where('orders.payment_status','1')
                                ->where('orders.is_refunded', 0)
                                ->where('orders.order_status',1);
                            })
                            ->select('order_tickets.*')
                            ->distinct('order_id')
                            ->count();

        $totaltickers = OrderTicket::whereHas('event', function ($query) {
                                        $query->where('event_planner_id',Auth()->user()->id);
                                    })
                                    ->Join('orders', function ($query) {
                                        $query->on('orders.id', '=', 'order_tickets.order_id')
                                        ->where('orders.payment_status','1')
                                        ->where('orders.is_refunded', 0)
                                        ->where('orders.order_status',1);
                                    })
                                    ->select('order_tickets.*')
                                    ->sum('no_of_tickets');

        $totalRevenue=OrderTicket::whereHas('event', function ($query) {
                                        $query->where('event_planner_id',Auth()->user()->id);
                                    })
                                    ->Join('orders', function ($query) {
                                        $query->on('orders.id', '=', 'order_tickets.order_id')
                                        ->where('orders.payment_status','1')
                                        ->where('orders.is_refunded', 0)
                                        ->where('orders.order_status',1);
                                    })
                                    ->select('order_tickets.*')
                                    ->sum('ticket_price');

        $chart =OrderTicket::whereHas('event', function ($query) {
            $query->where('event_planner_id',Auth()->user()->id);
           })
           ->Join('orders', function ($query) {
               $query->on('orders.id', '=', 'order_tickets.order_id')
               ->where('orders.payment_status','1')
               ->where('orders.is_refunded', 0)
               ->where('orders.order_status',1);
           })
        ->selectRaw("sum(order_tickets.no_of_tickets) as count, CONCAT_WS('-',DAY(order_tickets.created_at),MONTH(order_tickets.created_at),YEAR(order_tickets.created_at)) as monthyear")
        ->groupBy('monthyear')
        ->get()->toArray();

        $events=Event::with(['user', 'userDetail', 'orderTickets'])->where('event_planner_id',Auth()->user()->id)->get();

        foreach($events as $net){
              if($net->orderTickets!=null){
                  foreach($net->orderTickets as $order){
                    $profit+=$order['ticket_fee'];
                    $netSales+= $order['ticket_price']-$order['ticket_fee'];
                }
            }
        }
        return view('planner.salesReport',compact('totalRevenue','totaleventOrders','totaltickers','chart','events','netSales','profit'));
    }

    public function ajaxSales(Request $request){

        try{
            $ticketsPurchased=0;
            $totalSales=0;
            $totaleventOrders=0;
            $totaltickets=0;
            $total_events=0;
            $netSales=0;
            $grossSales=0;
            $profit=0;
            $tickets=[];
            $data=[];
            $events=Event::with(['user', 'userDetail', 'orderTickets'])
                            ->where('event_planner_id',Auth()->user()->id);

            if($request->has('name') && $request->name!=''){
                $events->where('id',$request->name);
            }
            else{
                if($request->has('type')){
                    if($request->type=="Paid"){
                        $events->where('ticket_type','paid');
                    }
                    else if($request->type=="Free"){
                        $events->where('ticket_type','free');
                    }
                    else if($request->type=="Donation"){
                        $events->where('ticket_type','donation');
                    }
                }
                if($request->has('start') && $request->start!=null){
                    $events->where('event_start', '>=',$request->start);
                }
                if($request->has('end') && $request->end!=null){
                    $events->where('event_end', '<=',$request->end);
                }
            }

            $check=$events->get();
            $count=0;
            $total_events=count($check);

            foreach($check as $event){
                $ticket=OrderTicket::Join('orders', function ($query) {
                    $query->on('orders.id', '=', 'order_tickets.order_id')
                    ->where('orders.payment_status','1')
                    ->where('orders.is_refunded', 0)
                    ->where('orders.order_status',1);
                })
                ->where('order_tickets.event_id', $event->id)
                ->select('order_tickets.*');

                $ticketsPurchased+= $ticket->sum('order_tickets.no_of_tickets');
                $totalSales+=$ticket->sum('order_tickets.ticket_price');
                $totaleventOrders += $ticket->count();
                $totaltickets += $ticket->sum('order_tickets.no_of_tickets');
                $checkingnet=$ticket->get();

                if($event->orderTickets!=null){
                    foreach($event->orderTickets as $order){
                        $profit+=$order['ticket_fee'];
                        $netSales+= $order['ticket_price']-$order['ticket_fee'];
                    }
                }

                $tickets = OrderTicket::where('event_id',$event->id)
                                        ->Join('orders', function ($query) {
                                            $query->on('orders.id', '=', 'order_tickets.order_id')
                                            ->where('orders.payment_status','1')
                                            ->where('orders.is_refunded', 0)
                                            ->where('orders.order_status',1);
                                        })
                                        ->selectRaw("sum(order_tickets.no_of_tickets) as count, CONCAT_WS('-',DAY(order_tickets.created_at),MONTH(order_tickets.created_at),YEAR(order_tickets.created_at)) as monthyear")
                                        ->groupBy('monthyear')
                                        ->get()->toArray();
            }

            $data['status']=1;
            $data['tickets']=$tickets;
            $data['view']= view('planner.sales-ajax',compact('netSales','totalSales','totaleventOrders','totaltickets','profit'))->render();

            return $data;

        }catch(\Exception $e){
            // dd($e);
            $data=[];
            $data['status']=0;
            $data['message']=$e;

            return $data;
        }
    }


    // public function analytics(){
    //     return view('planner.analyticEvent');
    // }

    public function analytics(){
        $allEvents=[];
        $events=Event::where('event_planner_id',Auth()->user()->id)->get();
        // $events = DB::table('events')
        //     ->where('events.user_id', Auth::user()->id)
        //     ->join('event_date_times', 'events.id', '=', 'event_date_times.event_id')
        //     ->leftJoin('event_tickets', 'events.id', '=', 'event_tickets.event_id')
        //     ->leftJoin('event_publishes', 'events.id', '=', 'event_publishes.event_id')
        //     ->select(
        //         'events.*',
        //         'event_date_times.event_start',
        //         'event_date_times.start_time',
        //         'event_tickets.available_quantity',
        //         'event_publishes.public',
        //     )->get();

        // $count=0;
        // foreach($events as $event){
        //     $allEvents[$count]=$event;
        //     $allEvents[$count]->ticketsPurchased= OrderTicket::where('event_id', $event->id)->sum('no_of_tickets');
        //     $allEvents[$count]->totalSales= $totalRevenue=OrderTicket::where("event_id", $event->id)->sum('ticket_price');
        //     $count++;
        // }
        return view('planner.analyticEvent',compact('events'));
    }

    public function ajaxAnalytics(Request $request){
        try{
            $data=[];
            if($request->days=="30"){
                if($request->report=="traffic"){
                    $data = DB::table('event_traffic')
                    ->selectRaw("count(*) as count, CONCAT_WS('-',DAY(created_at),MONTH(created_at),YEAR(created_at)) as monthyear")
                    ->where('event_id',$request->list)
                    ->where('created_at','>=',date('Y-m-d H:i:s',strtotime('-29 day')))
                    ->where('created_at', '<=', date('Y-m-d H:i:s'))
                    ->groupBy('monthyear')
                    ->get()->toArray();
                }
                else if($request->report=="attendees"){
                    $data = DB::table('order_tickets')
                    ->Join('orders', function ($query) {
                        $query->on('orders.id', '=', 'order_tickets.order_id')
                        ->where('orders.payment_status','1')
                        ->where('orders.is_refunded', 0)
                        ->where('orders.order_status',1);
                    })
                    ->selectRaw("sum(order_tickets.no_of_tickets) as count, CONCAT_WS('-',DAY(order_tickets.created_at),MONTH(order_tickets.created_at),YEAR(order_tickets.created_at)) as monthyear")
                    ->where('order_tickets.event_id',$request->list)
                    ->where('order_tickets.created_at','>=',date('Y-m-d H:i:s',strtotime('-29 day')))
                    ->where('order_tickets.created_at', '<=', date('Y-m-d H:i:s'))
                    ->groupBy('monthyear')
                    ->get()->toArray();
                }
                else if($request->report=="sales"){
                    $data = DB::table('order_tickets')
                    ->Join('orders', function ($query) {
                        $query->on('orders.id', '=', 'order_tickets.order_id')
                        ->where('orders.payment_status','1')
                        ->where('orders.is_refunded', 0)
                        ->where('orders.order_status',1);
                    })
                    ->selectRaw("sum(order_tickets.ticket_price) as count, CONCAT_WS('-',DAY(order_tickets.created_at),MONTH(order_tickets.created_at),YEAR(order_tickets.created_at)) as monthyear")
                    ->where('order_tickets.event_id',$request->list)
                    ->where('order_tickets.created_at','>=',date('Y-m-d H:i:s',strtotime('-29 day')))
                    ->where('order_tickets.created_at', '<=', date('Y-m-d H:i:s'))
                    ->groupBy('monthyear')
                    ->get()->toArray();
                }
            }
            else if($request->days=="60"){
                if($request->report=="traffic"){
                    $data = DB::table('event_traffic')
                    ->selectRaw("count(*) as count, CONCAT_WS('-',DAY(created_at),MONTH(created_at),YEAR(created_at)) as monthyear")
                    ->where('event_id',$request->list)
                    ->where('created_at','>=',date('Y-m-d H:i:s',strtotime('-59 day')))
                    ->where('created_at', '<=', date('Y-m-d H:i:s'))
                    ->groupBy('monthyear')
                    ->get()->toArray();
                }
                else if($request->report=="attendees"){
                    $data = DB::table('order_tickets')
                    ->Join('orders', function ($query) {
                        $query->on('orders.id', '=', 'order_tickets.order_id')
                        ->where('orders.payment_status','1')
                        ->where('orders.is_refunded', 0)
                        ->where('orders.order_status',1);
                    })
                    ->selectRaw("sum(order_tickets.no_of_tickets) as count, CONCAT_WS('-',DAY(order_tickets.created_at),MONTH(order_tickets.created_at),YEAR(order_tickets.created_at)) as monthyear")
                    ->where('order_tickets.event_id',$request->list)
                    ->where('order_tickets.created_at','>=',date('Y-m-d H:i:s',strtotime('-59 day')))
                    ->where('order_tickets.created_at', '<=', date('Y-m-d H:i:s'))
                    ->groupBy('monthyear')
                    ->get()->toArray();
                }
                else if($request->report=="sales"){
                    $data = DB::table('order_tickets')
                    ->Join('orders', function ($query) {
                        $query->on('orders.id', '=', 'order_tickets.order_id')
                        ->where('orders.payment_status','1')
                        ->where('orders.is_refunded', 0)
                        ->where('orders.order_status',1);
                    })
                    ->selectRaw("sum(order_tickets.ticket_price) as count, CONCAT_WS('-',DAY(order_tickets.created_at),MONTH(order_tickets.created_at),YEAR(order_tickets.created_at)) as monthyear")
                    ->where('order_tickets.event_id',$request->list)
                    ->where('order_tickets.created_at','>=',date('Y-m-d H:i:s',strtotime('-59 day')))
                    ->where('order_tickets.created_at', '<=', date('Y-m-d H:i:s'))
                    ->groupBy('monthyear')
                    ->get()->toArray();
                }
            }
            else if($request->days=="90"){
                if($request->report=="traffic"){
                    $data = DB::table('event_traffic')
                    ->selectRaw("count(*) as count, CONCAT_WS('-',DAY(created_at),MONTH(created_at),YEAR(created_at)) as monthyear")
                    ->where('event_id',$request->list)
                    ->where('created_at','>=',date('Y-m-d H:i:s',strtotime('-89 day')))
                    ->where('created_at', '<=', date('Y-m-d H:i:s'))
                    ->groupBy('monthyear')
                    ->get()->toArray();
                }
                else if($request->report=="attendees"){
                    $data = DB::table('order_tickets')
                    ->Join('orders', function ($query) {
                        $query->on('orders.id', '=', 'order_tickets.order_id')
                        ->where('orders.payment_status','1')
                        ->where('orders.is_refunded', 0)
                        ->where('orders.order_status',1);
                    })
                    ->selectRaw("sum(order_tickets.no_of_tickets) as count, CONCAT_WS('-',DAY(order_tickets.created_at),MONTH(order_tickets.created_at),YEAR(order_tickets.created_at)) as monthyear")
                    ->where('order_tickets.event_id',$request->list)
                    ->where('order_tickets.created_at','>=',date('Y-m-d H:i:s',strtotime('-89 day')))
                    ->where('order_tickets.created_at', '<=', date('Y-m-d H:i:s'))
                    ->groupBy('monthyear')
                    ->get()->toArray();
                }
                else if($request->report=="sales"){
                    $data = DB::table('order_tickets')
                    ->Join('orders', function ($query) {
                        $query->on('orders.id', '=', 'order_tickets.order_id')
                        ->where('orders.payment_status','1')
                        ->where('orders.is_refunded', 0)
                        ->where('orders.order_status',1);
                    })
                    ->selectRaw("sum(order_tickets.ticket_price) as count, CONCAT_WS('-',DAY(order_tickets.created_at),MONTH(order_tickets.created_at),YEAR(order_tickets.created_at)) as monthyear")
                    ->where('order_tickets.event_id',$request->list)
                    ->where('order_tickets.created_at','>=',date('Y-m-d H:i:s',strtotime('-89 day')))
                    ->where('order_tickets.created_at', '<=', date('Y-m-d H:i:s'))
                    ->groupBy('monthyear')
                    ->get()->toArray();
                }
            }

            return $res=[
                        "status"=>1,
                        "data"=>$data];
        }
        catch(\Exception $e){
                return $data=[
                    "status" => 0,
                    "message" => $e->getMessage()
                ];
        }
    }



    public function ajaxEvents(Request $request){
        try{
            $data=[];
            $events=Event::query();
            $events->where('event_planner_id',Auth()->user()->id);
            if($request->has('title') && $request->title!=''){
                $events->where('title','LIKE','%'.$request->title.'%');
            }
            else{
                if($request->has('days')){
                    if($request->days=="Past"){
                        // $events->whereHas('getEventDateNTime', function ($query) {
                        $events->where('event_end','<', date('Y-m-d'));
                        // });
                    }
                    else{
                        $request->days=="Draft"? $status=2 : $status=1;
                        $events->where('status',$status)
                        // ->whereHas('getEventDateNTime', function ($query) {
                            ->where('event_end','>=', date('Y-m-d'));
                        // });
                    }
                }
                if($request->has('list') && $request->list!=null){
                    $events->where('organizer_id',$request->list);
                }
            }
            $data['events']=$events->get();
            $data['status']=1;
            return $data;

        }catch(\Exception $e){

            $data=[];
            $data['status']=0;
            $data['message']=$e;

            return $data;
        }

    }
    public function eventCalendar(){
        $events=Event::where('event_planner_id',Auth()->user()->id)->get();
        $organizers=EventOrganizer::where('status',1)->get();
        return view('planner.eventCalendar',compact('events','organizers'));
    }



    public function profile($id){
        $decrypt= Crypt::decryptString($id);
        $user=EventOrganizer::find($decrypt);
        return view('site.userProfile',compact('user'));
    }

    public function getSubcategories(Request $request){
        try{

            $categories = EventCategory::whereParentId($request->id)->latest()->get();

            return $data=[
                "status" => 1,
                "res" => $categories,
                "message" => "Success"
            ];

        }catch(Exception $e){

            return $data=[
                "status" => 0,
                "message" => "Something went wrong!"
            ];

        }


    }


    public function logout()
    {
      if (Auth::check()) {
        Auth::logout();

        return redirect('home');
      } else {
        return redirect()->route('login');
      }
    }

    public function checkTicketAvailable(Request $request)
    {
        try{
            if($request->has('event_id') && $request->has('qty')) {
                $event=Event::with(['state', 'country'])->where(['id' => $request->event_id, 'status' => 1])->first();

                $tickets= Event::where('id',$request->event_id)->first();
                // $user_exist = Order::where('user_id', Auth::user()->id)->where('event_id', $request->event_id)->first();

                if (Auth::check() && isset($event) && isset($tickets) &&
                    Auth::id() != $event->event_planner_id && Carbon::parse($event->sale_start . ' ' . $event->sale_start_time) < Carbon::now() &&
                    Carbon::parse($event->sale_end . ' ' . $event->sale_end_time) > Carbon::now() &&
                    $tickets->available_quantity !=0 && $request->qty <= $tickets->available_quantity &&
                    ($tickets->ticket_type == 'donation' || ($request->qty >= $tickets->min_ticket &&
                    $request->qty <= $tickets->max_ticket))
                )
                {
                    if ($tickets->available_quantity >= $request->qty)
                        return (["message" => "Tickets Available", 'code' => 200, 'event' => $event]);
                    else
                        return (["message" => "Max limit reached!", 'code' => 400]);
                } else {
                    if (!Auth::check())
                        return (["message" => "Please Login First", 'code' => 400]);
                    if (!isset($event) && !isset($tickets))
                        return (["message" => "Bad Request", 'code' => 400]);
                    if(Auth::id() == $event->event_planner_id)
                        return (["message" => "Sorry, You can't purchase your own tickets", 'code' => 400]);
                    if(Carbon::parse($event->sale_start . ' ' . $event->sale_start_time) > Carbon::now())
                        return (["message" => "Sorry, Tickets will be available for purhcasing soon.", 'code' => 400]);
                    if(Carbon::parse($event->sale_end . ' ' . $event->sale_end_time) < Carbon::now())
                        return (["message" => "Sorry, Time has been passed to book a ticket.", 'code' => 400]);
                    if($tickets->available_quantity == 0)
                        return (["message" => "Sorry, No more tickets are available", 'code' => 400]);
                    if($request->qty > $tickets->available_quantity)
                        return (["message" => "Max limit reached!", 'code' => 400]);
                    if($tickets->ticket_type != 'donation' && $request->qty > $tickets->max_ticket)
                        return (["message" => "Max limit reached!", 'code' => 400]);
                    if($tickets->ticket_type != 'donation' && $request->qty < $tickets->min_ticket)
                      return (["message" => "Minimum limit reached!", 'code' => 400]);

                    return (["message" => "Something went wrong!", 'code' => 400]);
                }
            }
            else
                return (["message" => "Bad Request", 'code' => 400]);
        }
        catch (\Exception $e){
            return (["message" => "Something went wrong", 'code' => 500]);
        }
    }


    public function addToCart(Request $request) {
        // try{
          if ($request->has('event_id') && $request->has('qty')) {
            if (\Cart::session(Auth()->user()->id)->get($request->event_id) != null) {
              return response()->json(['message'=>'Ticket already exist in cart!', 'code' => 400]);
            }
            $event_details=Event::where(['id' => $request->event_id, 'status' => 1])->first();
            $request->qty = $event_details->min_ticket;

            $response = $this->checkTicketAvailable($request);
            // dd($this->checkTicketAvailable($request)['event']->total_quantity);

            if ($response['code'] == 200) {
              \Cart::session(Auth()->user()->id)->add(array(
                  'id' => $response['event']->id,
                  'name' => $response['event']->title,
                  'price' => ($response['event']->ticket_type == 'paid') ? $response['event']->price : 0,
                  'quantity' => $request->qty ?? 1,
                  'associatedModel' => $response['event']
              ));
              $quantity=\Cart::session(Auth()->user()->id)->getTotalQuantity();
              return response()->json(['message'=>'Ticket added to cart successfully!','quantity'=>$quantity, 'code' => 200]);
            } else {
              return response()->json(['message'=>$response['message'], 'code' => $response['code']]);
            }
          } else {
            return response()->json(['message'=>'Bad Request!', 'code' => 400]);
          }
        // }
        // catch(Exception $e){
        //     return response()->json(['message'=>'Something went wrong!', 'code' => 400]);
        // }
    }
    public function clearCart(){
        try{
            $items=\Cart::session(Auth()->user()->id)->getContent();
            // foreach($items as $row){
            //     $product=Product::whereProductId($row->id)->first();
            //     $product->in_stock+=$row->quantity;
            //     $product->update();
            // }
            \Cart::session(Auth()->user()->id)->clear();
            $view = view('site.ajax-cart')->render();
            return $data=['status'=>1,'message'=>'Success!','view'=>$view];
        }
        catch(Exception $e){
            return $data=['status'=>0,'message'=>'Something went wrong!'];
        }
    }
    public function minusQuantity(Request $request){
      try{
        if ($request->has('event_id') && $request->has('qty')) {
          $request->qty = \Cart::session(Auth()->user()->id)->get($request->event_id)->quantity - 1;

          $response = $this->checkTicketAvailable($request);

          if ($response['code'] == 200) {
            \Cart::session(Auth()->user()->id)->update($request->event_id, array(
                'quantity' => -1,
            ));
            $view = view('site.ajax-cart')->render();

            $quantity=\Cart::session(Auth()->user()->id)->getTotalQuantity();

            return $data=['message'=>'Success!','view'=>$view, 'code' => 200, 'quantity' => $quantity];
          } else {
            return response()->json(['message'=>$response['message'], 'code' => $response['code']]);
          }
        } else {
          return response()->json(['message'=>'Bad Request!', 'code' => 400]);
        }
      }
      catch(Exception $e){
          return response()->json(['message'=>'Something went wrong!', 'code' => 400]);
      }
    }
    public function plusQuantity(Request $request){
      try{
        if ($request->has('event_id') && $request->has('qty')) {
          $request->qty = \Cart::session(Auth()->user()->id)->get($request->event_id)->quantity + 1;

          $response = $this->checkTicketAvailable($request);

          if ($response['code'] == 200) {
            \Cart::session(Auth()->user()->id)->update($request->event_id, array(
                'quantity' => 1,
            ));
            $view = view('site.ajax-cart')->render();

            $quantity=\Cart::session(Auth()->user()->id)->getTotalQuantity();

            return $data=['message'=>'Success!','view'=>$view, 'code' => 200, 'quantity' => $quantity];
          } else {
            return response()->json(['message'=>$response['message'], 'code' => $response['code']]);
          }
        } else {
          return response()->json(['message'=>'Bad Request!', 'code' => 400]);
        }
      }
      catch(Exception $e){
          return response()->json(['message'=>'Something went wrong!', 'code' => 400]);
      }
    }

    public function removeProduct(Request $request){
        try{
            if(\Cart::session(Auth()->user()->id)->get($request->id) != null) {
              \Cart::session(Auth()->user()->id)->remove($request->id);
              $view = view('site.ajax-cart')->render();
              return response()->json(['message'=>'Success!','view'=>$view, 'code' => 200]);
            }

            return response()->json(['message'=>'Bad Request!', 'code' => 400]);
        }
        catch(Exception $e){
          return response()->json(['message'=>'Something went wrong!', 'code' => 400]);
        }
    }

    public function cart() {
        return view('site.cart');
    }

    public function checkout() {
      if(\Cart::session(Auth()->user()->id)->isEmpty())
        return redirect()->route('cart');

        $items = \Cart::session(Auth()->user()->id)->getContent();
        $ticket_fee = 0;
        $grand_total = 0;
        foreach ($items as $item) {
            $event_details=Event::with(['state', 'country', 'organizer'])->where(['id' => $item->id, 'status' => 1])->first();

            $event_ticket_details= Event::where('id',$item->id)->first();

            $ticket_fee_percentage = $this->getKeyValue('TICKET_FEE_PERCENTAGE')->value; // get ticket fee percentage;
            $ticket_fee +=($event_details->ticket_type != 'paid') ? 0 : (round(floatval(($item->quantity *
                        $event_details->price) * $ticket_fee_percentage / 100), 2));

            $grand_total += ($event_details->ticket_type != 'paid') ? 0 : (round(floatval(($item->quantity *
                            $event_details->price) + (($item->quantity * $event_details->price) *
                            $ticket_fee_percentage / 100)), 2));
        }

      return view('site.checkout', ['ticket_fee' => $ticket_fee, 'grand_total' => $grand_total]);
    }

    public function paypal_success(Request $request)
    {
        $response = $this->provider->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            Session::flash('success_code','200');
            return redirect()->route('order_thanku');
        } else {
            return back();
        }

    }


    public function invoice_payment_type(Request $request)
    {
        $validation = Validator::make($request->all(), [
            // 'status' => "required",
            // 'event_id' => "required",
            // 'unitPrice' => "required",
            'first_name' => "required",
            'last_name' => "required",
            'email' => "required",
            'payment_type' => "required",
            // 'unitPrice' => "required",
            // 'ticket_fee_percentage' => "required",
            // 'ticket_fee' => "required",
            // 'total' => "required",
            // 'comission' => "required",
            'stripeToken' => "required_if:payment_type,==,credit",
        ]);

        if ($validation->fails()) {
            // dd('hello');
            return back()->withError($validation->errors()->first());
        }

        try{

            // Rollback if data not inserted properly
            // DB::beginTransaction();
            // DB::transaction(function () use ($request) {
                // $order_id = [];


                $order= new Order();
                $order->order_number= $this->getKeyValue('ORDER_NO')->value; // generate order number
                $order->user_id= Auth::user()->id;
                // $order->event_id= $event_details->id;
                // $order->no_of_tickets= $item->quantity;
                // $order->unit_price= ($event_details->ticket_type != 'paid') ? 0 : $event_details->price;
                $order->ticket_fee_percentage= $this->getKeyValue('TICKET_FEE_PERCENTAGE')->value; // get ticket fee percentage;
                // $order->total_ticket_fee= $ticket_fee;
                // $order->total_ticket_price= $grand_total;
                // $order->total_admin_comission= ($grand_total /100 ) * $event_details->organizer->distribution;
                // $order->total_organizer_comission= $grand_total - (($grand_total /100 ) * $event_details->organizer->distribution);
                $order->first_name= $request->first_name;
                $order->last_name= $request->last_name;
                $order->email= $request->email;
                $order->payment_method= $request->payment_type;
                $order->payment_status= '0';
                $order->order_status= 0;
                $order->save();

                // $order_id[] = $order->id;

                $order_number = intval($this->getKeyValue('ORDER_NO')->value) + 1;
                $this->setKeyValue('ORDER_NO', $order_number);

                Session::put('order_id',$order->id);

                $grand_total = 0;
                $items = \Cart::session(Auth()->user()->id)->getContent();
                foreach ($items as $item) {
                    $event_details=Event::with(['state', 'country', 'organizer'])->where(['id' => $item->id, 'status' => 1])->first();

                    $ticket_fee_percentage = $this->getKeyValue('TICKET_FEE_PERCENTAGE')->value; // get ticket fee percentage;

                    $grand_total += ($event_details->ticket_type != 'paid') ? 0 : (round(floatval(($item->quantity *
                                    $event_details->price) + (($item->quantity * $event_details->price) *
                                    $ticket_fee_percentage / 100)), 2));
                }

                $total21 =  round(floatval($grand_total),2);
                if ($total21 > 0.00) {
                    if($request->payment_type == 'credit') {
                        // $this->credit_pay($request, $total21);
                        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
                        $charge = $stripe->charges->create([
                            'amount' => $total21*100,
                            'currency' => 'usd',
                            'source' => $request->stripeToken, // obtained with Stripe.js
                            // "metadata" => ["order_id" => $order->id],
                            'description' => 'My First Test Charge (created for API docs at https://www.stripe.com/docs/api)'
                        ]);

                        if ($charge->status == 'succeeded')  {
                            Session::flash('success_code','200');
                            return redirect()->route('order_thanku');
                        }
                        else
                            return redirect()->back();
                    }
                    if($request->payment_type == 'stripe') {
                        // $this->stripe_pay($request, $total21);
                        Stripe::setApiKey(env('STRIPE_SECRET'));
                        $session = Stripe_Session::create([
                            'payment_method_types' => ['card'],
                            'line_items' => [[
                            'price_data' => [
                                'currency' => 'usd',
                                'product_data' => [
                                'name' => 'lorem',
                                'description' => 'lorem ipsum'
                                ],
                                'unit_amount' => $total21 * 100,
                            ],
                            'quantity' => 1,
                            ]],
                            'phone_number_collection' => [
                                'enabled' => false,
                            ],
                            'mode' => 'payment',
                            'payment_intent_data'  => [
                                'description' => 'Ticket Payment'
                                // 'metadata' => [
                                //     'ClientId'  => $invoice['id'],
                                //     'InvoiceId' => $invoice['invoice_no']. '-'. $invoice['order_code'],
                                // ]
                            ],
                            'customer_email' => Auth()->user()->email,
                            'client_reference_id' => Auth()->user()->id,
                            'success_url' => url('').'/stripe_success?session_id={CHECKOUT_SESSION_ID}',
                            'cancel_url' => route('stripe_cancel'),
                        ]);
                        return redirect()->to($session->url);
                    }
                    if($request->payment_type == 'paypal') {
                        $data = [];
                        $data['items'] = [
                            [
                                'name' => 'lorem ipsum',
                                'price' => $total21,
                                'desc'  => 'Description for lorem ipsum',
                                'qty' => 1
                            ]
                        ];

                        $data['invoice_id'] = 12345;
                        $data['invoice_description'] = "Order #123345 Invoice";
                        $data['return_url'] = route('paypal_success');
                        $data['cancel_url'] = route('paypal_cancel');
                        $data['total'] = $total21;

                        $response = $this->provider->setExpressCheckout($data);

                        return redirect($response['paypal_link']);
                    }
                } elseif ($total21 <= 0.00) {
                    if ($order) {
                        Session::flash('success_code','200');
                        return redirect()->route('order_thanku');
                    } else {
                        return redirect()->back()->with(['error' => 'Something went wrong']);
                    }
                }

            // });
        }
        catch (\Exception $e){
            // dd($e);
            return redirect()->back()->with(['error' => 'Something went wrong']);
        }
    }

    public function order_thanku() {
        if(Session::has('order_id') && Session::has('success_code') && Session::get('success_code') == '200') {
            $order = Order::find(Session::get('order_id'));

            $total_ticket_fee = 0;
            $total_ticket_price = 0;
            $total_admin_comission = 0;
            $total_organizer_comission = 0;

            $items = \Cart::session(Auth()->user()->id)->getContent();
            foreach ($items as $item) {
                $event_details=Event::with(['state', 'country', 'organizer', 'userDetail'])->where(['id' => $item->id, 'status' => 1])->first();

                $event_ticket_details= Event::where('id',$item->id)->first();

                $ticket_fee_percentage = $this->getKeyValue('TICKET_FEE_PERCENTAGE')->value; // get ticket fee percentage;
                $ticket_fee =($event_details->ticket_type != 'paid') ? 0 : (round(floatval(($item->quantity *
                            $event_details->price) * $ticket_fee_percentage / 100), 2));

                $grand_total = ($event_details->ticket_type != 'paid') ? 0 : (round(floatval(($item->quantity *
                                $event_details->price) + (($item->quantity * $event_details->price) *
                                $ticket_fee_percentage / 100)), 2));

                $organizer_comission = ($event_details->ticket_type != 'paid') ? 0 : ($grand_total - (($grand_total /100 ) * $event_details->userDetail->distribution));

                $admin_comission = ($event_details->ticket_type != 'paid') ? 0 : (($grand_total /100 ) * $event_details->userDetail->distribution);

                $order_ticket= new OrderTicket();
                $order_ticket->order_id= $order->id;
                $order_ticket->event_id= $event_details->id;
                $order_ticket->ticket_type= $event_details->ticket_type;
                $order_ticket->no_of_tickets= $item->quantity;
                $order_ticket->unit_price= ($event_details->ticket_type != 'paid') ? 0 : $event_details->price;
                $order_ticket->ticket_fee_percentage= $ticket_fee_percentage;
                $order_ticket->ticket_fee= $ticket_fee;
                $order_ticket->ticket_price= $grand_total;
                $order_ticket->admin_comission= $admin_comission;
                $order_ticket->organizer_comission= $organizer_comission;
                $order_ticket->save();

                $event_ticket_details->available_quantity= $event_ticket_details->available_quantity - $item->quantity;
                $event_ticket_details->save();


                $total_ticket_fee += $order_ticket->ticket_fee;
                $total_ticket_price += $order_ticket->ticket_price;
                $total_admin_comission += $order_ticket->admin_comission;
                $total_organizer_comission += $order_ticket->organizer_comission;
            }

            $order->update([
                'total_ticket_fee' => $total_ticket_fee,
                'total_ticket_price' => $total_ticket_price,
                'total_admin_comission' => $total_admin_comission,
                'total_organizer_comission' => $total_organizer_comission,
                'payment_status' => '1',
                'order_status' => 1,
            ]);


            \Cart::session(Auth()->user()->id)->clear();

            $order = Order::find(Session::get('order_id'));
            $user_detail = User::find(Auth::user()->id);
            $request_detail = [
                'greeting' => 'Hi '.$order->first_name . ' ' . $order->last_name . ',',
                'from_email' => env('MAIL_FROM_ADDRESS'),
                'from_name' => env('MAIL_FROM_NAME'),
                'reply_to' => 'For any query, please reply to this email: ' . env('MAIL_FROM_ADDRESS'),
                'subject' => "Order Completed",
                'message' => "Order Completed Successfully",
                'ticket_url' => route('print_invoice', ['id' => $order->id]),
            ];
            // $user_detail->notify(new \App\Notifications\OrderCompleteNotification( $request_detail));

            Session::forget('order_id');

            return view('site.thanku');
        }
        else
            return redirect()->route('home');
    }

    public function viewContactOrganizer(){
        $user = Auth::user();
        $contactOrganizers=ContactOrganizer::Join('event_organizers', function($join) use($user)
        {
            $join->on('event_organizers.id','=','contact_ogranizer.organizer_id')
            ->where('event_organizers.event_planner_id', $user->id);
        })
        ->select('contact_ogranizer.*')
        ->get();

        return view('planner.contactOrganizers', compact('contactOrganizers'));

    }

    public function checkLiked(Request $request)
    {
        try{
            if(Auth::check()){
        $checkForEvent = EventLike::where('event_id',$request->event_id)->where('user_id',Auth()->user()->id)->first();
        if(isset($checkForEvent)){
            EventLike::where('event_id',$request->event_id)->where('user_id',Auth()->user()->id)->delete();
            return $data=['status'=>1,'message'=>'Event Unliked Successfully!'];
        }
        else{
            $like=new EventLike;
            $like->event_id=$request->event_id;
            $like->user_id=Auth()->user()->id;
            $like->save();
            return $data=['status'=>1,'message'=>'Liked Successfully!'];
        }

    }
    else{
        return $data=['status'=>0,'message'=>'Please Login First!'];
    }
    }

    catch(Exception $e) {
        return $data=['status'=>0,'message'=>'Something Went Wrong!'];
    }

    }




    // public function stripe_pay(Request $request, $total_amount)
    // {
    //     Stripe::setApiKey(env('STRIPE_SECRET'));
    //     $session = Stripe_Session::create([
    //         'payment_method_types' => ['card'],
    //         'line_items' => [[
    //         'price_data' => [
    //             'currency' => 'usd',
    //             'product_data' => [
    //             'name' => 'lorem',
    //             'description' => 'lorem ipsum'
    //             ],
    //             'unit_amount' => $total_amount * 100,
    //         ],
    //         'quantity' => 1,
    //         ]],
    //         'phone_number_collection' => [
    //             'enabled' => false,
    //         ],
    //         'mode' => 'payment',
    //         'payment_intent_data'  => [
    //             'description' => 'Ticket Payment'
    //             // 'metadata' => [
    //             //     'ClientId'  => $invoice['id'],
    //             //     'InvoiceId' => $invoice['invoice_no']. '-'. $invoice['order_code'],
    //             // ]
    //         ],
    //         'customer_email' => Auth()->user()->email,
    //         'client_reference_id' => Auth()->user()->id,
    //         'success_url' => url('').'/stripe_success?session_id={CHECKOUT_SESSION_ID}',
    //         'cancel_url' => route('stripe_cancel'),
    //     ]);
    //     return redirect()->to($session->url);
    // }
    // public function stripe_success() {
    //     Session::flash('success_code','200');
    //     return redirect()->route('order_thanku');
    // }

    // public function stripe_cancel() {
    //     // return view('site.stripe_cancel');
    //     return redirect()->route('checkout')->with(['error' => 'Your payment is canceled.']);
    // }

    // public function paypal_pay(Request $request, $total_amount)
    // {
    //     $data = [];
    //     $data['items'] = [
    //         [
    //             'name' => 'lorem ipsum',
    //             'price' => $total_amount,
    //             'desc'  => 'Description for lorem ipsum',
    //             'qty' => 1
    //         ]
    //     ];

    //     $data['invoice_id'] = 12345;
    //     $data['invoice_description'] = "Order #123345 Invoice";
    //     $data['return_url'] = route('paypal_success');
    //     $data['cancel_url'] = route('paypal_cancel');
    //     $data['total'] = $total_amount;

    //     // $provider = new ExpressCheckout;

    //     $response = $this->provider->setExpressCheckout($data);

    //     // $response = $provider->setExpressCheckout($data, true);

    //     return redirect($response['paypal_link']);
    // }
    // public function paypal_cancel()
    // {
    //     return redirect()->route('checkout')->with(['error' => 'Your payment is canceled.']);
    // }


    // public function credit_pay(Request $request, $total_amount)
    // {
    //     // try{
    //         // Rollback if data not inserted properly
    //         // DB::transaction(function () use ($request) {
    //             $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    //             $charge = $stripe->charges->create([
    //                 'amount' => $total_amount*100,
    //                 'currency' => 'usd',
    //                 'source' => $request->stripeToken, // obtained with Stripe.js
    //                 // "metadata" => ["order_id" => $orderTickets->id],
    //                 'description' => 'My First Test Charge (created for API docs at https://www.stripe.com/docs/api)'
    //             ]);

    //             if ($charge->status == 'succeeded')  {
    //                 \Cart::session(Auth()->user()->id)->clear();
    //                 Session::flash('success_code','200');
    //                 return redirect()->route('order_thanku');
    //             }
    //             else
    //                 return redirect()->route('checkout');

    //     // }
    //     // catch (\Exception $e){
    //                 // return redirect()->back()->with(['error' => 'Something went wrong']);
    //     // }
    // }

    public function viewEvent($id){
            try{

                $event=Event::where(['id' => $id])->firstOrFail();
                $checkFollower=OrganizerFollower::where([['organizer_id', $event->organizer_id], ['user_id', Auth::user()->id]])->first();
                $dt = Carbon::now()->toDateString();
                return view('planner.view_event', compact('event','checkFollower'));

            }
            catch (\Exception $e){
                return back()->with('error', 'Something went wrong!');
            }
    }

    public function orderDetail($id){
        try{
            $order=Order::find($id);
            $tickets=OrderTicket::whereOrderId($order->id)->get();
            return view('planner.order_details',compact('order','tickets'));

        }catch (\Exception $e){
            return back()->with('error', 'Something went wrong!');
        }

    }


  public function editAdminPassword() {
    return view('admin.edit_password');
  }

  public function editUserPassword() {
    return view('site.edit_password');
  }

  public function editPlannerPassword() {
    return view('planner.edit_password');
  }
//   mannual order
  public function mannual_order(Request $request) {
    // dd($request->all());
    $validator = Validator::make($request->all(), [
        'qty' => 'required',
        'phone' => 'required',
        'email' => 'required',
        'lname' => 'required',
        'fname' => 'required',
      ]);
      if ($validator->fails()) {
        return back()->withInput()->withError($validator->errors()->first());
      }

      try {
        DB::beginTransaction();
        $user  = User::where('email',$request->email);
        if ($user->exists()) {
            $user = $user->first();
        }
        $user = $this->createUser($request);
        $order= new Order();
        $order->order_number= $this->getKeyValue('ORDER_NO')->value; // generate order number
        $order->user_id= $user->id;
        // $order->event_id= $event_details->id;
        // $order->no_of_tickets= $item->quantity;
        // $order->unit_price= ($event_details->ticket_type != 'paid') ? 0 : $event_details->price;
        $order->ticket_fee_percentage= $this->getKeyValue('TICKET_FEE_PERCENTAGE')->value; // get ticket fee percentage;
        // $order->total_ticket_fee= $ticket_fee;
        // $order->total_ticket_price= $grand_total;
        // $order->total_admin_comission= ($grand_total /100 ) * $event_details->organizer->distribution;
        // $order->total_organizer_comission= $grand_total - (($grand_total /100 ) * $event_details->organizer->distribution);
        $order->first_name= $request->fname;
        $order->last_name= $request->lname;
        $order->email= $request->email;
        $order->dob= $request->dob;
        $order->phone= $request->phone;
        $order->address= $request->address;
        $order->payment_method= "manual";
        $order->payment_status= '1';
        $order->order_status= 1;
        $order->save();
        $order_number = intval($this->getKeyValue('ORDER_NO')->value) + 1;
        $this->setKeyValue('ORDER_NO', $order_number);
        //

        $total_ticket_fee = 0;
        $total_ticket_price = 0;
        $total_admin_comission = 0;
        $total_organizer_comission = 0;

            $event_details=Event::with(['state', 'country', 'organizer', 'userDetail'])->where(['id' => $request->event_id, 'status' => 1])->first();

            $event_ticket_details= Event::where('id',$request->event_id)->first();

            $ticket_fee_percentage = $this->getKeyValue('TICKET_FEE_PERCENTAGE')->value; // get ticket fee percentage;
            $ticket_fee =($event_details->ticket_type != 'paid') ? 0 : (round(floatval(($request->qty *
                        $event_details->price) * $ticket_fee_percentage / 100), 2));

            $grand_total = ($event_details->ticket_type != 'paid') ? 0 : (round(floatval(($request->qty *
                            $event_details->price) + (($request->qty * $event_details->price) *
                            $ticket_fee_percentage / 100)), 2));

            $organizer_comission = ($event_details->ticket_type != 'paid') ? 0 : ($grand_total - (($grand_total /100 ) * $event_details->userDetail->distribution));

            $admin_comission = ($event_details->ticket_type != 'paid') ? 0 : (($grand_total /100 ) * $event_details->userDetail->distribution);

            $order_ticket= new OrderTicket();
            $order_ticket->order_id= $order->id;
            $order_ticket->event_id= $event_details->id;
            $order_ticket->ticket_type= $event_details->ticket_type;
            $order_ticket->no_of_tickets= $request->qty;
            $order_ticket->unit_price= ($event_details->ticket_type != 'paid') ? 0 : $event_details->price;
            $order_ticket->ticket_fee_percentage= $ticket_fee_percentage;
            $order_ticket->ticket_fee= $ticket_fee;
            $order_ticket->ticket_price= $grand_total;
            $order_ticket->admin_comission= $admin_comission;
            $order_ticket->organizer_comission= $organizer_comission;
            $order_ticket->save();

            $event_ticket_details->available_quantity= $event_ticket_details->available_quantity - $request->qty;
            $event_ticket_details->save();


            $total_ticket_fee += $order_ticket->ticket_fee;
            $total_ticket_price += $order_ticket->ticket_price;
            $total_admin_comission += $order_ticket->admin_comission;
            $total_organizer_comission += $order_ticket->organizer_comission;


        $order->update([
            'total_ticket_fee' => $total_ticket_fee,
            'total_ticket_price' => $total_ticket_price,
            'total_admin_comission' => $total_admin_comission,
            'total_organizer_comission' => $total_organizer_comission,
            'payment_status' => '1',
            'order_status' => 1,
        ]);
        // dd($user);

        DB::commit();

        return back()->withSuccess('Order successfully');
      }
      catch (\Exception $e) {
          DB::rollback();
          return back()->withError('Error! Something went wrong');
      }
  }

  public function updatePassword(Request $request)
  {
    // dd('sdf');
    $validator = Validator::make($request->all(), [
      'old_password' => 'required',
      'new_password' => 'required',
      'confirm_password' => 'required',
    ]);
    if ($validator->fails()) {
      return back()->withInput()->withError($validator->errors()->first());
    }

    try {
      DB::beginTransaction();

      if ($request->get('new_password')  == $request->get('confirm_password')) {
        $user = User::find(Auth::id());
        if (Hash::check($request->get('old_password'), $user->password)) {
            $user->password = Hash::make($request->get('new_password'));
            $user->update();
        } else {
          return back()->withInput()->withError('Password mismatch');
        }
      } else {
        return back()->withInput()->withError('Confirm Password not matched with new password');
      }

      DB::commit();

      return back()->withSuccess('Password reset successfully');
    }
    catch (\Exception $e) {
        DB::rollback();
        return back()->withError('Error! Something went wrong');
    }
  }

  public function createUser($data)
    {
         $user= User::create([
            'name' => $data['fname']." ".$data['lname'],
            'is_planner' => '0',
            'email' => $data['email'],
            'password' => Hash::make($data['phone']),
        ]);
        $userRole = config('roles.models.role')::where('name', '=', 'User')->first();
        $user->attachRole($userRole);
        $distribution = CompanySetting::where('key', 'DISTRIBUTION')->first();
        $ticket_id = rand().$user->id;
        User::where('id',$user->id)->update(['ticket_id' => $ticket_id]);
        UserDetail::create([
            'user_id' => $user->id,
            'distribution' => $distribution->value ?? '9',
            'first_name' => $data['fname'] ?? '',
            'last_name' => $data['lname'] ?? '',
            'dob' => $data['dob'] ?? '',
            'cell_phone' => $data['phone'] ?? ''
        ]);

        return $user;
    }

}
