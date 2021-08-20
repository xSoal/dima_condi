<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\ServiceBlock;
use Illuminate\Http\Request;

class FeaturesController extends Controller
{
    public function index(Request $request)
    {
        $Features = Feature::all();
        return response()->json($Features, 200);
    }



    public function create(Request $request)
    {


        $Feature = new Feature();
        $Feature->title = "Нова фича";
        $Feature->text = "Почтому что <h3>мы молодцы</h3>";
        $Feature->image_url = "/images/sliderRow/our_features/1.png";

        $Feature->save();


        return response()->json([], 200);

    }



    public function save(Request $request){
        $request->validate([
            'id' => 'required|integer',
            'title' => 'required|string',
            'text' => 'required|string',
            'image_url' => 'required|string'
        ]);

        $Feature = Feature::findOrFail($request->input('id'));
        $Feature->title =  $request->input('title');
        $Feature->text =  $request->input('text');
        $Feature->image_url =  $request->input('image_url');

        $Feature->save();

        return response()->json([], 200);

    }


    public function delete(Request $request, $featureId){

        $Feature = Feature::findOrFail($featureId);

        $Feature->delete();

        response()->json([], 200);



    }

}
