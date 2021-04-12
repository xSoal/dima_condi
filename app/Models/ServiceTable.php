<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceTable extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'title',
        'data',
        'type'
    ];

    public function service(){
        return $this->belongsTo(Service::class);
    }
}
