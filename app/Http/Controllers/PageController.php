<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceCategory;

class PageController extends Controller
{
    static public function getHeader(){

        return ServiceCategory::all();
    }
}
