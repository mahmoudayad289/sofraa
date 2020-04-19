<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model 
{

    protected $table = 'offers';
    public $timestamps = true;
    protected $fillable = array('name', 'description', 'photo', 'start', 'end', 'restaurant_id');


    protected $appends = ['image_path'];


    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    function getImagePathAttribute() {

        return asset('/images/restaurant/offers/'. $this->photo);
    }

}
