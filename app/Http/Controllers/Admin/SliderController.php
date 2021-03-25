<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();

        return response()->json([$sliders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request)
    {
        $request->validate([
            "title" => "required|string",
            "is_active" => "required|integer",
            "service_id" => "required|integer",
            "json_data" => "required|string",
        ]);


        $slider = new Slider();
        $slider->title = $request->input('title');
        $slider->is_active = $request->input('is_active');
        $slider->service_id = $request->input('service_id');
        $slider->json_data = $request->input('json_data');

        $slider->save();

        return response()->json([], 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $slider = Slider::find($id);

        if(!$slider){
            return response()->json([], 404);
        }

        $request->validate([
            "title" => "required|string",
            "json_data" => "required|string",
            "service_id" => "required|integer",
            "is_active" => "required|integer",
        ]);


        $slider->json_data = $request->input('json_data');
        $slider->title =  $request->input('title');
        $slider->is_active =  $request->input('is_active');

        $slider->save();


    }


    public function deactivate(Request $request, $slider_id){
        $slider = Slider::find($slider_id);
        $slider->is_active = 0;
        $slider->save();
        return response()->json($slider, 200);
    }

    public function activate(Request $request, $slider_id){
        $slider = Slider::find($slider_id);
        $slider->is_active = 1;
        $slider->save();
        return response()->json($slider, 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
