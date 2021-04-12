<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


class ServicePageController extends Controller
{
    public function index(Request $request, $service_slug = null) {
//        $routeName =   $request->route()->getName();




        if($service_slug !== null){
            $service = Service::where('slug', $service_slug)->firstOrFail();
        } else {
            $service = Service::where('is_main', 1)->firstOrFail();
        }

        // $slider_data = Slider::where('route_name', $routeName)->first();

        return view('service_page', compact('service'));
    }

    public function contact(Request $request){
        return '123';
    }
}
