<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{URL,Storage,Validator,Auth};
use App\{Event,User, EventOrganizer};

class EventController extends Controller
{
    public function insertEvent(Request $request)
    {

    $validator = Validator::make($request->all(), [
        'title' => "required",
        'organizer_id' => "required",
        'type_id' => "required",
        'category_id' => "required",
        'sub_category_id' => "required",
        'venue_name' => "required",
        'country' => "required",
        'state' => "required",
        'city' => "required",
        'zip' => "required",
        'location_get' => "required",
        'start_time' => "required",
        'event_start' => "required",
        'event_end' => "required",
        'end_time' => "required",
    ]);

    if ($request->event_start == $request->event_end) {
        if ($request->start_time > $request->end_time)
            return back()->withInput()->with('error', 'Event start time must be less than end time.');
    }
    if ($validator->fails()) {
        return back()->withInput()->with('errors', $validator->errors());
    } else {
        $event = new Event();
        $event->title = $request->title;
        $event->event_planner_id = Auth::user()->id;
        $event->organizer_id = $request->organizer_id;
        $event->type_id = $request->type_id;
        $event->category_id = $request->category_id;
        $event->sub_category_id = $request->sub_category_id;
        $event->location_type = $request->location_get;
        if($request->location_get== "venue")
        {
            if($request->address){
                $event->address = $request->address;
            }
            else{
                return redirect()->back()->withInput()->with('error', 'For venue you have to insert address');
            }
            $event->venue_name = $request->venue_name;
            $event->country_id = $request->country;
            $event->state_id = $request->state;
            $event->city = $request->city;
            $event->zipcode = $request->zip;
        }

        else if($request->location_get== "online-event")
        {
            if($this->valid_URL($request->url)){
                $event->url =  $request->url;
            }
            else{
                return redirect()->back()->withInput()->with('error', 'For online event you have to insert zoom link');
            }
            $event->venue_name = $request->venue_name;
            $event->country_id = $request->country;
            $event->state_id = $request->state;
            $event->city = $request->city;
            $event->zipcode = $request->zip;
        }


        $event->status = 2;



            $event->event_start = $request->event_start;
            $event->start_time = $request->start_time;
            $event->event_end = $request->event_end;
            $event->end_time = $request->end_time;
            $event->display_start_time = $request->has('display_start_time') ? 1 : 0;

            $event->display_end_time = $request->has('display_end_time') ? 1 : 0;
            $event->step=1;
            $event->save();
            $eventId=$event->id;

            $user_find = User::find(Auth::user()->id);
            $user_find->update([
                'is_planner' => 1,
            ]);

            return redirect()->route('user.create.event.details', ['id'=>  $eventId]);
    }
}

protected function valid_URL($url){
    return preg_match('%^(?:(?:https?|ftp)://)(?:\S+(?::\S*)?@|\d{1,3}(?:\.\d{1,3}){3}|(?:(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)(?:\.(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)*(?:\.[a-z\x{00a1}-\x{ffff}]{2,6}))(?::\d+)?(?:[^\s]*)?$%iu', $url);
}


public function updateEvent(Request $request)
{
    $validator = Validator::make($request->all(), [
        'title' => "required",
        'organizer_id' => "required",
        'type_id' => "required",
        'category_id' => "required",
        'sub_category_id' => "required",
        'venue_name' => "required",
        'country' => "required",
        'state' => "required",
        'city' => "required",
        'zip' => "required",
        'location_get' => "required",
        'start_time' => "required",
        'event_start' => "required",
        'event_end' => "required",
        'end_time' => "required",

    ]);

    if ($request->event_start == $request->event_end) {
        if ($request->start_time > $request->end_time)
            return back()->withInput()->with('error', 'Event start time must be less than end time.');
    }
    if ($validator->fails()) {
        return back()->withInput()->with('errors', $validator->errors());
    } else {
        try{
            $event = Event::findOrFail($request->event_id);

            $event->title = $request->title;
            $event->organizer_id = $request->organizer_id;
            $event->type_id = $request->type_id;
            $event->category_id = $request->category_id;
            $event->sub_category_id = $request->sub_category_id;
            $event->location_type = $request->location_get;
            if($request->location_get== "venue")
            {
                if($request->address){
                    $event->address = $request->address;
                }
                else{
                    return redirect()->back()->withInput()->with('error', 'For venue you have to insert address');
                }
                $event->venue_name = $request->venue_name;
                $event->country_id = $request->country;
                $event->state_id = $request->state;
                $event->city = $request->city;
                $event->zipcode = $request->zip;
            }

            else if($request->location_get== "online-event")
            {
                if($this->valid_URL($request->url)){
                    $event->url =  $request->url;
                }
                else{
                    return redirect()->back()->withInput()->with('error', 'For online event you have to insert zoom link');
                }
                $event->venue_name = $request->venue_name;
                $event->country_id = $request->country;
                $event->state_id = $request->state;
                $event->city = $request->city;
                $event->zipcode = $request->zip;
            }

            $event->status = 2;
            if($event->save()){
                // $eventDateTime= EventDateTime::where('event_id', $request->event_id)->first();
                // $event->event_id = $event->id;
                $event->event_start = $request->event_start;
                $event->start_time = $request->start_time;
                $event->event_end = $request->event_end;
                $event->end_time = $request->end_time;
                $event->display_start_time = $request->has('display_start_time') ? 1 : 0;

                $event->display_end_time = $request->has('display_end_time') ? 1 : 0;
                $event->save();
                $eventId=$event->id;
                return redirect()->route('user.edit.event.details', ['id'=>  $eventId]);
            }
        }
        catch (\Exception $e){
            dd($e);
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
}

public function insertEventDetails(Request $request)
{
    $validator = Validator::make($request->all(), [
        'image' => "required|image|max:10192",
        'summary' => "required",
        'details' => "required",
    ]);

    if ($validator->fails()) {
        return back()->withInput()->with('errors', $validator->errors());
    }
    else{
        try{
            $event = Event::find($request->event_id);
            $event->summary= $request->summary;
            $event->details= $request->details;
            $event->status = 2;
            if ($request->has('image')) {
                $image = $request->image;
                if ($image) {
                    $path = "public/eventImages/".Auth::user()->id.'/';
                    $image = self::storeImages(request()->file('image'), $path);
                    $event->image = $image;
                }
            }
            $event->step=2;
            $event->save();
            $eventId=$request->event_id;
            return redirect()->route('user.create.event.tickets', ['id'=>  $eventId]);
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
}

public function updateEventDetails(Request $request)
{
    $validator = Validator::make($request->all(), [
        'image' => "nullable",
        'summary' => "required",
        'details' => "required",
    ]);
    if ($validator->fails()) {
        return back()->withInput()->with('errors', $validator->errors());
    }
    else {
        try{
            $event = Event::findOrFail($request->event_id);
            $event->summary= $request->summary;
            $event->details= $request->details;
            $event->status = 2;
            if ($request->has('image')) {
                $image = $request->image;
                if ($image) {
                    $path = "public/eventImages/".Auth::user()->id.'/';
                    $image = self::storeImages(request()->file('image'), $path);
                    $event->image = $image;
                }
            }

            $event->save();
            $eventId=$request->event_id;
            return redirect()->route('user.edit.event.tickets', ['id'=>  $eventId]);
        }
        catch (\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

}

public function insertTicket(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ticket_type' => "required",
            'name' => "required",
            'available_quantity' => "required|numeric",
            'price' => "required_if:ticket_type,paid",
            'sale_start' => "required",
            'sale_start_time' => "required",
            'sale_end' => "required",
            'sale_end_time' => "required",
            'max_ticket' => "required_unless:ticket_type,donation",
            'min_ticket' => "required_unless:ticket_type,donation",
        ]);

    if ($request->sale_start == $request->sale_end) {
        if ($request->sale_start_time > $request->sale_end_time)
            return back()->withInput()->with('error', 'Sale start time must be less than sale end time.');
    }

        if ($validator->fails()) {
            return back()->withInput()->with('errors', $validator->errors());
        }

        try{
            $eventTicket = Event::find($request->event_id);
            $eventTicket->ticket_type = $request->ticket_type;
            $eventTicket->name = $request->name;
            $eventTicket->available_quantity = $request->available_quantity;
            $eventTicket->total_quantity = $request->available_quantity;
            if($request->ticket_type == "paid")
                $eventTicket->price = $request->price;
            else
                $eventTicket->price = null;

            if($request->ticket_type != "donation") {
                $eventTicket->max_ticket = $request->max_ticket;
                $eventTicket->min_ticket = $request->min_ticket;

            } else {
                $eventTicket->max_ticket = null;
                $eventTicket->min_ticket = null;
            }
            $eventTicket->sale_start = $request->sale_start;
            $eventTicket->sale_start_time = $request->sale_start_time;
            $eventTicket->sale_end = $request->sale_end;
            $eventTicket->sale_end_time = $request->sale_end_time;
            $eventTicket->ticket_description = $request->description;
            // $eventTicket->eticket = ($request->eTicket) ? 1:0;
            // $eventTicket->will_call = ($request->will_call) ? 1:0;
            $eventTicket->status = 2; // inactive
            $eventTicket->step=3;
            $eventTicket->save();
            $eventId=$request->event_id;

            return redirect()->route('user.create.event.publish', ['id'=>  $eventId]);
        }
        catch (\Exception $e){
            return redirect()->back()->withInput()->with('error', 'Something went wrong!');
        }
    }

    public function updateEventTickets(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ticket_type' => "required",
            'name' => "required",
            'available_quantity' => "required|numeric",
            'price' => "required_if:ticket_type,paid",
            'sale_start' => "required",
            'sale_start_time' => "required",
            'sale_end' => "required",
            'sale_end_time' => "required",
            'max_ticket' => "required_unless:ticket_type,donation",
            'min_ticket' => "required_unless:ticket_type,donation",
        ]);

    if ($request->sale_start == $request->sale_end) {
        if ($request->sale_start_time > $request->sale_end_time)
            return back()->withInput()->with('error', 'Sale start time must be less than sale end time.');
        }
        if ($validator->fails()) {
            return back()->withInput()->with('errors', $validator->errors());
        }

        try{
            $eventTicket = Event::find($request->event_id);
            $eventTicket->ticket_type = $request->ticket_type;
            $eventTicket->name = $request->name;
            $eventTicket->available_quantity = $request->available_quantity;
            $eventTicket->total_quantity = $request->available_quantity;
            if($request->ticket_type == "paid")
                $eventTicket->price = $request->price;
            else
                $eventTicket->price = null;

            if($request->ticket_type != "donation"){
                $eventTicket->max_ticket = $request->max_ticket;
                $eventTicket->min_ticket = $request->min_ticket;

            }else {
                $eventTicket->max_ticket = null;
                $eventTicket->min_ticket = null;

            }
            $eventTicket->ticket_description = $request->description;
            $eventTicket->status = $eventTicket->status;
            $eventTicket->sale_start = $request->sale_start;
            $eventTicket->sale_start_time = $request->sale_start_time;
            $eventTicket->sale_end = $request->sale_end;
            $eventTicket->sale_end_time = $request->sale_end_time;
            $eventTicket->ticket_description = $request->description;


            $eventTicket->save();
            $eventId=$request->event_id;
            return redirect()->route('user.edit.event.publish', ['id'=>  $eventId]);
        }
        catch (\Exception $e){
            dd($e);
            return redirect()->back()->withInput()->with('error', 'Something went wrong!');
        }
    }


    // public function editPublish($id)
    // {
    //     $event=Events::where('id', $id)->first();
    //     $eventTicket=EventTickets::where('event_id', $id)->first();
    //     $eventPublish=EventPublish::where('event_id', $id)->first();

    //     if (isset($eventPublish)) {
    //         return view('event_planer.edit_publish', compact('id','event','eventTicket','eventPublish'));
    //     } else {
    //         return redirect()->route('create_publish', compact('id', 'event','eventTicket'));
    //     }
    // }

    public function insertPublish(Request $request)
    {

        try{
            $event = Event::find($request->event_id);
            if($request->public == "public"){
                $event->update(['status' => 1]);
            }
            else{
                $event->update(['status' => 2]);
            }

            if ($request->has('event_form_type'))

            return redirect()->route('user.events')->with('success','Event Updated Successfully!');
            else
            return redirect()->route('user.events')->with('success','Event Created Successfully!');
        }
        catch (\Exception $e){
            dd($e);
            return redirect()->back()->with('error', 'Something went wrong!');
        }

    }


    public function destroy(Request $request)
    {
        try{
            $msg = '';
            $event=Event::find($request->get('id'));

            if($request->has('restore')) {
                $event=$event->delete();
                $msg = 'Restored';
            } else {
                $event=$event->delete();
                $msg = 'Deleted';
            }
            return response()->json(['code' => '200', 'success'=> 'Event '. $msg .' successfully!']);
        }
        catch (\Exception $e){
            return response()->json(['code' => '500','error'=> 'Something went wrong!']);
            // return redirect()->back()->with('error', 'Something went wrong!');
        }
    }


    function checkOrganizer() {

        if(Auth::check()) {
            $user = Auth::user();

            $organizers= EventOrganizer::where('status', 1)->where('event_planner_id', $user->id)->first();

            if ($organizers) {
                return response()->json(['message' => 'success', 'code' => '200']);
            } else {
                return response()->json(['message' => 'fail', 'code' => '200']);
            }
        }
        return response()->json(['message' => 'something went wrong', 'code' => '200']);
    }


    protected function storeImages($data, $path)
    {
        $file = $data;
        $orignalName = preg_replace('/[^A-Za-z0-9\-]/', '', $file->getClientOriginalName());
        $extension = $file->getClientOriginalExtension();
        $image_name = uniqid(pathinfo($orignalName,PATHINFO_FILENAME).'_').'.'.$extension;
        $file->storeAs($path,$image_name);
        return URL::to(Storage::url($path.$image_name));
    }
}
