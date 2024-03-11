<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Event,EventType,ContactUs,Slider,State,EventOrganizer,EventCategory,EventTraffic,ContactOrganizer,Order,RefundRequest};
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }


    public function searchEvent(Request $request) {
        $events = collect();
        if(strlen($request->ser_text) > 2) {
            $events = Event::where('title', 'LIKE', '%'.$request->ser_text."%")->get();
        }
        $view = view('site.ajax-serach', compact('events'))->render();

        return $data=['message'=>'Success!','view'=>$view, 'code' => 200];
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = EventCategory::whereNull('parent_id')->get();
        $events=Event::where('status',1)->where('event_start','>=',date('Y-m-d H:i:s'))->latest()->take(10)->get();
        $sliders=Slider::where('status',1)->orderBy('order_no')->take(10)->get();
        $trending=Event::withCount('traffic')->where('status',1)->where('event_start','>=',date('Y-m-d H:i:s'))->orderByDesc('traffic_count')->take(3)->get();
        return view('site.home',compact('events', 'categories','trending',"sliders"));
    }

    public function events(){
        $states=State::all();
        $online=Event::where('status',1)->where('location_type','online-event')->where('event_start','>=',date('Y-m-d H:i:s'))->latest()->take(8)->get();
        $free=Event::where('status',1)->where('ticket_type','free')->where('event_start','>=',date('Y-m-d H:i:s'))->latest()->take(8)->get();
        $events=Event::where('status',1)->where('ticket_type','paid')->where('state_id',6)->where('event_start','>=',date('Y-m-d H:i:s'))->latest()->take(8)->get();
        $organizers=EventOrganizer::all();
        $donations=Event::where('status',1)->where('ticket_type','donation')->where('event_start','>=',date('Y-m-d H:i:s'))->latest()->take(8)->get();
        return view('site.events',compact('online','free','states','events','organizers','donations'));
    }

    public function eventDetails($id){

        $event = Event::find($id);
      //   dd($event->sale_start,
      //   $event->sale_start_time,
      //   Carbon::now()->subDays(10),
      //   Carbon::parse($event->sale_start . ' ' . $event->sale_start_time),
      //   Carbon::now()->subDays(10) >Carbon::parse($event->sale_start . ' ' . $event->sale_start_time)
      // );
        if(Auth::check()){
            $traffic=EventTraffic::updateOrCreate(['user_id'=>Auth()->user()->id,'event_id'=> $id]);
        }
        else {
            $traffic=EventTraffic::updateOrCreate(['user_id'=>request()->ip(),'event_id'=> $id]);
        }
        return view('site.eventDetails',compact('event'));
    }



    public function about(){
        return view('site.about');
    }
    public function contact(){
        return view('site.contact-us');
    }
    public function eventDetail(){
        return view('site.event-detail');
    }
    public function siteOrders(){
        if (!Auth::check())
            return redirect()->route('login');

        $orders=Order::with(['refundRequest'])->where('user_id',Auth()->user()->id)->get();
        return view('site.orders',compact('orders'));
    }

    public function refundRequest(Request $request, $id) {
        DB::beginTransaction();
        try {
            $request_refund = RefundRequest::create([
                'order_id' => $request->id,
                'user_id' => Auth::user()->id,
                'accept_by_planner' => -1,
                'accept_by_admin' => 1,
                'ticket_refunded' => 0,
            ]);

            Order::find($request_refund->order_id)->update([
                'is_refunded' => 0,
                'refund_requested' => 1,
                'refund_status' => -1,
            ]);
            DB::commit();
            return response()->json(['message'=> 'success', 'code' => 200 ]);

        } catch  (\Exception $e) {
            DB::rollback();
            return response()->json(['message'=> 'someting went wrong' , 'code' => 400 ]);
        }
    }

    public function contactUs(Request $request){
        try{

            $contact= new ContactUs;
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->phone = $request->phone;
            $contact->interest = $request->interest;
            $contact->message = $request->message;
            $contact->save();

            return $data=["status"=>1,"message"=>"Contacted Successfully!"];

        }
        catch(Exception $e){
            return $data=["status"=>0,"message"=>"Something went wrong!"];
        }

    }

    public function getEventByState(Request $request){
        try{
            $state=State::findOrFail($request->id);
            $events=Event::where('status',1)->where('state_id',$request->id)->where('event_start','>=',date('Y-m-d H:i:s'))->latest()->take(8)->get();
            $view=view('site.state_event',compact('events','state'))->render();
            return $data=['status' => 1, "message" => "Success", "view"=>$view];
        }
        catch (\Exception $e){
            dd($e);
            return $data=["status"=>0,"message"=>"Something went wrong!"];
        }
    }

    public function contactOrganizer(Request $request){
        try{
            $contact=new ContactOrganizer;
            $contact->organizer_id = $request->organizer_id;
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->reason = $request->reason;
            $contact->message = $request->message;
            $contact->save();
            return $data=["status"=>1,"message"=>"Contacted Successfully!"];
        }
        catch (\Exception $e){
            return $data=["status"=>0,"message"=>"Something went wrong!"];
        }
    }

    // public function siteOrders(){
    //     return view('site.order');
    // }

    public function siteProfile(){

        return view('site.profile');
    }

    public function ajaxGetEvents(Request $request){
        try{
            $now = Carbon::now();
            $weekStartDate = $now->startOfWeek()->format('Y-m-d H:i');
            $weekEndDate = $now->endOfWeek()->format('Y-m-d H:i');
            if($request->has('id')){
            $category=EventCategory::whereParentId($request->id)->get('id');
            $events=Event::where('category_id',$request->id)->orWhereIn('category_id',$category)->get();

            }
            if($request->has('key')){
                if($request->key=='event'){
                    $events=Event::where('status',1)->where('event_start','>=',date('Y-m-d H:i:s'))->latest()->take(10)->get();
                }
                else if($request->key=='you'){
                    $events=Event::withCount('traffic')->where('status',1)->where('event_start','>=',date('Y-m-d H:i:s'))->orderByDesc('traffic_count')->take(10)->get();
                }
                else if($request->key=='online'){
                    $events=Event::where('status',1)->where('location_type','online-event')->where('event_start',date('Y-m-d'))->latest()->take(10)->get();
                }
                else if($request->key=='today'){
                    $events=Event::where('status',1)->where('event_start',date('Y-m-d'))->latest()->take(10)->get();
                }
                else if($request->key=='week'){
                    $events=Event::where('status',1)->whereBetween('event_start', [$weekStartDate, $weekEndDate])->latest()->take(10)->get();
                }
                else if($request->key=='free'){
                    $events=Event::where('status',1)->where('ticket_type','free')->where('event_start','>=',date('Y-m-d H:i:s'))->latest()->take(10)->get();
                }


            }
            $view=view('site.ajax_event',compact('events'))->render();
            return $data=["status"=>1,"message"=>"Success!",'view'=>$view];

        }
        catch (\Exception $e){
            return $data=["status"=>0,"message"=>"Something went wrong!"];
        }
    }


    public function search(){
        $categories=EventCategory::where('status', 1)->whereNull('parent_id')->get();
        $event_types=EventType::all();
        $events=Event::where('status',1)->where('event_start','>=',date('Y-m-d H:i:s'))->latest()->take(10)->get();
        $min_event_price=Event::where('status',1)->where('event_start','>=',date('Y-m-d H:i:s'))->min('price');
        if ($min_event_price == null) {
            $min_event_price = 0;
        }
        $max_event_price=Event::where('status',1)->where('event_start','>=',date('Y-m-d H:i:s'))->max('price');
        if ($max_event_price == null) {
            $max_event_price = 1000;
        }

        return view('site.search',compact('categories','event_types', 'events', 'min_event_price', 'max_event_price'));
    }

    public function ajaxSearchEvents(Request $request){
        try{
            $data=[];
            $events=Event::query();
             if($request->has('name')) {
                $events->where('status',1)->where('title','LIKE','%'.$request->name.'%')->get();
            }
            else {
                $events->where('status',1);
                if(isset($request->ticket_type)){
                    $events->where('ticket_type',$request->ticket_type);
                }
                if(isset($request->event_type_id)){
                    $events->where('type_id',$request->event_type_id);
                }
                if(isset($request->sub_category)){
                    $events->where('sub_category_id',$request->sub_category);
                }
                elseif(isset($request->price)){
                    $events->where('price','<=',$request->price);
                }
            //  if(isset($request->end_price)){
            //     $events->where('price','<=',$request->end_price);
            //  }
                if(isset($request->from_date)){
                    $events->where('event_start', '>=',$request->from_date);
                }
                if(isset($request->to_date)){
                    $events->where('event_end', '<=',$request->to_date);
                }
                if(isset($request->category)){
                    $events->where('category_id',$request->category);
                }
            }

            $events=$events->get();
            $view=view('site.search_events',compact('events'))->render();

            return $data=["status"=>1,"message"=>"Success!",'view'=>$view];

        }
        catch (\Exception $e){

            return $data=["status"=>0,"message"=>"Something went wrong!"];
        }
    }

    public function subCategoryAjax(Request $request) {
        $sub_categories = null;
        if($request->has('category_id')) {
            $sub_categories = EventCategory::where('status', 1)->where('parent_id', $request->category_id)->get();
        }
        $view = view('site.sub_category_ajax', compact('sub_categories'))->render();

        return $data=["status"=>1,"message"=>"Success!",'view'=>$view];
    }

}
