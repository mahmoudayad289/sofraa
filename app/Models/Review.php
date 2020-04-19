<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model 
{

    protected $table = 'reviews';
    public $timestamps = true;
    protected $fillable = array('clinet_id', 'restaurant_id', 'rate', 'comment');


    public function clients()
    {
        return $this->belongsTo(Client::class);
    }


}
