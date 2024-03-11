<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EventCategory;
use App\Event;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Auth;
use Validator;

class CategoryController extends Controller
{
    public function list()
    {
        $categories= EventCategory::with(['parent'])->orderBy('id', 'DESC')->get();
        $parent_categories = EventCategory::whereNull('parent_id')->get();
        
        return view('admin.categories.list', compact('categories', 'parent_categories'));
    }

    // public function create()
    // {
    //     $categories= EventCategory::all();
    //     return view('admin.categories.create', compact('categories'));
    // }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => "required",
            'parent_id' => "required",
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.categories.list')->withInput()->with('errors', $validator->errors());
        }

        try{
            $category=new EventCategory();
            $category->name=$request->name;
            $category->parent_id = ($request->parent_id == 0) ? null : $request->parent_id;

            $category->save();

            return redirect()->route('admin.categories.list')->with('success', 'Category Created Successfully!');
        }
        catch (\Exception $e){
            dd($e);
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    // public function show($id)
    // {
    //     $category= EventCategory::where('id', $id)->first();
    //     $categories= EventCategory::all();
    //     return view('admin.categories.view', compact('category', 'categories', 'id'));
    // }

    public function edit($id)
    {
        $category= EventCategory::where('id', $id)->first();
        $categories= EventCategory::all();
        return view('admin.categories.edit', compact('category', 'categories', 'id'));
    }

    public function update(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'id' => "required",
            'name' => "required",
            'parent_id' => "required",
        ]);

        if ($validator->fails()) {
            return back()->withInput()->with('errors', $validator->errors());
        } else {
                try{
                    $category=EventCategory::find($request->id);
                    $category->name=$request->name;
                    $category->parent_id = ($request->parent_id == 0) ? null : $request->parent_id;
                    $category->save();
                    return redirect()->route('admin.categories.list')->with('success', 'Category Update Successfully!');
                }
                catch (\Exception $e){
                    return redirect()->back()->with('error', 'Something went wrong!');
                }
        }
    }

    public function destroy($id)
    {
        try{
            $category=EventCategory::find($id);
            $category->status = !$category->status;
            $category->save();
            $msg = $category->status ? 'Activated' : 'Deactivated';
            return redirect()->route('admin.categories.list')->with('success', 'category '. $msg .' successfully!');
        }
        catch (\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

}
