<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EventType;
use App\Event;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Auth;
use Validator;


class TypeController extends Controller
{
    public function list()
    {
        $types= EventType::orderBy('id','desc')->get();
        
        return view('admin.types.list', compact('types'));
    }

    // public function create()
    // {
    //     $types= EventType::all();
    //     return view('admin.types.create', compact('types'));
    // }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => "required",
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.types.list')->withInput()->with('errors', $validator->errors());
        }

        // try{
            $type=new EventType();
            $type->name=$request->name;

            $type->save();

            return redirect()->route('admin.types.list')->with('success', 'Type Created Successfully!');
        // }
        // catch (\Exception $e){
        //     return redirect()->back()->with('error', 'Something went wrong!');
        // }
    }

    // public function show($id)
    // {
    //     $type= EventType::where('id', $id)->first();
    //     $types= EventType::all();
    //     return view('admin.types.view', compact('type', 'types', 'id'));
    // }

    public function edit($id)
    {
        $type= EventType::where('id', $id)->first();
        $types= EventType::all();
        return view('admin.types.edit', compact('type', 'types', 'id'));
    }

    public function update(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'id' => "required",
            'name' => "required",
        ]);

        if ($validator->fails()) {
            return back()->withInput()->with('errors', $validator->errors());
        } else {
                try{
                    $type=EventType::find($request->id);
                    $type->name=$request->name;
                    $type->save();
                    return redirect()->route('admin.types.list')->with('success', 'Type Update Successfully!');
                }
                catch (\Exception $e){
                    return redirect()->back()->with('error', 'Something went wrong!');
                }
        }
    }

    public function destroy($id)
    {
        try{
            $type=EventType::findOrFail($id);
            // $type->status = !$type->status;
            // $type->save();
            $type->delete();
            // $msg = $type->status ? 'Activated' : 'Deactivated';
            return redirect()->route('admin.types.list')->with('success', 'type deleted successfully!');
        }
        catch (\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    
    public function updateStatus($id)
    {
        try{
            $type = EventType::find($id);
            $type->status = !$type->status;
            $type->save();
            $msg = $type->status ? 'Activated' : 'Deactivated';
  
            return response()->json(['code' => '200', 'message'=> 'Type '. $msg .' successfully!']);
        }
        catch (\Exception $e){
            return response()->json(['code' => '500','message'=> 'Type '. $msg .' successfully!']);
        }
    }

}
