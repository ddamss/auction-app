<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Auction extends Model
{
    protected $fillable = ['seller_id', 'title', 'description', 'image_url', 'start_price', 'current_price', 'start_date', 'end_date', 'bids_count', 'status'];

    public function seller()
    {
        return $this->hasOne('App\Seller', 'seller_id');
    }

    public function bids()
    {
        return $this->hasMany('App\Bidding');
    }

    public function winner($auction_id)
    {

        $result = DB::select(DB::raw(
            "
                SELECT * FROM `biddings`
                WHERE `auction_id` =" . $auction_id . " AND `bidded_price` IN
                (SELECT MAX(`bidded_price`) FROM `biddings` WHERE `auction_id`=" . $auction_id . ")
                "
        ));
        Log::debug($result);
        return $result;
        // dd($q2[0]);
    }
}
