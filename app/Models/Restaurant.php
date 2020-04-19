<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Restaurant extends Authenticatable
{

    protected $table = 'restaurants';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'delivery_charge', 'minimum_order', 'password', 'api_token', 'pin_code', 'district_id', 'phone','state','image');

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification', 'notifiable');
    }

    public function contacts()
    {
        return $this->morphMany('App\Models\Contact', 'contactable');
    }

    public function tokens()
    {
        return $this->morphMany('App\Models\Token', 'tokenable');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function offers()
    {
        return $this->hasMany('App\Models\Offer');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    protected $hidden = [
        'password', 'api_token',
    ];

    protected $appends = ['image_path'];


    public function getImagePathAttribute()
    {
        return asset('/images/restaurant/' . $this->image);
    }

}
