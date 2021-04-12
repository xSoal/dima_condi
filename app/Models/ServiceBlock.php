<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
use \App\Models\ServiceBlock_Block;


class ServiceBlock extends Model
{
    use HasFactory;

    protected $fillable = [
        "title", "service_id"
    ];

    protected $with = [
        "serviceBlock__Block"
    ];


    protected static function boot()
    {
        parent::boot();

        self::deleted(function ($ServiceBlock) {
            return $ServiceBlock->serviceBlock__Block()->delete();
        });

    }


    public function service(){
        return $this->belongsTo(Service::class);
    }

    public function serviceBlock__Block(){
        return $this->hasMany(ServiceBlock_Block::class);
    }


}
