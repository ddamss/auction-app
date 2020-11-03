<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $fillable = ['seller_id', 'title', 'description', 'image_url', 'start_price', 'current_price', 'start_date', 'end_date', 'bids_count'];

    public function seller()
    {
        return $this->hasOne('App\Seller', 'seller_id');
    }

        public function bids()
    {
        return $this->hasMany('App\Bidding');
    }
}