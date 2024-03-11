<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EventOrganizer;
use App\Event;
use App\OrganizerFollower;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Auth;
use Validator;

class OrganizerController extends Controller
{
    public function list()
    {
        $organizers= EventOrganizer::where(['event_planner_id'=> Auth::User()->id])->orderBy('id','DESC')->get();

        return view('planner.organizers.list', compact('organizers'));
    }

    public function create()
    {

        return view('planner.organizers.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => "required",
            'tax_id' => "required",
            'address' => "required",
            'bank_name' => "required",
            'account_no' => "required",
            'routing_number' => "required",
            'account_type' => "required",
            'website' => "nullable|url",
            'img' => "required|image|max:10192",
            'bio' => "required|string",
            // 'description' => "string",
        ]);
        if ($validator->fails()) {
            return back()->withInput()->with('errors', $validator->errors());
        }

        try{
            $organizer=new EventOrganizer();
            $organizer->event_planner_id=Auth::user()->id;
            $organizer->name=$request->name;
            $organizer->tax_id=$request->tax_id;
            $organizer->address=$request->address;
            $organizer->bank_name=$request->bank_name;
            $organizer->account_no=$request->account_no;
            $organizer->routing_number=$request->routing_number;
            $organizer->account_type=$request->account_type;
            $organizer->website=$request->website ?? null;

            // Handle file Upload
            if($request->hasFile('img')){
                // file path
                $path = "public/organizer_images/".Auth::user()->id.'/';
                // Get filename with the extension
                // $filenameWithExt = $request->file('img')->getClientOriginalName();
                //Get just filename
                // $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->file('img')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore = time() . rand(1,200) . '.' . $extension;
                // Upload Image
                $upload_img = $request->file('img')->storeAs($path,$fileNameToStore);

                $organizer->image = $fileNameToStore;
            }
            $organizer->bio=$request->bio;
            $organizer->description=$request->description;

            $organizer->save();

            return redirect()->route('user.organizers.list')->with('success', 'Organizer Created Successfully!');
        }
        catch (\Exception $e){
            dd($e);
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function show($id)
    {
        $organizer= EventOrganizer::where('id', $id)->first();
        return view('planner.organizers.view', compact('organizer', 'id'));
    }

    public function edit($id)
    {
        $organizer= EventOrganizer::where('id', $id)->first();
        return view('planner.organizers.edit', compact('organizer', 'id'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => "required",
            'tax_id' => "required",
            'address' => "required",
            'bank_name' => "required",
            'account_no' => "required",
            'routing_number' => "required",
            'account_type' => "required",
            'website' => "nullable|url",
            'image' => "sometimes|image|max:10192",
            'bio' => "required",

        ]);

        if ($validator->fails()) {
            return back()->withInput()->with('errors', $validator->errors());
        } else {
                try{
                    $randomString = Str::random(3);
                    $organizer=EventOrganizer::find($request->organizer_id);
                    $organizer->event_planner_id=Auth::user()->id;
                    $organizer->name=$request->name;
                    $organizer->tax_id=$request->tax_id;
                    $organizer->address=$request->address;
                    $organizer->bank_name=$request->bank_name;
                    $organizer->account_no=$request->account_no;
                    $organizer->routing_number=$request->routing_number;
                    $organizer->account_type=$request->account_type;
                    $organizer->website=$request->website ?? null;

                    // Handle file Upload
                    if($request->hasFile('img')){
                        // file path
                        $path = public_path("storage/organizer_images/".Auth::user()->id.'/');

                        if($organizer->image != null && file_exists($path.$organizer->image)){
                            unlink($path.$organizer->image);
                        }
                        // Get filename with the extension
                        // $filenameWithExt = $request->file('img')->getClientOriginalName();
                        //Get just filename
                        // $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                        // Get just ext
                        $extension = $request->file('img')->getClientOriginalExtension();
                        // Filename to store
                        $fileNameToStore = time() . rand(1,200) . '.' . $extension;
                        // file path
                        $path = "public/organizer_images/".Auth::user()->id.'/';
                        // Upload Image
                        $upload_img = $request->file('img')->storeAs($path,$fileNameToStore);

                        $organizer->image = $fileNameToStore ;
                    }

                    $organizer->bio=$request->bio;
                    $organizer->description=$request->description ?? null;
                    $organizer->save();
                    return redirect()->route('user.organizers.list')->with('success', 'Organizer Updated Successfully!');
                }
                catch (\Exception $e){
                    return redirect()->back()->with('error', 'Something went wrong!');
                }
        }
    }

    public function destroy($id)
    {
        try{
            $organizer=EventOrganizer::find($id);
            $organizer->status = !$organizer->status;
            $organizer->save();
            $msg = $organizer->status ? 'Activated' : 'Deactivated';
            return response()->json(['code' => '200', 'success'=> 'Organizer '. $msg .' successfully!']);
        }
        catch (\Exception $e){
            return response()->json(['code' => '500','success'=> 'Organizer '. $msg .' successfully!']);
            // return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function followOrganizer(Request $request)
    {
        $followOrganizer= new OrganizerFollowers();
        $followOrganizer->user_id= Auth::user()->id;
        $followOrganizer->organizer_id= $request->organizer_id;
        $followOrganizer->save();
        return Response("success");
    }

    public function unFollowOrganizer(Request $request)
    {
        $followOrganizer=OrganizerFollowers::where('organizer_id',$request->organizer_id);
        $followOrganizer->delete();
        return Response("success");
    }

    public function checkFollower(Request $request)
    {
        $response="";
        $checkFollower=OrganizerFollower::where([['organizer_id', $request->organizer_id], ['user_id', Auth::user()->id]])->first();

        if($checkFollower == null)
        {
            $followOrganizer= new OrganizerFollower();
            $followOrganizer->user_id= Auth::user()->id;
            $followOrganizer->organizer_id= $request->organizer_id;
            $followOrganizer->save();

            return response()->json(['message' => 'Followed successfully', 'following' => '1', 'code' => 200]);
        }
        elseif($checkFollower != null){
            $followOrganizer=OrganizerFollower::where([['organizer_id', $request->organizer_id], ['user_id', Auth::user()->id]])->first();
            $followOrganizer->delete();

            return response()->json(['message' => 'Unfollowed successfully', 'following' => '0', 'code' => 200]);
        }

    }

    public function insertContactOrganizer(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => "required",
            'email' => "required|email",
            'contact_reason' => "required",
            'message' => "required|max:1000",

        ]);
        if ($validator->fails()) {
            return back()->with('errors', $validator->errors());
        } else {
            try{
                $contactOrganizer= new ContactOrganizers();
                $contactOrganizer->user_id=Auth::user()->id;
                $contactOrganizer->organizer_id=$request->organizer;
                $contactOrganizer->name=$request->name;
                $contactOrganizer->email=$request->email;
                $contactOrganizer->contact_reason=$request->contact_reason;
                $contactOrganizer->message=$request->message;
                $contactOrganizer->save();
                return Redirect()->back()->with('contact_success', 'The Message sent successfully!');

            }
            catch (\Exception $e){
                return redirect()->back()->with('contact_error', 'Something went wrong!');
            }
        }
    }

    public function ContactOrganizer()
    {
        $contactOrganizers=ContactOrganizers::where('user_id', Auth::user()->id)->get();
        return view('planner.organizers.contact_organizers', compact('contactOrganizers'));

    }


    // protected function storeImages($data, $path)
    // {
    //     $file = $data;
    //     $orignalName = preg_replace('/[^A-Za-z0-9\-]/', '', $file->getClientOriginalName());
    //     $extension = $file->getClientOriginalExtension();
    //     $image_name = uniqid(pathinfo($orignalName,PATHINFO_FILENAME).'_').'.'.$extension;
    //     $file->storeAs($path,$image_name);
    //     return URL::to(Storage::url($path.$image_name));
    // }

    // public function viewOrganizer($id)
    // {
    //     $dt = Carbon::now()->toDateString();
    //     $organizer= EventOrganizer::where('id', $id)->first();
    //     $eventCounts=Event::where([['organizer_id', $organizer->id],['user_id', Auth::User()->id]])->count();
    //     $UpComingEvents = DB::table('events')
    //      ->where([['events.organizer_id', $organizer->id],['events.user_id', Auth::User()->id]])
    //     ->where('events.status', 1)
    //     ->where('event_date_times.event_end','>=', $dt)
    //     ->join('event_date_times', 'events.id', '=', 'event_date_times.event_id')
    //     ->join('event_tickets', 'events.id', '=', 'event_tickets.event_id')
    //     ->select('events.*', 'event_date_times.event_start', 'event_date_times.event_end', 'event_tickets.price', 'event_tickets.type')
    //     ->paginate(12);

    //     $pastEvents = DB::table('events')
    //     ->where([['events.organizer_id', $organizer->id],['events.user_id', Auth::User()->id]])
    //     ->where('events.status', 1)
    //     ->where('event_date_times.event_end','>=', $dt)
    //     ->join('event_date_times', 'events.id', '=', 'event_date_times.event_id')
    //     ->join('event_tickets', 'events.id', '=', 'event_tickets.event_id')
    //     ->select('events.*', 'event_date_times.event_start', 'event_date_times.event_end', 'event_tickets.price', 'event_tickets.type')
    //     ->paginate(12);
    //     $checkFollower=OrganizerFollowers::where([['organizer_id', $id], ['user_id', Auth::user()->id]])->first();
    //     $totalFollowers=OrganizerFollowers::where('organizer_id', $id)->count();

    //     return view('user.view', compact('organizer','eventCounts','UpComingEvents','pastEvents','checkFollower','totalFollowers'));
    // }


}
