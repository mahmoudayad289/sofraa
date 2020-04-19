<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('restaurant_id', 'client_id', 'amount', 'notes', 'spacial_order', 'payment_method', 'total','delivery_cost' ,'commission', 'statue', 'cost','address','rest');

    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withPivot('quantity','price','notes');
    }


    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

}
