<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service as Service;

class ServiceCategory extends Model
{
    use HasFactory;


    protected $fillable = [
        'category_name',
    ];

    protected $with = [
        'services'
    ];

    public function services(){
        return $this->hasMany(Service::class);
    }

}
