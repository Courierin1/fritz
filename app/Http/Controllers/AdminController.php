<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\{User, UserDetail,OrganizerFollower, ContactUs, EventCategory,Event,EventType,Order, RefundRequest,ContactOrganizer, OrderTicket, CompanySetting, Country,State,EventOrganizer,EventTraffic};
use Auth;
use Crypt;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Traits\CompanySettingTrait;
use Illuminate\Support\Facades\Response;

use Session;

class AdminController extends Controller
{
    use CompanySettingTrait;

    public function index(){
        $events=Event::all();

        return view('admin.events',compact('events'));
    }

    public function events(){
        $events=Event::all();

        return view('admin.events',compact('events'));
    }

    public function viewEvent($id)
    {
        $event=Event::where(['id' => $id])->firstOrFail();

        $checkFollower=OrganizerFollower::where([['organizer_id', $event->organizer_id], ['user_id', Auth::user()->id]])->first();
        $dt = Carbon::now()->toDateString();

        $userAccountSettings=UserDetail::where('user_id', Auth::user()->id)->first();
        return view('admin.viewEvent', compact('event','checkFollower','userAccountSettings'));
    }

    public function addDistribution($id)
    {
        $dist=UserDetail::where('user_id', $id)->first();
       return view('admin.edit_event_planner_distribution', compact('id', 'dist'));
    }

    public function insertDistribution(Request $request)
    {
        // dd($request);
       $dist= UserDetail::where('user_id', $request->user_id)->firstOrFail();

       if ($dist) {
           $dist->distribution = $request->distribution;
           $dist->save();
          // return redirect()->route('admin.event.planners');
       } else {
           UserDetail::create([
               'user_id' => $request->user_id,
               'distribution' => $request->distribution
           ]);
       }
       return redirect()->route('admin.event.planners')->with('success', 'Distribution updated successfully');
    }

    public function distribution($id)
    {
       $distribution=OrderTicket::where("event_id", $id)->first();
       $totalRevenue=OrderTicket::where("event_id", $id)->sum('ticket_price');
       $adminCommision=OrderTicket::where("event_id", $id)->sum('admin_commission');
       $distribution['events']=Event::where("id", $id)->first();
       // dd( $distribution['events']);
       return view('admin/distribution', compact('distribution','adminCommision','totalRevenue'));
    }

    public function viewSales($id)
    {
       $grossSales=0;
       $netSales=0;
       $profit=0;

       $totaleventOrders = OrderTicket::whereHas('event', function ($query) use ($id) {
           $query->where('event_planner_id',$id);
          })->count();
       $totaltickers = OrderTicket::whereHas('event', function ($query) use ($id) {
           $query->where('event_planner_id',$id);
          })->sum('no_of_tickets');
       $totalRevenue=OrderTicket::whereHas('event', function ($query) use ($id) {
           $query->where('event_planner_id',$id);
          })->sum('ticket_price');
       $chart =OrderTicket::whereHas('event', function ($query) use ($id) {
           $query->where('event_planner_id',$id);
          })
       ->selectRaw("sum(no_of_tickets) as count, CONCAT_WS('-',DAY(created_at),MONTH(created_at),YEAR(created_at)) as monthyear")
       ->groupBy('monthyear')
       ->get()->toArray();

       $events=Event::with('orderTickets')->where('event_planner_id',$id)->get();

       foreach($events as $net){
             if($net->orderTickets!=null){
                 foreach($net->orderTickets as $order){

                   // if($net->getEventPlanner['distribution']!=null){
                       // $profit+=$order['ticket_price']*($net->getEventPlanner['distribution']/100);
                       $profit+=$order['ticket_fee'];
                       // $netSales+= $order['ticket_price']-$order['ticket_price']*($net->getEventPlanner['distribution']/100);
                       $netSales+= $order['ticket_price']-$order['ticket_fee'];
                   // }
                   // else{

                   //         $grossSales+=$order['ticket_price'];
                   // }
               }
           }
       }

       // $netSales+=$grossSales;

       return view('admin/view_sales',compact('id', 'totalRevenue','totaleventOrders','totaltickers','chart','events','netSales','profit'));

    }

    public function AdminajaxSales(Request $request){
        $ticketsPurchased=0;
        $totalSales=0;
        $totaleventOrders=0;
        $totaltickets=0;
        $total_events=0;
        $netSales=0;
        $grossSales=0;
        $profit=0;
        $tickets=[];
        // try{
            $data=[];
            $events=Event::with(['orderTickets'])->where('event_planner_id', $request->event_planner_id);
            if($request->has('name') && $request->name!=''){
                $events->where('id',$request->name);
            }
            else{
                if($request->has('type')){
                    if($request->type=="Paid"){
                            $events->where('type','paid');
                    }
                    else if($request->type=="Free"){
                            $events->where('type','free');
                    }
                    else if($request->type=="Donation"){
                            $events->where('type','donation');
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
                $ticket=OrderTicket::query();
                $ticket->where('event_id', $event->id);
                $ticketsPurchased+= $ticket->sum('no_of_tickets');
                $totalSales+=$ticket->sum('ticket_price');
                $totaleventOrders += $ticket->count();
                $totaltickets += $ticket->sum('no_of_tickets');
                $checkingnet=$ticket->get();

                // foreach($event as $net){
                if($event->getEventOrderTickets!=null){
                    foreach($event->getEventOrderTickets as $order){
                        if ($order->order->order_status == 1 && $order->order->is_refunded == 0) {
                            // $profit+=$order['ticket_price']*($event->getEventPlanner['distribution']/100);
                            $profit+= $order['ticket_fee'];
                            // $netSales+= $order['ticket_price']-$order['ticket_price']*($event->getEventPlanner['distribution']/100);
                            $netSales+= $order['ticket_price']-$order['ticket_fee'];
                        }
                    }
                }
                $count++;
                $tickets = OrderTicket::where('event_id',$event->id)
            ->selectRaw("sum(no_of_tickets) as count, CONCAT_WS('-',DAY(created_at),MONTH(created_at),YEAR(created_at)) as monthyear")
            ->groupBy('monthyear')
            ->get()->toArray();

            }


            $netSales+=$grossSales;
            $data['status']=1;
            $data['tickets']=$tickets;
            $data['view']= view('planner.sales-ajax',compact('netSales','totalSales','totaleventOrders','totaltickets','profit'))->render();
            // $data['ticketsPurchased']=$ticketsPurchased;
            // $data['totalSales']=$totalSales;
            // $data['totaleventOrders']=$totaleventOrders;
            // $data['totaltickets']=$totaltickets;
            // $data['total_events']=$total_events;
            // $data['netSales']=$netSales;

            return $data;

        // }catch(\Exception $e){

        //     $data=[];
        //     $data['status']=0;
        //     $data['message']=$e;

        //     return $data;
        // }
    }


    public function eventPlanners(){
        $users = User::whereHas('roles', function($q) {
            $q->where('name', "User");
        })
        ->where('is_planner', 1)
        ->get();

        return view('admin.eventPlanner',compact('users'));
    }

    public function eventPlannerEvents($id)
    {
        $dt = Carbon::now()->toDateString();
        $user= User::where('id', $id)->firstOrFail();
        $UpComingEvents = Event::
         where('events.event_planner_id', $user->id)
        ->where('events.status', 1)
        ->where('events.event_end','>=', $dt)
        ->Leftjoin('order_tickets', 'events.id', '=', 'order_tickets.event_id')
        ->select('events.*', DB::raw('SUM(order_tickets.no_of_tickets) as total_tickets'))
        ->groupBy('events.id')
        ->get();

        $pastEvents = Event::
        where('events.event_planner_id', $user->id)
        ->where('events.status', 1)
        ->where('events.event_end','<', $dt)
        ->Leftjoin('order_tickets', 'events.id', '=', 'order_tickets.event_id')
        ->select('events.*', DB::raw('SUM(order_tickets.no_of_tickets) as total_tickets'))
        ->groupBy('events.id')
        ->get();
        return view('admin.event_planner_events', compact('user','UpComingEvents','pastEvents'));
    }

    public function showAdminParticipants($id)
    {
        $showEventTickets=OrderTicket::where('event_id', $id)->get();
        return view('admin/participants', compact('showEventTickets'));
    }



    public function users(){
        $users = User::whereHas('roles', function($q) {
            $q->where('name', "User");
        })
        ->where('is_planner', 0)
        ->get();

        return view('admin.user',compact('users'));
    }


    public function listUserQueires(){
        $user_queries = ContactUs::all();
        return view('admin.user-queries.list', compact('user_queries'));
    }

    public function showUserQueires($id){
        $user_query = ContactUs::find($id);
        return view('admin.user-queries.view', compact('user_query'));
    }

    public function orders(){
        $orders = Order::all();
        $users = User::whereHas('roles', function($q) {
            $q->where('name', "User");
        })->get();
        return view('admin.order', compact('orders','users'));
    }

    public function order($id){
        $orders = Order::with(['orderTickets'])->Join('order_tickets', 'order_tickets.order_id', '=', 'orders.id')
        // ->Join('events', function($q) {
        //     $q->on('order_tickets.event_id', '=', 'events.id')
        //     ->where('events.event_planner_id', Auth()->user()->id);
        // })
        ->where('orders.id', $id)
        ->where('orders.payment_status', 1)
        ->where('orders.order_status', 1)
        ->orderBy('orders.order_number','DESC')
        ->select('orders.*')
        ->groupBy('orders.id')
        ->get();

        return view('admin.eventOrders', compact('orders'));
    }

    public function orderDetail($id){
        try{
            $order=Order::find($id);
            $tickets=OrderTicket::whereOrderId($order->id)->get();
            return view('admin.order_details',compact('order','tickets'));

        }catch (\Exception $e){
            return back()->with('error', 'Something went wrong!');
        }

    }

    // public function orderDetail($id){
    //     try{
    //         $order=Order::find($id);
    //         $tickets=OrderTicket::whereOrderId($order->id)->get();
    //         return view('admin.order_details',compact('order','tickets'));

    //     }catch (\Exception $e){
    //         return back()->with('error', 'Something went wrong!');
    //     }

    // }

    public function ListRefundRequest() {
        $eventOrders=Order::with(['refundRequest'])
        ->Join('order_tickets', 'order_tickets.order_id', '=', 'orders.id')
        ->Join('events', 'events.id', '=', 'order_tickets.event_id')
        ->Join('refund_requests', function($join) {
            $join->on('refund_requests.order_id', '=', 'orders.id');
        })
        ->select('orders.*')
        ->groupBy('orders.id')
        ->get();

        return view('admin.refund_requests', compact('eventOrders'));
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

            return Response::json(['message'=> 'success', 'code' => 200 ]);

        }catch  (\Exception $e) {
            DB::rollback();
            return Response::json(['message'=> 'error' , 'code' => 400 ]);
        }
    }

    public function massEmailing () {
        return view('admin.email');
    }

    public function submitMassEmailing (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'reply_to' => 'required|email',
            'send_to' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withInput()->with('errors', $validator->errors());
        }

        try {
            $admin_details = User::findOrFail(Auth::user()->id);

            $user_type = 1;
            if ($request->get('send_to') == 'all_organizers') {
                $user_type = 1;
            }
            else if ($request->get('send_to') == 'all_users') {
                $user_type = 0;
            }

            $event_planners = User::where('is_planner', $user_type)->whereHas('roles', function($q) {
                                        $q->where('name', "User");
                                    })->get();

            // dd($admin_details, $event_planners->count());

            foreach($event_planners as $event_planner){
                $request_detail = [
                    'greeting' => 'Hi '.$event_planner->name . ',',
                    'from_email' => $admin_details->email,
                    'from_name' => $request->get('name'),
                    'reply_to' => 'For any query, please reply to this email: ' . $request->get('reply_to'),
                    'subject' => $request->get('subject'),
                    'message' => $request->get('message'),
                ];
                $event_planner->notify(new \App\Notifications\Admin1Notification( $request_detail));
            }
            // Notification::send($user_mails, new NotifyUsers($admin_details->email));

            return redirect()->route('admin.dashboard')->with('success', 'Mail Send Successfully');

        }catch (\Exception $e){

            return redirect()->back()->withInput()->with('error', 'Something went wrong');
        }

        return redirect()->back()->withInput()->with('error', 'No Attendees found');
    }

    public function eventCategories(){
        return view('admin.adminCategories');
    }

    public function subCategories(){

        return view('admin.subCategories');
    }

    public function eventTypes(){
        return view('admin.types');
    }

    public function getAllPublishedEventsForPie(){
        try{
            $paid=Event::where('ticket_type','paid')->where('status',1)->count();
            $donation=Event::where('ticket_type','donation')->where('status',1)->count();
            $free=Event::where('ticket_type','free')->where('status',1)->count();

            $data=[
                "paid" => $paid,
                "donation" => $donation,
            "free" => $free,
            "status" => 1,
            ];

            return $data;}
            catch(\Exception $e){
            $data=[
                "status" => 0,
                'message' => $e

            ];
            return $data;
            }
        }

    public function salesReport(){
        $netSales=0;
        $grossSales=0;
        $profit=0;
        $planners=Event::with(['orderTickets','user'])->distinct()->get('event_planner_id');

        $totaleventOrders = DB::table('orders')->where('is_refunded', 0)->where('order_status', 1)->count();
       $totaltickets = DB::table('order_tickets')->Join('orders', function ($query) {
                                                    $query->on('orders.id', '=', 'order_tickets.order_id')
                                                    ->where('orders.payment_status','1')
                                                    ->where('orders.is_refunded', 0)
                                                    ->where('orders.order_status',1);
                                                })
                                                ->sum('order_tickets.no_of_tickets');
       $totalRevenue=OrderTicket::Join('orders', function ($query) {
                                    $query->on('orders.id', '=', 'order_tickets.order_id')
                                    ->where('orders.payment_status','1')
                                    ->where('orders.is_refunded', 0)
                                    ->where('orders.order_status',1);
                                })
                                ->sum('order_tickets.ticket_price');
        $targetSales=Event::sum('available_quantity');
        $events=Event::all();

        $checkingnet=Event::with('orderTickets')->get();
        $paid=Event::where('ticket_type','paid')->count();
        $donation=Event::where('ticket_type','donation')->count();
        $free=Event::where('ticket_type','free')->count();
        $gross=OrderTicket::Join('orders', function ($query) {
                            $query->on('orders.id', '=', 'order_tickets.order_id')
                            ->where('orders.payment_status','1')
                            ->where('orders.is_refunded', 0)
                            ->where('orders.order_status',1);
                        })
                        ->sum('order_tickets.ticket_price');
        foreach($checkingnet as $net){
            foreach($net->orderTickets as $order){
                if ($order->order->order_status == 1 && $order->order->is_refunded == 0) {
                    $netSales+= $order['ticket_price']-$order['ticket_fee'];
                    $profit+= $order['ticket_fee'];
                }
            }
        }

        $users=DB::table('orders')->where('is_refunded', 0)->where('order_status', 1)->distinct()->get('user_id')->count();
        $chart = DB::table('event_traffic')
        ->selectRaw("count(event_id) as count, CONCAT_WS('-',DAY(created_at),MONTH(created_at),YEAR(created_at)) as monthyear")
        ->groupBy('monthyear')
        ->get()->toArray();
        return view('admin.salesReport',compact('planners','totalRevenue','totaltickets','totaleventOrders','users','targetSales','events','netSales','paid','donation','free','chart','profit'));
    }

    public function ajaxSales(Request $request){
        try{

            $netSales=0;
            $grossSales=0;
            $profit=0;
            $data=[];
            $totaleventOrders = OrderTicket::whereHas('event', function ($query) use ($request) {
                $query->where('event_planner_id',$request->id);
            })
            ->Join('orders', function ($query) {
                $query->on('orders.id', '=', 'order_tickets.order_id')
                ->where('orders.payment_status','1')
                ->where('orders.is_refunded', 0)
                ->where('orders.order_status',1);
            })
            ->count();
            $totaltickets = OrderTicket::whereHas('event', function ($query) use ($request) {
                $query->where('event_planner_id',$request->id);
            })
            ->Join('orders', function ($query) {
                $query->on('orders.id', '=', 'order_tickets.order_id')
                ->where('orders.payment_status','1')
                ->where('orders.is_refunded', 0)
                ->where('orders.order_status',1);
            })->sum('order_tickets.no_of_tickets');

            $totalRevenue=OrderTicket::whereHas('event', function ($query) use ($request) {
                $query->where('event_planner_id',$request->id);
            })
            ->Join('orders', function ($query) {
                $query->on('orders.id', '=', 'order_tickets.order_id')
                ->where('orders.payment_status','1')
                ->where('orders.is_refunded', 0)
                ->where('orders.order_status',1);
            })->sum('order_tickets.ticket_price');

            $targetSales=Event::where('event_planner_id',$request->id)->sum('available_quantity');
            $events=Event::where('event_planner_id',$request->id)->get();

            $checkingnet=Event::with('orderTickets')->where('event_planner_id',$request->id)->get();
            $paid=Event::where('ticket_type','paid')->where('event_planner_id',$request->id)->count();
            $donation=Event::where('ticket_type','donation')->where('event_planner_id',$request->id)->count();
            $free=Event::where('ticket_type','free')->where('event_planner_id',$request->id)->count();
            $gross=OrderTicket::whereHas('event', function ($query) use ($request) {
                $query->where('event_planner_id',$request->id);
            })
            ->Join('orders', function ($query) {
                $query->on('orders.id', '=', 'order_tickets.order_id')
                ->where('orders.payment_status','1')
                ->where('orders.is_refunded', 0)
                ->where('orders.order_status',1);
            })
            ->sum('order_tickets.ticket_price');

            foreach($checkingnet as $net){
                foreach($net->getEventOrderTickets as $order){
                    if ($order->order->order_status == 1 && $order->order->is_refunded == 0) {
                        $profit+=$order['ticket_fee'];
                        $netSales+= $order['ticket_price']-$order['ticket_fee'];
                    }
                }
            }
            $users=OrderTicket::whereHas('event', function ($query) use ($request) {
                $query->where('event_planner_id',$request->id);
            })
            ->Join('orders', function ($query) {
                $query->on('orders.id', '=', 'order_tickets.order_id')
                ->where('orders.payment_status','1')
                ->where('orders.is_refunded', 0)
                ->where('orders.order_status',1);
            })
            ->distinct()->count();

            $chart = EventTraffic::whereHas('event', function ($query) use ($request) {
            $query->where('event_planner_id',$request->id);
            })
            ->selectRaw("count(event_id) as count, CONCAT_WS('-',DAY(created_at),MONTH(created_at),YEAR(created_at)) as monthyear")
            ->groupBy('monthyear')
            ->get()->toArray();

            $data['status']=1;
            $data['users']=$users;
            $data['netSales']=$netSales;
            $data['totalRevenue']=$totalRevenue;
            $data['totaltickets']=$totaltickets;
            $data['totaleventOrders']=$totaleventOrders;
            $data['targetSales']=$targetSales;
            $data['events']=count($events);
            $data['paid']=$paid;
            $data['free']=$free;
            $data['donation']=$donation;
            $data['chart']=$chart;
            $data['profit']=$profit;

            return $data;

        }
        catch(\Exception $e){

            return $data=[
                "status" =>0,
                "message" => $e
            ];

        }

    }

            public function eventDashboard($id){
               try{
                $grossSales=0;
                $netSales=0;
                $net_profit=0;
                $event=Event::where('id', $id)->first();
                if(!empty($event)){}
                else{
                    return abort(404);
                    die();
                }

                $net_profit= OrderTicket::Join('orders', function ($query) {
                    $query->on('orders.id', '=', 'order_tickets.order_id')
                    ->where('orders.payment_status','1')
                    ->where('orders.is_refunded', 0)
                    ->where('orders.order_status',1);
                })
                ->where('order_tickets.event_id', $id)->sum('order_tickets.ticket_fee');

                $totalRevenue=OrderTicket::Join('orders', function ($query) {
                    $query->on('orders.id', '=', 'order_tickets.order_id')
                    ->where('orders.payment_status','1')
                    ->where('orders.is_refunded', 0)
                    ->where('orders.order_status',1);
                })
                ->where('order_tickets.event_id', $id)->sum('order_tickets.ticket_price');
                if($event->getEventOrderTickets!=null){
                    foreach($event->getEventOrderTickets as $order){
                        if ($order->order->order_status == 1 && $order->order->is_refunded == 0)
                            $netSales+= $order['ticket_price']-$order['ticket_fee'];

                    }
                }
                $ticketsPurchased= OrderTicket::Join('orders', function ($query) {
                    $query->on('orders.id', '=', 'order_tickets.order_id')
                    ->where('orders.payment_status','1')
                    ->where('orders.is_refunded', 0)
                    ->where('orders.order_status',1);
                })
                ->where('order_tickets.event_id', $id)->sum('order_tickets.no_of_tickets');
                $percentage=  (($ticketsPurchased ?? 0)/  ($event->available_quantity ?? 1)) * 100;
                $eventOrders=OrderTicket::Join('orders', function ($query) {
                    $query->on('orders.id', '=', 'order_tickets.order_id')
                    ->where('orders.payment_status','1')
                    ->where('orders.is_refunded', 0)
                    ->where('orders.order_status',1);
                })
                ->where('order_tickets.event_id', $id)->take(10)->get();
                $chart = DB::table('order_tickets')
                    ->Join('orders', function ($query) {
                        $query->on('orders.id', '=', 'order_tickets.order_id')
                        ->where('orders.payment_status','1')
                        ->where('orders.is_refunded', 0)
                        ->where('orders.order_status',1);
                    })
                    ->where('order_tickets.event_id', $id)
                    ->selectRaw("sum(order_tickets.no_of_tickets) as count, CONCAT_WS('-',DAY(order_tickets.created_at),MONTH(order_tickets.created_at),YEAR(order_tickets.created_at)) as monthyear")
                    ->groupBy('monthyear')
                    ->get()->toArray();

                return view('admin.eventDashboard', compact('totalRevenue','percentage','net_profit', 'ticketsPurchased','eventOrders','event','chart','grossSales','netSales'));
            }
            catch(Exception $e) {
                return back()->with('error','Something went wrong!');

            }

            }

            public function listPlannerOrganizers($planner_id)
            {
                $organizers= EventOrganizer::where(['event_planner_id'=> $planner_id])->orderBy('id','DESC')->get();

                return view('admin.organizers.list', compact('organizers'));
            }

            public function showPlannerOrganizer($id)
            {
                $organizer= EventOrganizer::where('id', $id)->first();
                return view('admin.organizers.view', compact('organizer', 'id'));
            }

            public function viewOrganizer($id){

                $organizer=EventOrganizer::with('followers')->findOrFail($id);

                return view('admin.viewOrganizer', compact('organizer','id'));

             }


            public function deleteUser($id){

                try{
                $user=User::find($id);
                $user->delete();

                return back()->with('success','User Deleted Successfully!');
                }
                catch(\Exception $e){
                    return back()->with('error','Something Went Wrong!');
                }


            }

}
