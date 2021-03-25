<?php


namespace App\Traits\Eloquent;

use Illuminate\Support\Facades\Storage;


trait Uploadable
{
    public function upload($file, $folder = 'uploads', $storage = 'public')
    {


        $filename = uniqid() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
        $path = Storage::disk($storage)->putFileAs($folder, $file, $filename);

        if (Storage::disk($storage)->exists($path)) {
            return $path;
        }

        return null;
    }
}
