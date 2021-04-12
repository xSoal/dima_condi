<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;


class ServiceController extends Controller
{
    //
    public function index(Request $request){
        $category_id = $request->input('category');

        if(!$category_id){
            $services = Service::all();
        } else {
            $services = Service::where('service_category_id', $category_id)->get();

        }
        return response()->json($services);
    }

    public function add(Request $request){

        $request->validate([
            "name" => "required|string",
            "category_id" => "required|integer",
            "slug" => [
                "required",
                "unique:services",
                function ($attribute, $value, $fail){
                    if( stripos  ($value, " ") ){
                        $fail("В $attribute не должно быть пробелов");
                    }
                }
            ]
        ]);


        $newService = new Service();
        $newService->category_name = $request->input('name');
        $newService->service_category_id = $request->input('category_id');
        $newService->slug = $request->input('slug');

        $newService->save();

    }

    public function update(Request $request, $service_id = 0){
        $service = Service::where('id', $service_id)->first();


        if(!$service){
            return response()->json([], 404);
        }


        $request->validate([
            "category_name" => "required|string",
            "slug" => [
                "required",
                Rule::unique('services')->ignore($service->id),
                function ($attribute, $value, $fail){

                    if( stripos  ($value, " ") ){
                        $fail("В $attribute не должно быть пробелов");
                    }

                }
            ],
            "title" => "required|string",
            "description" => "required|string",
            "text" => "required|string",
            "is_main" => "required"
        ]);

        $service->category_name = $request->input("category_name");
        $service->slug = $request->input("slug");
        $service->title = $request->input("title");
        $service->description = $request->input("description");
        $service->text = $request->input("text");
        $service->is_main = $request->input("is_main");

        $service->save();
        return response()->json("", 200);
    }

    public function delete(Request $request, $service_id = 0){
        $service = Service::find($service_id);
        $service->delete();

        return response()->json("ok", 200);
    }

}
