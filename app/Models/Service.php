<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\Slider as Slider;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected $fillable = [
        'service_category_id',
        'category_name',
        'slug',
        'title',
        'description',
        'id'
    ];


    protected $with = [
        "slider",
        "serviceBlock",
        "ServiceFaqUnswers",
        "serviceTables"
    ];

    public function slider(){
        return $this->hasOne(Slider::class);
    }


    protected static function boot()
    {
        parent::boot();

        self::deleted(function ($service) {
            return $service->slider()->delete();
        });

        self::deleted(function ($service) {
            return $service->serviceBlock()->delete();
        });

    }


    public function serviceCategories(){
        return $this->belongsTo(ServiceCategory::class);
    }


    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }



    public function serviceBlock(){
        return $this->hasOne(ServiceBlock::class);
    }

    public function ServiceFaqUnswers(){
        return $this->hasMany(ServiceFaqUnswer::class);
    }

    public function serviceTables(){
        return $this->hasMany(ServiceTable::class);
    }

}
