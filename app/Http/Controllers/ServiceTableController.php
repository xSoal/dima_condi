<?php

namespace App\Http\Controllers;

use App\Models\ServiceTable;
use Illuminate\Http\Request;

class ServiceTableController extends Controller
{
    public function index(Request $request, $service_id){
        $tables = ServiceTable::where('service_id', $service_id)->get();

        return response()->json($tables, 200);
    }

    public function create(Request $request){
        $request->validate([
            'service_id' => 'required|integer',
            'type' => "required|integer"
        ]);


        $table = new ServiceTable();
        $table->service_id = $request->input('service_id');
        $table->title = 'Таблица ';
        $table->data  = '{}';
        $table->type = $request->input('type');

        $table->save();

        return response()->json([], 200);

    }


    public function delete(Request $request, $table_id){
        $table = ServiceTable::findOrFail($table_id);

        $table->delete();

        return response()->json([], 200);

    }


    public function edit(Request $request){
        $request->validate([
            'id' => 'required|integer',
            'title' => 'required|string',
            'data' => 'required|string',
            'type' => "required|integer",
        ]);

        $table = ServiceTable::findOrFail($request->input('id'));

        $table->title = $request->input('title');
        $table->data = $request->input('data');
        $table->type = $request->input('type');

        $table->save();

        return response()->json([], 200);
    }



}
