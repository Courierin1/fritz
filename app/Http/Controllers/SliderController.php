<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;

use Validator;
class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders= Slider::orderBy('id','desc')->get();
        return view('admin.slider.list', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'u_link' => "required",
            'status' => "required",
            'order_no' => "required",
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('errors', $validator->errors());
        }
        try{
            $data=[
                'u_link' => $request->u_link,
                'status' => $request->status,
                'order_no' => $request->order_no
            ];
            Slider::create($data);
            return redirect('/admin/slider')->with('success', 'Created Successfully!');
        }
        catch (\Exception $e){
            return redirect()->back('/admin/slider')->with('error', 'Something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $slider = Slider::where('id',$id)->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::where('id',$id)->first();
        return view('admin.slider.edit', compact('slider','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'u_link' => "required",
            'status' => "required",
            'order_no' => "required",
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.slider')->withInput()->with('errors', $validator->errors());
        }
        try{
            $data=[
                'u_link' => $request->u_link,
                'status' => $request->status,
                'order_no' => $request->order_no
            ];
            Slider::where('id',$id)->update($data);
            return redirect()->route('admin.slider')->with('success', 'Updated Successfully!');
        }
        catch (\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            Slider::where('id',$id)->delete();
            return redirect('/admin/slider')->with('success', 'Deleted successfully!');
        }
        catch (\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
}
