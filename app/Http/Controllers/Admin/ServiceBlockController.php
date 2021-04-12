<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceBlock;
use App\Models\ServiceBlock_Block;
use Illuminate\Http\Request;

class ServiceBlockController extends Controller
{
    public function index(Request $request)
    {
        $serviceBlocks = ServiceBlock::all();
        return response()->json($serviceBlocks, 200);
    }

    public function indexOne(Request $request, $serviceBlockId)
    {
        $serviceBlock = ServiceBlock::findOrFail($serviceBlockId);
        return response()->json($serviceBlock, 200);
    }

    public function indexOneByService(Request $request, $serviceId)
    {
        $serviceBlock = ServiceBlock::where('service_id', $serviceId)->firstOrFail();
        return response()->json($serviceBlock, 200);
    }


    public function setActiveStatus(Request $request, $serviceId)
    {
        $request->validate([
            "is_active" => "integer|required",
        ]);

        $serviceBlock = ServiceBlock::find($serviceId);
        $serviceBlock->is_active = $request->input('is_active');
        $serviceBlock->save();

        return response()->json([], 200);

    }


    public function create(Request $request, $serviceId)
    {


        $serviceBlock = new ServiceBlock();
        $serviceBlock->title = "Скидки за обьем";
        $serviceBlock->service_id = $serviceId;
        $serviceBlock->is_active = 1;

        $serviceBlock->save();

        foreach ([1,2,3,4] as $k){
            $for = $k + 1;

            $serviceBlock->serviceBlock__Block()->create([
                "service_block_id" => $serviceBlock->id,
                "header_text" => "$k - $for единиц",
                "text" => "Залупа услуги %$k",
                "price" => 3000 - ($k * 100),
                "price_info" => "за 1 кондер",

            ]);
        }

        return response()->json([], 200);

    }


    public function delete(Request $request, $serviceId){

        $serviceBlock = ServiceBlock::findOrFail($serviceId);

        $serviceBlock->delete();

        response()->json([], 200);



    }



}
