<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttachmentRequest;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    public function store(StoreAttachmentRequest $request)
    {
        $attachment = new Attachment;
        $attachment->name = "file_test_name";
        $attachment->path = $attachment->upload($request->file);

        $attachment->save();

        return response()->json([
            'message' => 'Attachment has been successfully uploaded.',
        ]);
    }

    public function file_list(Request $request){
        // $files = Storage::files("/public/uploads");
        $files = Attachment::orderByDesc("created_at")->get();
        $files = $files->toArray();

        $files = array_map(function($el){
            $el["path"] = request()->getSchemeAndHttpHost() . "/storage/" . $el["path"];
            return $el;
        }, $files);

        return response()->json( $files );
    }

    public function delete(Request $request, $file_id){


        $fileModel = Attachment::where("id", $file_id)->first();

        $delete = Storage::delete("/public/" . $fileModel->path);
        if($delete){
            $fileModel->delete();
            return response()->json([], 200);
        } else {
            return response()->json([
                "error" => "Не удалось удалить файл"
            ], 422);
        }


    }

}
