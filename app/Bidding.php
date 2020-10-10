<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bidding extends Model
{
    public $fillable = ['auction_id', 'buyer_id', 'bidded_price'];

    public function auction()
    {
        return $this->hasOne('App\Models\Auction');
    }
}
