<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


class ServicePageController extends Controller
{
    public function index(Request $request) {
        $routeName =   $request->route()->getName();

        $slider_data = Slider::where('route_name', $routeName)->first();

        return view('service_page', compact('slider_data'));
    }
}
