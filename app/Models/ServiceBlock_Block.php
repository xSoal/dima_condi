<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\ServiceBlock;

class ServiceBlock_Block extends Model
{
    use HasFactory;

    protected $fillable = [
        "service_block_id",
        'header_text',
        'text',
        'price',
        'price_info'
    ];


    public function serviceBlock(){
        return $this->belongsTo(ServiceBlock::class);
    }
}
