<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected $fillable = [
        'service_category_id',
        'category_name',
        'slug',
        'title',
        'description'
    ];




    public function serviceCategories(){
        return $this->belongsTo(ServiceCategory::class);
    }


}
