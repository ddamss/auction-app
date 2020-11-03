<?php

namespace App;

use App\Events\BidRegistered;
use App\Bidding;
use Illuminate\Database\Eloquent\Model;

class Bidding extends Model
{
    public $fillable = ['auction_id', 'buyer_id', 'bidded_price'];

    protected $dispatchesEvents = [
        'created' => BidRegistered::class
    ];

    public function auction()
    {
        return $this->hasOne('App\Auction');
    }

        public function bidders($id)
    {
        return Bidding::where('auction_id','=',$id)->select('buyer_id')->distinct('buyer_id')->count();
    }
}