<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceBlock;
use App\Models\ServiceBlock_Block;
use Illuminate\Http\Request;

class ServiceBlock__BlockController extends Controller
{
    public function delete(Request $request, $serviceBlocBlockId){
        $ServiceBlock_Block = ServiceBlock_Block::findOrFail($serviceBlocBlockId);
        $ServiceBlock_Block->delete();
        return response()->json([], 200);

    }

    public function create(Request $request){
        $request->validate([
            'serviceBlockId' => 'required|integer'
        ]);

        $serviceBlockId = $request->input('serviceBlockId');


        $serviceBlock = ServiceBlock::findOrFail($serviceBlockId);


        $serviceBlock->serviceBlock__Block()->create([
            "service_block_id" => $serviceBlock->id,
            "header_text" => "1 - 2 единиц",
            "text" => "Залупа услуги %1",
            "price" => 2555,
            "price_info" => "за 1 кондер",
        ]);


        return response()->json([], 200);
    }


    public function save(Request $request){
        $request->validate([
            'id' => 'required|integer',
            'service_block___block' => 'required',
            'title' => 'required|string'
        ]);

        $serviceBlock = ServiceBlock::findOrFail($request->input('id'));
        $serviceBlock->title =  $request->input('title');
        $serviceBlock->save();

        foreach ( $request->input('service_block___block') as $block_block){

            $serviceBlock_block = ServiceBlock_Block::find($block_block['id']);
            $serviceBlock_block->header_text = $block_block['header_text'];
            $serviceBlock_block->text = $block_block['text'];
            $serviceBlock_block->price = $block_block['price'];
            $serviceBlock_block->save();

        }



        return response()->json([], 200);

    }
}
