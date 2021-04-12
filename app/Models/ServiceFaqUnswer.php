<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceFaqUnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'text',
        'service_id'
    ];


    public function service(){
        return $this->belongsTo(Service::class);
    }
}
