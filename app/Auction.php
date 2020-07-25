<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $fillable=['seller_id','buyer_id','title','description','start_price','start_date','end_date'];

    public function seller()
    {
        return $this->hasOne('App\Seller', 'seller_id');
    }

}
