<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{

    protected $table = 'clients';

    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone', 'city_id', 'image',  'district_id', 'password', 'api_token', 'pin_code');

    public function tokens()
    {
        return $this->morphMany('App\Models\Token', 'tokenable');
    }

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification', 'notifiable');
    }

    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }


    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


    public function orders()
    {
        return $this->hasMany(Order::class);
    }


    protected $hidden = [
        'password', 'api_token',
    ];

    protected $appends = ['image_path'];


    function getImagePathAttribute() {

        return asset('/images/client/'. $this->image);
    }
}
