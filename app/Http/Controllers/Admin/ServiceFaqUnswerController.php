<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceFaqUnswer;
use Illuminate\Http\Request;

class ServiceFaqUnswerController extends Controller
{
    public function index(Request $request, $service_id){

        $unswers = ServiceFaqUnswer::where('service_id', '9')->get();

        return response()->json($unswers, 200);


    }

    public function create(Request $request){

        $request->validate([
            'serviceId' => 'required|integer'
        ]);

        $service_id = $request->input('serviceId');

        $u = new ServiceFaqUnswer();

        $u->title = 'Вопрос';
        $u->service_id = $service_id;
        $u->text = 'Ответ';
        $u->save();


        return response()->json($u, 200);


    }



    public function delete(Request $request, $faq_id){
        $faq = ServiceFaqUnswer::findOrFail($faq_id);
        $faq->delete();

        return response()->json([], 200);
    }


}
