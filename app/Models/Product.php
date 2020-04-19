<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model 
{

    protected $table = 'products';
    public $timestamps = true;
    protected $fillable = array('name', 'description', 'photo', 'price', 'price_offer', 'restaurant_id');

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order');
    }



    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    protected $appends = ['image_path'];


    function getImagePathAttribute() {

        return asset('/images/restaurant/product/'. $this->photo);
    }

}
